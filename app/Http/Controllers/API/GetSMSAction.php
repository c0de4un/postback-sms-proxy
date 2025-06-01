<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\GetSMSRequest;
use App\Services\PostBackSMSClient;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;

class GetSMSAction
{
    public function index(GetSMSRequest $request): JsonResponse
    {
        /** @var PostBackSMSClient $postbackSMS */
        $postbackSMS = App::make(PostBackSMSClient::class);
        $response = $postbackSMS->getSMS($request);

        return response()->json($response->json());
    }
}
