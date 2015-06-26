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


class ReportController extends Controller
{
    public function createAction(Request $request)
    {
        $report = new Report();
        $form = $this->get('form.factory')->create(new ReportType, $report);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($report);
            $em->flush();
            return $this->redirect($this->generateUrl('adm_report_read', array('slug' => $report->getSlug())));
        }

        $keyword = new Keyword();
        $formKeyword = $this->get('form.factory')->create(new KeywordType, $keyword);

        return $this->render('ADMReportsBundle:Report:create.html.twig', array(
                'form' => $form->createView(),
                'formKeyword' => $formKeyword->createView(),
            ));
    }

    public function readAction(Report $report)
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('ADMReportsBundle:Report');

        return $this->render(
            'ADMReportsBundle:Report:read.html.twig',
            array(
                'report' => $report
            )
        );
    }

    public function updateAction(Report $report, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('ADMReportsBundle:Report');

        $form = $this->createForm(new ReportUpdateType(), $report);

        if ($form->handleRequest($request)->isValid()) {
            // Inutile de persister ici, Doctrine connait déjà notre rapport
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Annonce modifiée avec succès.');

            return $this->redirect($this->generateUrl('adm_report_read', array('slug' => $report->getSlug())));
        }

        $keyword = new Keyword();
        $formKeyword = $this->get('form.factory')->create(new KeywordType, $keyword);

        return $this->render(
            'ADMReportsBundle:Report:update.html.twig',
            array(
                'form'   => $form->createView(),
                'formKeyword' => $formKeyword->createView(),
                'report' => $report
            )
        );
    }


    /**
     * Add new keyword (that isn't yet in the database)
     */
    public function addNewKeywordAction()
    {
        $request = $this->container->get('request');

        if($request->isXmlHttpRequest()) {
            $kw = $request->request->get('kw');
            if($kw != ''){
                $em = $this->getDoctrine()->getManager();
                $keyword = new Keyword();
                $keyword->setName($kw);
                $em->persist($keyword);
                $em->flush();
            }

            $title = $request->request->get('title');

        }
        return $this->redirect($this->generateUrl('adm_report_create'));
    }

}