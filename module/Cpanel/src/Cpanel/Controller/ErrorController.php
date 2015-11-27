<?php

namespace Cpanel\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ErrorController extends AbstractActionController
{
    public function error403Action()
    {
        $this->getResponse()->setStatusCode(403);

        $viewModel = new ViewModel();
        $viewModel->setVariables(array(

        ));

        return $viewModel;
    }
}
