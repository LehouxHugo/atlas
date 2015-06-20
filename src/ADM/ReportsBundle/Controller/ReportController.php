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
            ->add('dateCreated', 'collot_datetime', array( 'pickerOptions' =>
                    array('format' => 'yyyy',
                        'weekStart' => 0,
                        'endDate' => date('Y'),
                        'autoclose' => true,
                        'startView' => 'decade',
                        'minView' => 'decade',
                        'maxView' => 'decade',
                        'keyboardNavigation' => true,
                        'language' => 'fr',
                        'forceParse' => true,
                        'pickerPosition' => 'bottom-right',
                        'viewSelect' => 'decade',
                        'showMeridian' => false,
                        'initialDate' => date('Y'),
                    )))
            ->add('articleBody', 'textarea', array('required'=>false))
            ->add('latitude', 'number')
            ->add('longitude', 'number')
            ->add('published', 'checkbox')
            ->add('save',      'submit')
            ->getForm()
        ;

        $form->handleRequest($request);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($report);
            $em->flush();

            return $this->redirect($this->generateUrl('adm_report_create'));
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