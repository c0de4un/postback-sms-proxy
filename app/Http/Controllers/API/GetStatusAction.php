<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CancelNumberRequest;
use App\Http\Requests\API\GetSMSRequest;
use App\Http\Requests\API\GetStatusRequest;
use App\Services\PostBackSMSClient;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;

class GetStatusAction
{
    public function index(GetStatusRequest $request): JsonResponse
    {
        /** @var PostBackSMSClient $postbackSMS */
        $postbackSMS = App::make(PostBackSMSClient::class);
        $response = $postbackSMS->getStatus($request);

        return response()->json($response->json());
    }
}
