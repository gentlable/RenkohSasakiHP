<?php

use App\Models\ActiveInstance;
use Faker\Generator as Faker;

$factory->define(ActiveInstance::class, function (Faker $faker) {
    return [
        'instance_id' => '0000000000',
        'enable'      => true,
    ];
});
