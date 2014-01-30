<?php

namespace Keesschepers\PostcodenlApiBundle\Service;

use Guzzle\Http\Client;

class ApiService
{
    /**
     * @var \Guzzle\Http\Client
     */
    private $client;

    /**
     * @var string
     */
    private $apiUser;

    /**
     * @var string
     */
    private $apiSecret;

    /**
     * @var integer
     */
    private $timeout = 2000;

    /**
     * Constructor.
     *
     * @param \Guzzle\Http\Client $client
     * @param string              $baseUrl
     * @param string              $apiUser
     * @param string              $apiSecret
     */
    public function __construct(Client $client, $baseUrl, $apiUser, $apiSecret) {
        $this->client = $client;
        $this->baseUrl = $baseUrl;
        $this->apiUser = $apiUser;
        $this->apiSecret = $apiSecret;
    }

    /**
     * Get a array containing location information of the postalcode / housenr supplied.
     *
     * @param string $postalcode
     * @param string $housenr
     *
     * @return array
     */
    public function getResponseByPostcodeAndHousenumber($postalcode, $housenr)
    {
        $this->client->setConfig(
            array(
                'curl.options' => array(
                    'CURLOPT_CONNECTTIMEOUT_MS' => $this->timeout,
                    'CURLOPT_RETURNTRANSFER' => true,
                ),
            )
        );

        $url = sprintf(
            $this->baseUrl . '/%s/%s',
            $postalcode,
            $housenr
        );

        $request = $this
            ->client
            ->get($url)
            ->setAuth($this->apiUser, $this->apiSecret);

        $response = $request->send();

        return $response->json();
    }
}
