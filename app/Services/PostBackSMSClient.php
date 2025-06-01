<?php

namespace App\Services;

use App\Http\Requests\API\CancelNumberRequest;
use App\Http\Requests\API\GetNumberRequest;
use App\Http\Requests\API\GetSMSRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PostBackSMSClient
{
    const ACTION_GET_NUMBER = 'getNumber';
    const ACTION_GET_SMS = 'getSMS';
    const ACTION_CANCEL_NUMBER = 'cancelNumber';
    const ACTION_GET_STATUS = 'getStatus';

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

    public function getSMS(GetSMSRequest $request): Response
    {
        return $this->sendRequest([
            'action'     => self::ACTION_GET_SMS,
            'activation' => $request->activation,
        ]);
    }

    public function cancelNumber(CancelNumberRequest $request): Response
    {
        return $this->sendRequest([
            'action'     => self::ACTION_CANCEL_NUMBER,
            'activation' => $request->activation,
        ]);
    }

    public function getStatus(CancelNumberRequest $request): Response
    {
        return $this->sendRequest([
            'action'     => self::ACTION_GET_STATUS,
            'activation' => $request->activation,
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
