<?php

namespace ADM\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ADMUserBundle:Default:index.html.twig');
    }
}
