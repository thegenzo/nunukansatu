<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

use Firebase\JWT\JWT;
use App\Models\User;
use App\Models\Asn;
use App\Models\Announcement;
use Illuminate\Support\Facades\Schema;
use Socialite;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

use Carbon\Carbon;



class WebController extends Controller
{
    public function index(Request $request)
    {
        // Check if the request's host is not the allowed host
        // if ($request->server('HTTP_HOST') !== "nunukankab.go.id") {
            // Redirect to the allowed host with the current request URI
        //     return redirect('https://nunukankab.go.id', 302);
        // }

        $announcement = Schema::hasTable('announcements')
            ? Announcement::visible()->latest('updated_at')->latest('id')->first()
            : null;

        return response()->view('web.pages.home', compact('announcement'))
            ->header('Cache-Control', 'no-store');
    }

    public function public_services(Request $request)
    {
        $url = $request->query('url');
        $name = $request->query('name');
        return view('web.pages.public-service', compact('url', 'name'));
    }

    public function administration_services(Request $request)
    {
        $url = $request->query('url');
        $name = $request->query('name');
        return view('web.pages.administration-service', compact('url', 'name'));
    }

    public function mall_data_informasi(Request $request)
    {
        $url = $request->query('url');
        $name = $request->query('name');
        $menu = $request->query('menu');
        return view('web.pages.mall-data-informasi', compact('url', 'name', 'menu'));
    }

    public function layanan_fase_kehidupan()
    {
        return view('web.pages.layanan-fase-kehidupan');
    }

    public function sso_login(Request $request)
    {
        return Socialite::driver('keycloak')->redirect();
    }
    public function sso_logout(Request $request)
    {
        $request->session()->forget('sso_data');
        return redirect(Socialite::driver('keycloak')->getLogoutUrl('https://nunukankab.go.id/?utm_from=keycloak-slo', env('KEYCLOAK_CLIENT_ID')));
    }
    public function sso_callback(Request $request)
    {
        $user = Socialite::driver('keycloak')->stateless()->user();
        $cacheKey = "sso-login:" . sha1($user->nickname);
        if (Cache::has($cacheKey)) {
            $ret_resp = Cache::get($cacheKey);
            $request->session()->put('sso_data', $ret_resp);
            $request->session()->flash('show_services_modal', true);
            return redirect(route('web.home'));
        }
        $auth_resp = ['access_token' => $user->token];

        if(env('SSO_ADMINCLI_USER') == $user->nickname){
            // Handler for user bu endang sebagai admin kabupaten
            Cache::put("admin-access-token", $user->token);
            Cache::put("admin-refresh-token", $user->refreshToken);
            Cache::put("admin-token-expires", Carbon::now()->addSeconds($user->expiresIn)->timestamp);
        }

        $asn = Asn::firstWhere('nip', $user->nickname);
        if ($asn && $asn->data !== null) {
            $data = json_decode(json_encode($asn->data), true);
            $ret_resp = array_merge($auth_resp, ['name' => $user->name, 'jabatan' => $data['data']['jabatanNama']]);

            Cache::put($cacheKey, json_encode($ret_resp), now()->addHours(24 * 14));

            $request->session()->put('sso_data', json_encode($ret_resp));
            $request->session()->flash('show_services_modal', true);
            return redirect(route('web.home'));
        } else {
            /*
            $response = Http::timeout(60)->withOptions(['verify' => false])->connectTimeout(60)->asForm()->post('https://sso-siasn.bkn.go.id/auth/realms/public-siasn/protocol/openid-connect/token', [
                'client_id' => 'kabnunukanws',
                'grant_type' => 'password',
                'username' => env('SSO_ADMINCLI_USER'),
                'password' => env('SSO_ADMINCLI_PASS')
            ]);

            $admin_resp = $response->json();
            $admin_token = $admin_resp['access_token'];
            */

            $admin_token = env('ADMIN_ACCESS_TOKEN');

            $response = Http::timeout(60)->withOptions(['verify' => false])->connectTimeout(60)->withBasicAuth('u5xo_I2Wx1zqfdoSV4rkrEK9lkAa', '_qGXXUX9kKOT44P4QhsSUYzCuTka')->asForm()->post('https://apimws.bkn.go.id/oauth2/token', [
                'grant_type' => 'client_credentials',
            ]);

            $apiws_resp = $response->json();
            $apiws_token = $apiws_resp['access_token'];

            $response = Http::timeout(60)->withOptions(['verify' => false])->connectTimeout(60)->withHeaders([
                'Auth' => 'Bearer ' . $admin_token,
                'Authorization' => 'Bearer ' . $apiws_token
            ])->get('https://apimws.bkn.go.id:8243/apisiasn/1.0/pns/data-utama/' . $user->nickname);

            $infopns_resp = $response->json();

            if (!isset($infopns_resp['code']) || $infopns_resp['code'] !== 1) {
                $request->session()->flash('error', 'Gagal mengambil data jabatan, pastikan anda sudah melakukan peremajaan di SIASN melalui admin BKPSDM');
                $ret_resp = array_merge($auth_resp, ['name' => $user->name, 'jabatan' => 'Tidak diketahui']);
                $request->session()->put('sso_data', json_encode($ret_resp));
                $request->session()->flash('show_services_modal', true);
                return redirect(route('web.home'));
            }


            $asn = Asn::firstWhere('nip', $user->nickname);
            if ($asn) {
                // Jika ada, upate database
                $asn->data = $infopns_resp;
                $asn->save();
            } else {
                $asn = Asn::create(['nip' => $user->nickname, 'data' => $infopns_resp]);
            }

            $ret_resp = array_merge($auth_resp, ['name' => $user->name, 'jabatan' => $infopns_resp['data']['jabatanNama']]);

            Cache::put($cacheKey, json_encode($ret_resp), now()->addHours(24 * 14));

            $request->session()->put('sso_data', json_encode($ret_resp));
            $request->session()->flash('show_services_modal', true);
            return redirect(route('web.home'));
        }
    }
    public function sso_siasn(Request $request)
    {
        $request->validate([
            'nip' => 'required',
            'password' => 'required',
            'otp' => 'nullable|string',
        ]);
    
        $username = $request->nip;
        $password = $request->password;
        $otp = $request->otp;
    
        $cacheKey = "sso-siasn:" . sha1($username . $password);
    
        if (Cache::has($cacheKey)) {
            $ret_resp = json_decode(Cache::get($cacheKey), true);
            return response()->json($ret_resp, 200);
        }
    
        // Request token from SIASN
        $tokenRequestData = [
            'client_id' => 'kabnunukanws',
            'grant_type' => 'password',
            'username' => $username,
            'password' => $password,
        ];
    
        if (!empty($otp)) {
            $tokenRequestData['otp'] = $otp;
        }
    
        $response = Http::timeout(60)->connectTimeout(60)->asForm()
            ->post('https://sso-siasn.bkn.go.id/auth/realms/public-siasn/protocol/openid-connect/token', $tokenRequestData);
    
        $auth_resp = $response->json();
    
        if (!isset($auth_resp['access_token'])) {
            $resp = ['status' => 'Failed', 'msg' => 'NIP, Password, atau OTP tidak valid'];
            return response()->json($resp, 401);
        }
    
        $auth_token = $auth_resp['access_token'];
    
        $asn = Asn::firstWhere('nip', $username);
        if ($asn && $asn->data !== null) {
            $data = json_decode(json_encode($asn->data), true);
            $ret_resp = array_merge($auth_resp, ['jabatan' => $data['data']['jabatanNama']]);
    
            Cache::put($cacheKey, json_encode($ret_resp), now()->addHours(24 * 14));
    
            return response()->json($ret_resp, 200);
        } else {
            $admin_token = env('ADMIN_ACCESS_TOKEN');
    
            // Get APIWS token
            $response = Http::timeout(60)->connectTimeout(60)
                ->withBasicAuth('u5xo_I2Wx1zqfdoSV4rkrEK9lkAa', '_qGXXUX9kKOT44P4QhsSUYzCuTka')
                ->asForm()
                ->post('https://apimws.bkn.go.id/oauth2/token', [
                    'grant_type' => 'client_credentials',
                ]);
    
            $apiws_resp = $response->json();
            $apiws_token = $apiws_resp['access_token'] ?? null;
    
            if (!$admin_token || !$apiws_token) {
                return response()->json(['status' => 'Failed', 'msg' => 'Token akses API tidak valid, harap hubungi administrator'], 500);
            }
    
            // Get user data
            $response = Http::timeout(60)->connectTimeout(60)->withHeaders([
                'Auth' => 'Bearer ' . $admin_token,
                'Authorization' => 'Bearer ' . $apiws_token
            ])->get('https://apimws.bkn.go.id:8243/apisiasn/1.0/pns/data-utama/' . $username);
    
            $infopns_resp = $response->json();
    
            if (!isset($infopns_resp['code']) || $infopns_resp['code'] !== 1) {
                $ret_resp = array_merge($auth_resp, ['jabatan' => 'Jabatan tidak ditemukan']);
                return response()->json($ret_resp, $response->status());
            }
    
            // Save or update ASN record
            $asn = Asn::firstWhere('nip', $username);
            if ($asn) {
                $asn->data = $infopns_resp;
                $asn->save();
            } else {
                $asn = Asn::create(['nip' => $username, 'data' => $infopns_resp]);
            }
    
            $ret_resp = array_merge($auth_resp, ['jabatan' => $infopns_resp['data']['jabatanNama']]);
    
            Cache::put($cacheKey, json_encode($ret_resp), now()->addHours(24 * 14));
    
            return response()->json($ret_resp, $response->status());
        }
    }

    public function sso_pub(Request $request)
    {
        $nik = $request->nik;
        $password = $request->password;

        $user = User::where(['nik' => $nik])->first();

        if ($user) {
            // Jika user blm verified
            if ($user['verified'] == 0) {
                return response()->json(['success' => false, 'status' => 1], 403);
            }
            if (!Hash::check($password, $user['password'])) {
                return response()->json(['success' => false, 'status' => 2], 403);
            }

            // access_token, userData
            $expired_time = time() + (24 * 60 * 60);

            $payload = [
                'nik' => $user['nik'],
                'name' => $user['name'],
                'phone' => $user['phone'],
                'exp' => $expired_time
            ];
            $access_token = JWT::encode($payload, env('JWT_SECRET'), 'HS256');
            return response()->json(['success' => true, 'access_token' => $access_token, 'userData' => $user], 200);
        }
        return response()->json(['success' => false], 403);
    }

    public function daftar_pub(Request $request)
    {
        $nik = $request->nik;
        $password = $request->password;

        if (User::where(['nik' => $nik])->first()) {
            return response()->json(['success' => false], 403);
        }

        // Cek nik di sipakrt

        $response = Http::get('https://sipakrt.nunukankab.go.id/api/ceknik.php?nik=' . $nik);

        $sipakrt_resp = $response->json();

        if ($sipakrt_resp['status'] == false) {
            return response()->json(['success' => false, 'status' => '1'], 403);
        }

        $phone = $sipakrt_resp['no_hp'];
        $name = $sipakrt_resp['nama_lengkap'];
        // Valid? Kirim OTP ke whatsapp

        $valid_phone = Str::replace('08', '628', $phone);

        // Simpan User
        $user = User::create([
            'nik' => $nik,
            'name' => $name,
            'phone' => $phone,
            'password' => Hash::make($password),
            'verified' => false
        ]);

        $data = [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => $valid_phone,
            'type' => 'template',
            'template' => [
                'name' => 'nunukansatu_loginlink',
                'language' => [
                    'code' => 'id'
                ],
                'components' => [
                    [
                        'type' => 'header',
                        'parameters' => [
                            [
                                'type' => 'image',
                                'image' => [
                                    'link' => 'https://nunukankab.go.id/assets/icons/logo-red.png'
                                ]
                            ]
                        ]
                    ],
                    [
                        'type' => 'button',
                        'sub_type' => 'url',
                        'index' => '0',
                        'parameters' => [
                            [
                                'type' => 'text',
                                'text' => Crypt::encryptString($user->id)
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://graph.facebook.com/v17.0/105241192598673/messages",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer EAALhzWerMEYBACcERA5d7NDBnyCYbBrHVg8P4NbkiswW2yK4NmZA1zFvgeZBOhYHqMPFeVcTsKRm7oWJ6xSSHZAsEFMWuBXQvs68a1NXo388dd4smm9SWH93s3NTqfhj9Mp7f22SguCGoyquI3ykuO5P7vrEItR8twZCzAMVyvYIBOYkwH0aqk7qeRj5RwBqHU8DFARvSAZDZD",
                "Content-Type: application/json"
            ],
        ]);

        $response = curl_exec($curl);

        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            $user->delete();
            return response()->json(['success' => false, 'status' => '2'], 403);
        }

        // Return
        return response()->json(['success' => true, 'masked_phone' => Str::of($phone)->mask('*', 0, -4)], 200);
    }

    public function activate(Request $request, $id)
    {
        $id = Str::remove('{{1}}', $id);
        $id = Crypt::decryptString($id);
        $user = User::find($id);
        if ($user) {
            $user->verified = 1;
            $user->save();
            $request->session()->flash('success', 'Aktivasi berhasil, anda sekarang bisa masuk ke Nunukan Satu');
            return redirect('/');
        } else {
            $request->session()->flash('error', 'Aktivasi gagal, link tidak valid');
            return redirect('/');
        }
    }
}
