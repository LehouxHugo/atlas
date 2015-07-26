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
     * @Pdf(
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
        // Set right images paths to generate PDFs, doesn't work on localhost
        if($format=="pdf") {
            $oldArticleBody = preg_replace('/(alt|width|height)=("[^"]*")/','',$report->getArticleBody());
            $pattern = preg_quote("http://".$_SERVER['HTTP_HOST'], '/');
            $replacement = preg_replace('/\/app\/\.\./','',$this->get('kernel')->getRootDir() . '/../web');
            $report->setArticleBody(preg_replace('/'. $pattern .'/',$replacement , $oldArticleBody));
        }

        return $this->render(
            sprintf('ADMReportsBundle:Report:read.%s.twig', $format),
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
            $em->flush(); // Inutile de persister

            return $this->redirect($this->generateUrl(
                    'adm_report_read',
                    array(
                        'slug' => $report->getSlug()
                    )
                )
            );
        }

        return $this->render(
            'ADMReportsBundle:Report:update.html.twig',
            array(
                'form' => $form->createView(),
                'report' => $report
            )
        );
    }

    public function deleteAction(Report $report)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('ADMReportsBundle:Report');
        $em->remove($report);
        $em->flush();
        // Rajouter un flash bag pour annoncer que le rapport a bien été supprimé

        return $this->render('ADMCoreBundle:Core:index.html.twig');
    }



    public function listReportsByKeywordAction(Keyword $keyword)
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em
            ->getRepository('ADMReportsBundle:Keyword');
        $listReports = $em
            ->getRepository('ADMReportsBundle:Report')
            ->getReportsWithKeyword(array($keyword->getLabel()));

        return $this->render(
            'ADMReportsBundle:Report:listReportsByKeyword.html.twig',
            array(
                'listReports' => $listReports,
                'keyword' => $keyword
            )
        );
    }

}