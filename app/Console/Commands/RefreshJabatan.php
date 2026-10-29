<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Asn;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class RefreshJabatan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:refresh-jabatan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        /*
        $asn_data = Asn::all();
        $response = Http::timeout(60)->withOptions(['verify' => false])->connectTimeout(60)->asForm()->post('https://sso-siasn.bkn.go.id/auth/realms/public-siasn/protocol/openid-connect/token', [
            'client_id' => 'kabnunukanws', 
            'grant_type' => 'password', 
            'username' => env('SSO_ADMINCLI_USER'),
            'password' => env('SSO_ADMINCLI_PASS')
        ]);

        $admin_resp = $response->json();
        $admin_token = $admin_resp['access_token'];
        */

        $admin_token = Cache::get("admin-access-token");


        $response = Http::timeout(60)->withOptions(['verify' => false])->connectTimeout(60)->withBasicAuth('u5xo_I2Wx1zqfdoSV4rkrEK9lkAa', '_qGXXUX9kKOT44P4QhsSUYzCuTka')->asForm()->post('https://apimws.bkn.go.id/oauth2/token', [
            'grant_type' => 'client_credentials',
        ]);

        $apiws_resp = $response->json();
        $apiws_token = $apiws_resp['access_token'];
        foreach($asn_data as $data){
            echo "Fetching data for NIP: $data->nip\n";
            $response = Http::timeout(60)->withOptions(['verify' => false])->connectTimeout(60)->withHeaders([
                'Auth' => 'Bearer ' . $admin_token,
                'Authorization' => 'Bearer ' . $apiws_token
            ])->get('https://apimws.bkn.go.id:8243/apisiasn/1.0/pns/data-utama/' . $data->nip);
    
            $infopns_resp = $response->json();
            $data->data = $infopns_resp;
            $data->save();
        }
    }
}
