<?php

namespace ADM\ReportsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReportUpdateType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

    }
    


    /**
     * @return string
     */
    public function getName()
    {
        return 'adm_reportsbundle_report_update';
    }

    public function getParent()
    {
        return new ReportType();
    }
}
