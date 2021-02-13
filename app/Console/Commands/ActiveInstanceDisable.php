<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

use App\Models\ActiveInstance;

class ActiveInstanceDisable extends Command
{
    protected $signature = 'command:activeInstanceDisable {--instance_id=}';
    protected $description = 'activeInstanceDisable';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $instance_id = $this->option('instance_id');

        echo "ActiveInstanceDisable " . $instance_id . PHP_EOL ;
        Log::info('ActiveInstanceDisable.' . $instance_id);

        if (empty($instance_id)) {
            $instance_id = ActiveInstance::getInstanceId();
        }

        ActiveInstance::updateForInstanceId($instance_id, ['leader' => false, 'enable' => false]);

        echo "finish " . $instance_id  . PHP_EOL;
    }
}
