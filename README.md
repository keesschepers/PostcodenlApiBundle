PostcodeNL Api Bundle
=====================

This bundle helps you integrating the [Postcode.nl API](http://api.postcode.nl) into your Symfony project. With this integrated
you can autocomplete street and places automaticly based on the user supploed postalcode and house number.

Installation
============

Add this bundle to your composer.json:

    {
        "require": {
            "keesschepers/postcodenl-api-bundle": "dev-master"
        }
    }

Second, add the bundle to your AppKernel.php:

    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Keesschepers\PostcodenlApiBundle\KeesschepersPostcodenlApiBundle(),
        );
    }

Third, you need to configure the bundle by adding the following to your config.yml:

    keesschepers_postcodenl_api:
        base_url: "https://api.postcode.nl/rest/addresses"
        timeout: 5
        api_user: %keesschepers_postcodenl_api.api_user%
        api_secret: %keesschepers_postcodenl_api.api_secret%

Where you can supply api_user and api_secret directly or like the example above in your parameters.yml (recommended).

And optionally import the routing.yml into your project:

    keesschepers_postcodenl_api:
        resource: "@KeesschepersPostcodenlApiBundle/Resources/config/routing.yml"
        prefix:   /

If you followed these steps correctly you should have access to the followin url:

    http://your.project.local/app_dev.php/get-postalcode-details?zipcode=0000XX&address-number=XX

Advance usage
=============

You can also use the service in your own controller:

    $api = $this->get('keesschepers_postcodenl_api.api');
    $response = $api->getResponseByPostcodeAndHousenumber($postalcode, $housenr);
