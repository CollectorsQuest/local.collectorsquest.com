<?php

namespace CollectorsQuest\LocalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TheTwelve\Foursquare;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CollectorsQuestLocalBundle:Default:index.html.twig');
    }

    public function connectAction()
    {
        $client = new Foursquare\HttpClient\SymfonyHttpClient();

        $factory = new Foursquare\ApiGatewayFactory($client);
        $factory->setEndpointUri('https://api.foursquare.com');
        $factory->useVersion(2);

        $auth = $factory->getAuthenticationGateway(
            $this->container->parameters['foursquare_id'],
            $this->container->parameters['foursquare_secret'],
            'https://foursquare.com/oauth2/authorize',
            'https://foursquare.com/oauth2/access_token',
            'http://local.collectorsquest.dev/app.php/callback'
        );

        return $auth->initiateLogin();
    }

    public function callbackAction()
    {
        $client = new Foursquare\HttpClient\SymfonyHttpClient();

        $factory = new Foursquare\ApiGatewayFactory($client);
        $factory->setEndpointUri('https://api.foursquare.com');
        $factory->useVersion(2);

        $auth = $factory->getAuthenticationGateway(
            $this->container->parameters['foursquare_id'],
            $this->container->parameters['foursquare_secret'],
            'https://foursquare.com/oauth2/authorize',
            'https://foursquare.com/oauth2/access_token',
            'http://local.collectorsquest.dev/app.php/callback'
        );

        $token = $auth->authenticateUser($_GET['code']);

        $factory->setToken($token);
        $gateway = $factory->getUsersGateway();
        $user = $gateway->getUser();

        $user->
        print_r($user); exit;
    }

    public function privacyAction()
    {
        return $this->render('CollectorsQuestLocalBundle:Default:privacy.html.twig');
    }
}
