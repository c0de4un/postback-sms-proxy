<?php

namespace App\Services;

use App\Http\Requests\API\GetNumberRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PostBackSMSClient
{
    const ACTION_GET_NUMBER = 'getNumber';

    private readonly string $baseUrl;
    private readonly string $token;

    public function __construct()
    {
        $this->baseUrl = config('services.postback-sms.api_url');
        $this->token = config('services.postback-sms.api_token');
    }

    public function getNumber(GetNumberRequest $request): Response
    {
        return $this->sendRequest([
            'action'   => self::ACTION_GET_NUMBER,
            'country'  => $request->country,
            'service'  => $request->service,
            'rent_time' => $request->rent_time ?? 0,
        ]);
    }

    private function sendRequest(array $params): Response
    {
        $response = [];
        try {
            $response = Http::get($this->baseUrl, [
                $params,
                ...[
                    'token' => $this->token,
                ],
            ]);
        } catch (\Throwable $ex)  {
            Log::error('ERROR: failed to send request'
                . PHP_EOL . 'PARAMS: ' . json_encode($params)
                . PHP_EOL . 'AT: ' . $ex->getTraceAsString()
            );
        }

        return $response;
    }
}
