<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class AffiliateService
{
    public function getMatchingAffiliates() : array
    {
        if (Cache::has('matching_affiliates')) {
            return Cache::get('matching_affiliates');
        }

        // Dublin's office coordinates
        $dublinLat = 53.3340285;
        $dublinLon = -6.2535495;

        $affiliateData = $this->readAffiliateData();

        $matchingAffiliates = $this->filterMatchingAffiliates($dublinLat, $dublinLon, $affiliateData);

        $matchingAffiliates = $this->sortMatchingAffiliates($matchingAffiliates);

        Cache::put('matching_affiliates', $matchingAffiliates, now()->addHours(24));

        return $matchingAffiliates;
    }

    private function readAffiliateData() : array
    {
        $filePath = public_path('affiliates.txt');
        $contents = file_get_contents($filePath);
        $lines = explode("\n", $contents);

        $affiliateData = [];
        foreach ($lines as $line) {
            $data = json_decode(trim($line), true);
            if ($data) {
                $affiliateData[] = $data;
            }
        }

        return $affiliateData;
    }

    private function filterMatchingAffiliates($dublinLat, $dublinLon, $affiliateData) : array
    {
        $matchingAffiliates = [];
        foreach ($affiliateData as $data) {
            $affiliateLat = floatval($data['latitude']);
            $affiliateLon = floatval($data['longitude']);
            $distance = $this->calculateDistance($dublinLat, $dublinLon, $affiliateLat, $affiliateLon);

            if ($distance <= 100) {
                $matchingAffiliates[] = [
                    'affiliate_id' => $data['affiliate_id'],
                    'name'         => $data['name'],
                ];
            }
        }

        return $matchingAffiliates;
    }

    private function sortMatchingAffiliates($matchingAffiliates) : array
    {
        usort($matchingAffiliates, function ($a, $b) {
            return $a['affiliate_id'] - $b['affiliate_id'];
        });

        return $matchingAffiliates;
    }

    private function calculateDistance($lat1, $lon1, $lat2, $lon2): float|int
    {
        $earthRadius = 6371;
        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);

        $dLat = $lat2 - $lat1;
        $dLon = $lon2 - $lon1;

        $a = sin($dLat / 2) * sin($dLat / 2) + cos($lat1) * cos($lat2) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}
