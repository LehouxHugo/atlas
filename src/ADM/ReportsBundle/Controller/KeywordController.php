<?php

namespace ADM\ReportsBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use ADM\ReportsBundle\Entity\Report;
use ADM\ReportsBundle\Form\ReportUpdateType;
use ADM\ReportsBundle\Form\ReportType;
use ADM\ReportsBundle\Entity\Keyword;
use ADM\ReportsBundle\Form\KeywordType;
use Symfony\Component\HttpFoundation\JsonResponse;


class KeywordController extends Controller
{
    public function createAction(Request $request)
    {
        $keyword = new Keyword();
        $form = $this->get('form.factory')->create(new KeywordType, $keyword);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($keyword);
            $em->flush();
            return $this->redirect($this->generateUrl('adm_keyword_create'));
        }

        return $this->render('ADMReportsBundle:Keyword:create.html.twig', array(
                'form' => $form->createView(),
            ));
    }

}