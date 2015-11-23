<?php

namespace Cpanel\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {        
        $this->layout('cpanel/layout/cpanel');
        
        return new ViewModel();
    }
}
