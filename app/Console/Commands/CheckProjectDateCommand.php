<?php

namespace App\Console\Commands;

use App\Models\Project;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;


class CheckProjectDateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:date-check';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check project date transitions and send email notifications';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currentDate = now();

        $this->info('Checking project date transitions...');

        $projects = Project::whereDate('project_end_date', '<', $currentDate)->get();

        $this->info('Found ' . $projects->count() . ' projects with date transitions.');

        foreach ($projects as $project) {
            $projectName = $project->project_name;
            $projectEndDate = $project->project_end_date;
            $productdetailConss = $project->productdetailCons;

            // foreach ($productdetailConss as $productdetailCons) {
            //     $users = $productdetailCons->user->email;
            //     $this->info('Found ' . $users . 'Hello');
            // }
            $productdetailClients = $project->productdetailClient;

            $dataWith = [
                'text1' => $projectName . ' is set to move under past projects as end date is ' . $projectEndDate . '. kindly update the end date if you wish to keep it under current projects',
                'link' => url('/') . '/login'
            ];

            Mail::send('email.data_info', @$dataWith, function ($msg) use ($productdetailClients, $project, $productdetailConss, $projectName) {
                $msg->from('racap@omegawebdemo.com.au');
                if ($productdetailConss) {


                    foreach ($productdetailConss as $productdetailCons) {
                        $users = $productdetailCons->user->email;
                        $msg->to($users, 'RACAP');
                    }
                }
                if ($productdetailClients) {

                    foreach ($productdetailClients as $productdetailClient) {
                        $users = $productdetailClient->user->email;
                        $msg->to($users, 'RACAP');
                    }
                }

                $msg->to($project->user->email, 'RACAP');

                $msg->subject('Project End Date Alert');
            });

            $this->info('Email notifications sent successfully.');
        }
    }
}
