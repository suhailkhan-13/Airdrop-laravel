<?php

namespace App\Http\Controllers;

use App\Services\CanopyApiService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $canopyApiService;

    public function __construct(CanopyApiService $canopyApiService)
    {
        $this->canopyApiService = $canopyApiService;
    }

    public function show(Request $request)

    {
        $asin = $request->input('asin');
        $product = $this->canopyApiService->getProductDetails($asin);
    
        return response()->json($product);
    }
    
    

}
