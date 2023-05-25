<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CheckAlertDateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:check-alert-date-command';

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
        // Fetch all rows from the calender_alerts table
        $alerts = DB::table('calender_alerts')->get();

        // Current date ka object banaein
        $currentDate = now();
        if ($alerts) {
            foreach ($alerts as $alert) {
                $date1 = $alert->alert_date1;
                $date2 = $alert->alert_date2;
                $date3 = $alert->alert_date3;
                $productId = $alert->product_id;
                $particular = $alert->particular;
                $alertNote = $alert->alert_note;
                $renewDate = $alert->renew_date;

                // Date ke basis par schedule create karein
                if (
                    $date1 === $currentDate->format('Y-m-d') ||
                    $date2 === $currentDate->format('Y-m-d') ||
                    $date3 === $currentDate->format('Y-m-d')
                ) {
                    $product = Product::find($productId);
                    $projectName = $product->project->project_name;
                    $productdetailClients = $product->productdetailClient;
                    $productdetailConss = $product->productdetailCons;

                    $dataWith = [
                        'text1' => $alertNote,
                        'text2' => 'Renew Date: ' . $renewDate,
                        'link'  => url('/') . '/login'
                    ];

                    Mail::send('email.data_info', @$dataWith, function ($msg) use ($productdetailClients, $product, $productdetailConss, $particular) {
                        $msg->from('racap@omegawebdemo.com.au');
                        foreach ($productdetailConss as $productdetailCons) {
                            $users = $productdetailCons->user->email;
                            $msg->to($users, 'RACAP');
                        }
                        foreach ($productdetailClients as $productdetailClient) {
                            $users = $productdetailClient->user->email;
                            $msg->to($users, 'RACAP');
                        }

                        $msg->to($product->user->email, 'RACAP');

                        $msg->subject($particular);
                    });

                    $this->info('Email notifications sent successfully for alert with ID: ' . $alert->id);
                }
            }
        }
    }
}
