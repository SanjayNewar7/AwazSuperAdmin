<?php
// app/Models/DistrictData.php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class DistrictData
{
    private static $districtRegionWardMap;

    public static function initialize()
    {
        if (self::$districtRegionWardMap === null) {
            self::$districtRegionWardMap = [
                // "Kathmandu" => [
                //     "Kathmandu Metropolitan City" => 32,
                //     "Budhanilkantha Municipality" => 13,
                //     "Chandragiri Municipality" => 15,
                //     "Gokarneshwor Municipality" => 9,
                //     "Kageshwori Manohara Municipality" => 9,
                //     "Kirtipur Municipality" => 10,
                //     "Nagarjun Municipality" => 10,
                //     "Shankharapur Municipality" => 9,
                //     "Tarakeshwor Municipality" => 10,
                //     "Tokha Municipality" => 11,
                //     "Dakshinkali Rural Municipality" => 7,
                // ],
                "Lalitpur" => [
                    "Lalitpur Metropolitan City" => 29,
                    "Godawari Municipality" => 14,
                    "Mahalaxmi Municipality" => 10,
                    "Bagmati Rural Municipality" => 7,
                    "Konjyosom Rural Municipality" => 5,
                    "Mahankal Rural Municipality" => 6,
                ],
                "Bhaktapur" => [
                    "Bhaktapur Municipality" => 10,
                    "Changunarayan Municipality" => 9,
                    "Madhyapur Thimi Municipality" => 9,
                    "Suryabinayak Municipality" => 10,
                ],
                "Chitwan" => [
                    "Bharatpur Metropolitan City" => 29,
                    "Kalika Municipality" => 11,
                    "Khairahani Municipality" => 13,
                    "Madi Municipality" => 9,
                    "Rapti Municipality" => 13,
                    "Ratnanagar Municipality" => 16,
                    "Ichchhakamana Rural Municipality" => 7,
                ],
                "Pokhara" => [
                    "Pokhara Metropolitan City" => 33,
                    "Annapurna Rural Municipality" => 11,
                    "Machhapuchhre Rural Municipality" => 9,
                    "Madi Rural Municipality" => 12,
                    "Rupa Rural Municipality" => 7,
                ],
                "Biratnagar" => [
                    "Biratnagar Metropolitan City" => 19,
                    "Belbari Municipality" => 11,
                    "Letang Municipality" => 9,
                    "Pathari Sanischare Municipality" => 10,
                    "Rangeli Municipality" => 9,
                    "Ratuwamai Municipality" => 10,
                    "Sundarharaicha Municipality" => 12,
                    "Sunwarshi Municipality" => 9,
                    "Urlabari Municipality" => 9,
                ],
                "Birgunj" => [
                    "Birgunj Metropolitan City" => 32,
                    "Bahudaramai Municipality" => 9,
                    "Parsagadhi Municipality" => 9,
                    "Pokhariya Municipality" => 10,
                    "Bindabasini Rural Municipality" => 5,
                    "Chhipaharmai Rural Municipality" => 5,
                ],
                "Butwal" => [
                    "Butwal Sub-Metropolitan City" => 19,
                    "Devdaha Municipality" => 12,
                    "Lumbini Sanskritik Municipality" => 13,
                    "Sainamaina Municipality" => 11,
                    "Siddharthanagar Municipality" => 13,
                    "Tillotama Municipality" => 17,
                ],
                "Dharan" => [
                    "Dharan Sub-Metropolitan City" => 20,
                    "Barahachhetra Municipality" => 11,
                    "Duhabi Municipality" => 12,
                    "Inaruwa Municipality" => 10,
                    "Ramdhuni Municipality" => 9,
                    "Itahari Sub-Metropolitan City" => 20,
                ],
                "Nepalgunj" => [
                    "Nepalgunj Sub-Metropolitan City" => 23,
                    "Kohalpur Municipality" => 15,
                    "Baijanath Rural Municipality" => 8,
                    "Duduwa Rural Municipality" => 6,
                    "Janaki Rural Municipality" => 6,
                    "Khajura Rural Municipality" => 8,
                ]
            ];
        }
    }

    public static function getDistricts()
    {
        self::initialize();
        return array_keys(self::$districtRegionWardMap);
    }

    public static function getRegions($district)
{
    self::initialize();
    Log::info('DistrictRegionWardMap: ' . json_encode(self::$districtRegionWardMap)); // Debug
    return isset(self::$districtRegionWardMap[$district]) ?
        array_keys(self::$districtRegionWardMap[$district]) : [];
}

    public static function getWards($district, $region)
    {
        self::initialize();
        return isset(self::$districtRegionWardMap[$district][$region]) ?
            range(1, self::$districtRegionWardMap[$district][$region]) : [];
    }

    public static function getAllData()
    {
        self::initialize();
        return self::$districtRegionWardMap;
    }
}
