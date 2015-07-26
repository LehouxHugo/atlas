<?php
// src/ADM/ReportsBundle/Admin/OrganizationAdmin.php

namespace ADM\ReportsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class OrganizationAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text', array('label' => 'Nom'))
            ->add('legalName','text', array('label' => 'Nom complet'))
            ->add('foundingDate','date',array('label' => 'Date de fondation'))
            ->add('email','email', array('label' => 'Email'))
            ->add('telephone','text', array('label' => 'Téléphone'))
            ->add('url','url', array('label' => 'URL'))

        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('legalName')
            ->add('foundingDate')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('legalName')
            ->add('foundingDate')
        ;
    }
}