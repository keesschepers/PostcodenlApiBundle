<?php

namespace Keesschepers\PostcodenlApiBundle;

use Guzzle\Http\Client;

class ApiService
{
    /**
     * @var \Guzzle\Http\Client
     */
    private $client;

    private $apiUser;

    private $apiSecret;

    private $timeout = 2000;

    public function __construct(Client $client, $baseUrl, $apiUser, $apiSecret) {
        $this->client = $client;
        $this->baseUrl = $baseUrl;
        $this->apiUser = $apiUser;
        $this->apiSecret = $apiSecret;
    }

    public function getResponseByPostcodeAndHousenumber($postalcode, $housenr)
    {
        $this->client->setConfig(
            array(
                'request.options' => array(
                    'auth' => array($this->apiUser, $this->apiSecret, 'Any')
                )
                'curl.options' => array(
                    'CURLOPT_CONNECTTIMEOUT_MS' => $this->timeout,
                    'CURLOPT_RETURNTRANSFER' => true,
                ),
            )
        );

        $url = sprintf(
            $this->baseUrl . '/%s/%s',
            $request->query->get('zipcode'),
            $request->query->get('address-number')
        )

        $request = $this->client->get($url);
        $response = $request->send();

        return $response->json();
    }
}
