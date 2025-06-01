<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CancelNumberRequest;
use App\Http\Requests\API\GetSMSRequest;
use App\Services\PostBackSMSClient;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;

class CancelNumberAction
{
    public function index(CancelNumberRequest $request): JsonResponse
    {
        /** @var PostBackSMSClient $postbackSMS */
        $postbackSMS = App::make(PostBackSMSClient::class);
        $response = $postbackSMS->cancelNumber($request);

        return response()->json($response->json());
    }
}
