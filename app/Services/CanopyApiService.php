<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CanopyApiService
{
    protected $apiKey;
    protected $apiUrl;

    public function __construct()
    {
        $this->apiKey = env('CANOPY_API_KEY');
        $this->apiUrl = env('CANOPY_API_URL', 'https://graphql.canopyapi.co/');
    }

    public function getProductDetails($asin)
    {
        $query = [
            'query' => '
                query amazonProduct($asin: String!) {
                    amazonProduct(input: {asin: $asin}) {
                        title
                        mainImageUrl
                        ratingsTotal
                        rating
                         price {
        display
      }
                    }
                }
            ',
            'variables' => ['asin' => $asin]
        ];

        $response = Http::withHeaders([
            'API-KEY' => $this->apiKey, // Updated header key
            'Content-Type' => 'application/json',
        ])->post($this->apiUrl, $query);

        $data = $response->json();

        Log::info('CanopyAPI Response:', $data); // Log the full response

        if ($response->successful() && isset($data['data']['amazonProduct'])) {
            return $data['data']['amazonProduct'];
        }

        return null;
    }
}
