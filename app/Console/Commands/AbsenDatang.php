<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class AbsenDatang extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:absen-datang';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Absen Datang';

    private function doAbsen($nip, $id_user){
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', 'https://absentim.nunukankab.go.id/api/mobile/?act=absendatang', [
                'form_params' => [
                    'nip' => $nip,
                    'token'=>'cQ1we1_lSH-vuXjEsD9tUZ:APA91bF8ug_Hj_CW5O4BF8Pk6P43qrDx-SXuv5LmHnUPQfVF0viTcMaK2oU--5-GticMroXDV1KzLNiFBRSTm-dcgdcMHfqVJkG0wOsB0meXEeb5Ct5VNdioqXpOdKfw3s9py1YqSzeM',
                    'id_user'=> $id_user,
                    'lintang'=>'4.0766143',
                    'bujur'=>'117.7188447',
                    'versi'=>'1.4'
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
            'ryan' => 700,
            'agis' => 701,
            'chery' => 702,
            'frmsyah75@gmail.com' => 3,
            'risman' => 705,
            'achym.07@gmail.com' => 8,
            'iwaskitho@gmail.com' => 5,
            'nuradjiparadji@gmail.com' => 88,
            'fahmytamar' => 706,
            'fahmiimaniar' => 707,
            'Zhazhabillah98@gmail.com' => 699,
            'hugoradnaksi69@gmail.com' => 12
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
