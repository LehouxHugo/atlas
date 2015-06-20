<?php

namespace ADM\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoreController extends Controller
{
    public function indexAction()
    {
        return $this->render('ADMCoreBundle:Core:index.html.twig');
    }


    public function testBasicLayoutAction()
    {
        return $this->render('ADMCoreBundle::BasicLayout.html.twig');
    }

    public function testOffCanvasLayoutAction()
    {
        return $this->render('ADMCoreBundle::OffCanvasLayout.html.twig');
    }

        public function testOutlookLayoutAction()
    {
        return $this->render('ADMCoreBundle::OutlookLayout.html.twig');
    }
}
