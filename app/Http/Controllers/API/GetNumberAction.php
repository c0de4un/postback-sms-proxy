<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\GetNumberRequest;
use App\Services\PostBackSMSClient;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;

class GetNumberAction
{
    public function index(GetNumberRequest $request): JsonResponse
    {
        /** @var PostBackSMSClient $postbackSMS */
        $postbackSMS = App::make(PostBackSMSClient::class);
        $response = $postbackSMS->getNumber($request);

        return response()->json($response->json());
    }
}
