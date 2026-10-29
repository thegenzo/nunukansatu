<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class RefreshAdminToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:refresh-admin-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh the admin access token if it is about to expire.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Retrieve the expiration timestamp from cache
        $expiresAt = Cache::get('admin-token-expires');

        // Check if the token is about to expire in less than 5 minute
        if ($expiresAt && Carbon::now()->addMinute(5)->greaterThanOrEqualTo(Carbon::createFromTimestamp($expiresAt))) {
            // Retrieve the refresh token from cache
            $refreshToken = Cache::get('admin-refresh-token');

            // Make the API request to refresh the token
            $response = Http::asForm()->post('https://sso-siasn.bkn.go.id/auth/realms/public-siasn/protocol/openid-connect/token', [
                'refresh_token' => $refreshToken,
                'client_id' => "kabnunukanws-sso",
                'client_secret' => "05337097-8914-4a6e-829f-47d1966e8291",
                'grant_type' => 'refresh_token'
            ]);
            if ($response->ok()) {
                $json = $response->json();
                $newToken = $json['access_token'];
                $newRefreshToken = $json['refresh_token'];
                $expiresIn = $json['expires_in'];

                dd($json);

                // Calculate the new expiration timestamp
                $newExpiresAt = Carbon::now()->addSeconds($expiresIn)->timestamp;

                // Update the cache with the new tokens and expiration timestamp
                Cache::put('admin-access-token', $newToken);
                Cache::put('admin-refresh-token', $newRefreshToken);
                Cache::put('admin-token-expires', $newExpiresAt);

                $this->info('Admin access token refreshed successfully.');
            } else {
                $this->error('Failed to refresh the admin access token.');
            }
        } else {
            $this->info('Admin access token is still valid.');
        }
    }
}
