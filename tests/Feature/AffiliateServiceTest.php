<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\AffiliateService;

class AffiliateServiceTest extends TestCase
{
    public function testReadAffiliateData()
    {
        $affiliateService = new AffiliateService();

        $result = $affiliateService->getMatchingAffiliates();

        $expected = [
            [
                "affiliate_id" => 4,
                "name"         => "Inez Blair"
            ],
            [
                "affiliate_id" => 5,
                "name"         => "Sharna Marriott"
            ],
            [
                "affiliate_id" => 6,
                "name"         => "Jez Greene"
            ],
            [
                "affiliate_id" => 8,
                "name"         => "Addison Lister"
            ],
            [
                "affiliate_id" => 11,
                "name"         => "Isla-Rose Hubbard"
            ],
            [
                "affiliate_id" => 12,
                "name"         => "Yosef Giles"
            ],
            [
                "affiliate_id" => 13,
                "name"         => "Terence Wall"
            ],
            [
                "affiliate_id" => 15,
                "name"         => "Veronica Haines"
            ],
            [
                "affiliate_id" => 17,
                "name"         => "Gino Partridge"
            ],
            [
                "affiliate_id" => 23,
                "name"         => "Ciara Bannister"
            ],
            [
                "affiliate_id" => 24,
                "name"         => "Ellena Olson"
            ],
            [
                "affiliate_id" => 26,
                "name"         => "Moesha Bateman"
            ],
            [
                "affiliate_id" => 29,
                "name"         => "Alvin Stamp"
            ],
            [
                "affiliate_id" => 30,
                "name"         => "Kingsley Vang"
            ],
            [
                "affiliate_id" => 31,
                "name"         => "Maisha Mccarty"
            ],
            [
                "affiliate_id" => 39,
                "name"         => "Kirandeep Browning"
            ]
        ];

        $this->assertEquals($expected, $result);
    }
}
