<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class TestController extends AbstractActionController
{
    protected $mpayManager;

    public function indexAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setVariables(array(
            //'result' => $result,
        ));

        return $viewModel;
    }

    public function statusAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setVariables(array(
            'accessToken'  => $this->getMpayManager()->getAccessToken(),
            'loggedInUser' => $this->getMpayManager()->getLoggedInUser(),
        ));

        return $viewModel;
    }

    public function flashAction()
    {
        $this->flashMessenger()->setNamespace('success')->addMessage('Item saved');
        $this->flashMessenger()->setNamespace('error')->addMessage('Item not saved');

        $viewModel = new ViewModel();

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
