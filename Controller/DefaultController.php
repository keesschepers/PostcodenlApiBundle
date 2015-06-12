<?php

namespace Keesschepers\PostcodenlApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Guzzle\Http\Exception\ClientErrorResponseException;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $api = $this->get('keesschepers_postcodenl_api.api');

        try {
            $response = $api->getResponseByPostcodeAndHousenumber(
                    $request->query->get('zipcode'),
                    $request->query->get('address-number')
            );
        } catch (ClientErrorResponseException $e) {
            return new Response('The given zipcode and address number didnt result in a address.', 400);
        }

        return new JsonResponse($response);
    }
}
