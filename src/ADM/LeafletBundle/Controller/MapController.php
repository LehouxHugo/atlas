<?php

namespace ADM\LeafletBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MapController extends Controller
{
    public function viewWorldMapAction()
    {
        #Récupérer les rapports de stage
        $repository = $this->getDoctrine()
          ->getManager()
          ->getRepository('ADMReportsBundle:Report');

          $listReports = $repository->findAll();

        return $this->render('ADMLeafletBundle:Maps:viewWorldMap.html.twig', array(
      'listReports' => $listReports
    ));
    }

        public function viewWorldMaptestAction()
    {
        #Récupérer les rapports de stage
        $repository = $this->getDoctrine()
          ->getManager()
          ->getRepository('ADMReportsBundle:Report');

          $listReports = $repository->findAll();

        return $this->render('ADMLeafletBundle:Maps:viewWorldMapTest.html.twig', array(
      'listReports' => $listReports
    ));
    }
}
