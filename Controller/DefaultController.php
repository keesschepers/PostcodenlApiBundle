<?php

namespace Keesschepers\PostcodenlApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $api = $this->get('keesschepers_postcodenl_api.api');
        $response = $api->getResponseByPostcodeAndHousenumber(
                $request->query->get('zipcode'),
                $request->query->get('address-number')
        );

        return new JsonResponse($response);
    }
}
