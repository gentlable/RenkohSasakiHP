<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

use App\Models\ActiveInstance;

class ActiveInstanceEnable extends Command
{
    protected $signature = 'command:activeInstanceEnable {--instance_id=} {--leader}';
    protected $description = 'activeInstanceEnable';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $instance_id = $this->option('instance_id');
        $leader = $this->option('leader');

        echo "ActiveInstanceEnable " . var_export($instance_id, true). " " . $leader . PHP_EOL ;
        Log::info('ActiveInstanceEnable.' . $instance_id . " " . $leader);

        if (empty($instance_id)) {
            $instance_id = ActiveInstance::getInstanceId();
        }
        if ($leader === null) {
            ActiveInstance::updateForInstanceId($instance_id, ['enable' => true]);
        } else {
            ActiveInstance::updateForInstanceId($instance_id, ['enable' => true, 'leader' => $leader]);
        }

        echo "finish " . $instance_id  . PHP_EOL;
    }
}
