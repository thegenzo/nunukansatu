<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class AbsenSimanjaDatang extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:absen-simanja-datang';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Absen Datang';

    private function doAbsen($nip, $id_user){
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', 'https://ekinerja.nunukankab.go.id/api/mobile/?act=absendatang', [
                'form_params' => [
                    'nip' => $nip,
                    'token'=>'eB1rX7ACT2q3zhlSQWnme7:APA91bEL8u6yx_9Wg-5mR4kaKI8tB3lCuLbev3aIQcP-xlNi4SbJJKTbXyjIu3qUAvwSKqz8iI38b4BEkrm74ukLpsS25WH-FAivX3Z8npOtHyNZC7W87PVxep5A78e3QYTvmSmRla-J',
                    'id_user'=> $id_user,
                    'lintang'=>'4.0766143',
                    'bujur'=>'117.7188447',
                    'version'=>'2.0',
                    'agent' => 'okhttp/4.9.2',
                ],
            ]);
            $this->info('Success post.');
            $this->info('Response: ' . $response->getBody());
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $this->error('Request failed: ' . $e->getMessage());
        } catch (\Exception $e) {
            $this->error('An error occurred: ' . $e->getMessage());
        }
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('absen dimatikan');
        $userList = [
            'Firmansyah' => 3980
        ];
        sleep(rand(10, 180));
        $userList = Arr::shuffle($userList);
        foreach($userList as $key => $value){
            $this->info(print_r($userList, true));
            $this->info("Processing $key => $value at " . date('d-m-Y H:i:s'));
            $this->doAbsen($key, $value);
            $delayTime = rand(180, 360);
            $this->info("Delaying script at $delayTime second");
            sleep($delayTime);
        }
    }
}
