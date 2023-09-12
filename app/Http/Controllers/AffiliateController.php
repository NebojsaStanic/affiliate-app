<?php

namespace App\Http\Controllers;

use App\Services\AffiliateService;
use Illuminate\Http\JsonResponse;

class AffiliateController extends Controller
{

    protected AffiliateService $affiliateService;

    public function __construct(AffiliateService $affiliateService)
    {
        $this->affiliateService = $affiliateService;
    }

    public function getNearbyAffiliates() : JsonResponse
    {
        $matchingAffiliates = $this->affiliateService->getMatchingAffiliates();

        return response()->json($matchingAffiliates);
    }
}
