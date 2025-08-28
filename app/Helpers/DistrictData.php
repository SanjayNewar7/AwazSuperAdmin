<?php

namespace App\Helpers;

class DistrictData
{
    public static function getDistrictRegionWardMap()
    {
        return [
            'Achham' => [
                'Kamalbazar Municipality' => 10,
                'Mangalsen Municipality' => 13,
                'Panchadewal Binayak Municipality' => 9,
                'Sanphebagar Municipality' => 14,
                'Bannigadhi Jayagadh Rural Municipality' => 6,
                'Chaurpati Rural Municipality' => 7,
                // ... (add other regions)
            ],
            'Arghakhanchi' => [
                'Bhumekasthan Municipality' => 10,
                'Sandhikharka Municipality' => 12,
                'Sitganga Municipality' => 14,
                'Chhatradev Rural Municipality' => 8,
                // ... (add other regions)
            ],
            // Add other districts similarly...
            'Kathmandu' => [
                'Kathmandu Metropolitan City' => 32,
                'Budhanilkantha Municipality' => 13,
                'Chandragiri Municipality' => 15,
                // ... (add other regions)
            ],
            'chitwan' => [
                'Bharatpur Metropolitan City' => 29,
                'Kalika Municipality' => 11,
                'Khairahani Municipality' => 13,
                'Madi Municipality' => 9,
                'Rapti Municipality' => 13,
                'Ratnanagar Municipality' => 16,
                'Ichchhakamana Rural Municipality' => 7,
                // ... (add other regions)
            ],
            // ... (continue for all districts)
        ];
    }

    public static function getIssueTypes()
    {
        return [
            'All Issues',
            'Water Supply',
            'Electricity',
            'Roads',
            'Waste',
            'Transport',
            'Street Lights',
            'Drainage',
            'Pollution',
            'Robbery',
            'Community',
            'Healthcare',
            'Education',
            'Environmental',
            'Traffic',
            'Noise',
            'Government',
            'Parks',
            'Construction',
            'Animal',
            'Fire',
            'Others',
        ];
    }
}
