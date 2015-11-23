<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class LoginController extends AbstractActionController
{
    protected $mpayManager;

    public function indexAction()
    {
        $this->layout('layout/login');

        //die(__METHOD__);

        $cache = $this->getServiceLocator()->get('Mpay\Service\Cache');

        //echo $cache->getSessionId();

        //$op = $cache->getStorage()->getOptions();

        //var_dump($op);

        //$cache->set('aca', 'skara');

        //echo $cache->get('aca');

        //echo get_class($cache);

        //exit;




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
