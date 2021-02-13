<?php

namespace App\Models;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;

class ActiveInstance extends Model
{
    protected $table = 'active_instances';

    protected $fillable = ['instance_id', 'leader', 'enable'];

    public static function getInstanceId()
    {
        $url = 'http://169.254.169.254/latest/meta-data/instance-id/';
        try {
            $client = new Client(['timeout' => 2.0]);
            $response = $client->request(
                'GET',
                $url // URLを設定
            );
        } catch (RequestException $e) {
            return 0;
        }
        $responseBody = $response->getBody()->getContents();

        $instance_id = $responseBody;
        return $instance_id;
    }

    public static function isNotLeaderInstance()
    {
        $instance_id = self::getInstanceId();
        if ($instance_id === null) {
            Log::info('isNotLeaderInstance:instance_id===null.');
            return false;
        }

        $active_instance = self::where('instance_id', $instance_id)
            ->where('enable', true)->first();

        if (empty($active_instance)) {
            Log::info('isNotLeaderInstance:active_instance is empty.');
            return false;
        } else {
            if ($active_instance->leader) {
                // Log::info('isNotLeaderInstance:is leader.');
                return false;
            } else {
                // Log::info('isNotLeaderInstance:is not leader.' . $active_instance->leader);
                return true;
            }
        }
    }

    public static function updateForInstanceId($instance_id, $update_data)
    {
        $active_instance = self::where('instance_id', $instance_id)->first();

        if (empty($active_instance)) {
            ActiveInstance::create($update_data + [
                'instance_id' => $instance_id,
            ]);
        } else {
            $active_instance->update($update_data + [
                'instance_id' => $instance_id,
            ]);
        }
    }
}
