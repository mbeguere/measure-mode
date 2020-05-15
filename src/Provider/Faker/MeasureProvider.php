<?php

namespace App\Provider\Faker;

class MeasureProvider
{
    public static function measures()
    {
        $collar_size = $chest_size = $waist_size = $tower_basin = $leg_length = mt_rand(20, 200);
        return compact('collar_size', 'chest_size', 'waist_size', 'tower_basin', 'leg_length');
    }
}
