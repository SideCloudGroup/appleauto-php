<?php

namespace AppleAutoShare;

use Exception;
use GuzzleHttp\Client as HttpClient;

class SharePage
{
    public array $accounts = array();
    public ?string $errorMsg = null;
    protected string $shareURL;

    public function __construct(string $shareURL)
    {
        $this->shareURL = $shareURL;
        $this->getSharePage();
    }

    private function getSharePage(): void
    {
        $client = new HttpClient();
        try {
            $response = $client->request('GET', $this->shareURL, [
                'timeout' => 5,
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);
            // Check if the response is 200
            if ($response->getStatusCode() !== 200) {
                $this->errorMsg = "Error: response {$response->getStatusCode()}";
                return;
            } else {
                $data = json_decode($response->getBody(), true);
                // Check if the response is valid JSON
                if (json_last_error() !== JSON_ERROR_NONE) {
                    $this->errorMsg = 'Error: invalid JSON';
                    return;
                }
                if (!$data['status']) {
                    $this->errorMsg = $data['msg'];
                    return;
                }
                $this->accounts = $data['accounts'];
            }
        } catch (Exception $e) {
            $this->errorMsg = $e->getMessage();
        }
    }
}