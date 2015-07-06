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

        return $this->render('ADMReportsBundle:Report:create.html.twig', array(
                'form' => $form->createView(),

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
    public function addNewKeywordAction(Request $request, $kw)
    {
        $logger = $this->get('logger');
        $logger->info('Nous avons récupéré le logger');

        if($request->isXmlHttpRequest()) {
            $logger->info('Reconnaît Ajax Request');
            if($kw != ''){
                $em = $this->getDoctrine()->getManager();
                $keyword = new Keyword();
                $keyword->setName($kw);
                $em->persist($keyword);
                $em->flush();
                $logger->error('Entité entrée en base de donnée');

                $newkeyword = $em->getRepository('ADMReportsBundle:Keyword')
                                 ->findOneBy(array('name' => $kw ));
                $response = new JsonResponse();
                return $response->setData(array('newkeyword' => $newkeyword));
            }
        }else{
            throw new \Exception("Erreur");
        }
    }

    public function listReportsByKeywordAction()
    {
            $listReports= $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('ADMReportsBundle:Report')
            ->getReportsWithKeywords(array('Inde'))
            ;

        return $this->render(
            'ADMReportsBundle:Report:listReportsByKeyword.html.twig',
            array(
                'listReports' => $listReports
            )
        );
    }

}