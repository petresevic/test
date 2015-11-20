<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $t = $this->getServiceLocator()->get('Mpay\Service\MpayManager');

        var_dump($t); exit;

        /*
        $config = array(
            //'callbackUrl'    => 'http://example.com/callback.php',
            'siteUrl'         => 'http://rest.mpay.net/oauth',
            'requestTokenUrl' => 'http://rest.mpay.net/oauth/token',
            'consumerKey'     => 'WebApp',
            'consumerSecret'  => 'testapp',

        );
        $consumer = new \ZendOAuth\Consumer($config);
        //$consumer->
        $token = $consumer->getRequestToken();

        print_r($token);
        */
        return new ViewModel();
    }
}
