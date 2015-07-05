<?php

namespace ADM\ReportsBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use ADM\ReportsBundle\Entity\Report;
use ADM\ReportsBundle\Entity\Organization;
use ADM\ReportsBundle\Form\OrganizationType;

use Symfony\Component\HttpFoundation\JsonResponse;


class OrganizationController extends Controller
{
    public function createAction(Request $request)
    {
        $organization = new Organization();
        $form = $this->get('form.factory')->create(new OrganizationType, $organization);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($organization);
            $em->flush();
            return $this->redirect($this->generateUrl('adm_organization_read', array('label' => $organization->getLabel())));
        }

        return $this->render('ADMReportsBundle:Organization:create.html.twig', array(
                'form' => $form->createView(),

            ));
    }

    public function readAction(Organization $organization)
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('ADMReportsBundle:Organization');

        return $this->render(
            'ADMReportsBundle:Organization:read.html.twig',
            array(
                'organization' => $organization
            )
        );
    }

    public function updateAction(Organization $organization, Request $request)
    {


        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('ADMReportsBundle:Organization');

        $form = $this->createForm(new OrganizationType(), $organization);

        if ($form->handleRequest($request)->isValid()) {
            // Inutile de persister ici, Doctrine connait déjà notre rapport
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Organisation modifiée avec succès.');

            return $this->redirect($this->generateUrl('adm_organization_read', array('label' => $organization->getLabel())));
        }


        return $this->render(
            'ADMReportsBundle:Organization:update.html.twig',
            array(
                'form'   => $form->createView(),
                'organization' => $organization
            )
        );
    }




}