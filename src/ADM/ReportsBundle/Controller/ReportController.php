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
use Ps\PdfBundle\Annotation\Pdf;


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

        return $this->render(
            'ADMReportsBundle:Report:create.html.twig',
            array(
                'form' => $form->createView(),

            )
        );
    }

    /**
     * Possible custom headers and external stylesheet file
     *
     * @Pdf(
     * 	headers={"Expires"="Sat, 1 Jan 2000 12:00:00 GMT"},
     * 	stylesheet="PsPdfBundle:Example:pdfStylesheet.xml.twig",
     *  enableCache=false
     * )
     */
    public function readAction(Report $report)
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('ADMReportsBundle:Report');

        $format = $this->get('request')->get('_format');

        return $this->render(
            sprintf('ADMReportsBundle:Report:read.%s.twig', $format),
            array(
                'report' => $report,
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
                'form' => $form->createView(),
                'formKeyword' => $formKeyword->createView(),
                'report' => $report
            )
        );
    }


    /**
     * @Pdf()
     */
    public function readPDF(Report $report)
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('ADMReportsBundle:Report');

        $format = $this->get('request')->get('_format');

        return $this->render(
            sprintf('ADMReportsBundle:Report:read.%s.twig', $format),
            array(
                'report' => $report,
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

        if ($request->isXmlHttpRequest()) {
            $logger->info('Reconnaît Ajax Request');
            if ($kw != '') {
                $em = $this->getDoctrine()->getManager();
                $keyword = new Keyword();
                $keyword->setName($kw);
                $em->persist($keyword);
                $em->flush();
                $logger->error('Entité entrée en base de donnée');

                $newkeyword = $em->getRepository('ADMReportsBundle:Keyword')
                    ->findOneBy(array('name' => $kw));
                $response = new JsonResponse();

                return $response->setData(array('newkeyword' => $newkeyword));
            }
        } else {
            throw new \Exception("Erreur");
        }
    }

    public function listReportsByKeywordAction($label)
    {

        $keywordName = array($label);

        $listReports = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('ADMReportsBundle:Report')
            ->getReportsWithKeyword($keywordName);

        $keyword = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('ADMReportsBundle:Keyword')
            ->findOneByLabel($label);

        return $this->render(
            'ADMReportsBundle:Report:listReportsByKeyword.html.twig',
            array(
                'listReports' => $listReports,
                'keyword' => $keyword
            )
        );
    }

}