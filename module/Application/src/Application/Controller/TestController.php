<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class TestController extends AbstractActionController
{
    protected $mpayManager;

    public function indexAction()
    {

        $connector = $this->getMpayManager()->getConnector();
        $cache = $this->getServiceLocator()->get('Mpay\Service\Cache');

        //echo $connector->getAccessToken() . ' | ' . $connector->getUsername();

        //exit;


        $t = $this->getMpayManager()->userLoadProfile($connector->getUsername(), $connector->getAccessToken());



        exit;

        $username = 'chicoo';
        $password = '000000';
        $result   = $this->getMpayManager()->userLogin($username, $password);

        $viewModel = new ViewModel();
        $viewModel->setVariables(array(
            'result' => $result,
        ));

        return $viewModel;
    }

    /** @return \Mpay\Service\Manager\Manager */
    public function getMpayManager()
    {
        if (null === $this->mpayManager) {
            $this->mpayManager = $this->getServiceLocator()->get('Mpay\Service\Manager');
        }

        return $this->mpayManager;
    }
}
