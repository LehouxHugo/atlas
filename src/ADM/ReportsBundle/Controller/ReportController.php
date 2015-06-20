<?php

namespace ADM\ReportsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use ADM\ReportsBundle\Entity\Report;


class ReportController extends Controller
{
    public function createAction(Request $request)
    {
        $report = new Report();
        $form = $this->get('form.factory')->createBuilder('form', $report)
            ->add('name', 'text')
            ->add('dateCreated', 'collot_datetime')
            ->add('articleBody', 'textarea', array('required'=>false))
            ->add('latitude', 'number')
            ->add('longitude', 'number')
            ->add('published', 'checkbox')
            ->add('save',      'submit')
            ->getForm()
        ;

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


}