<?php

namespace ADM\ReportsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReportType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text')
            ->add('dateCreated', 'collot_datetime',
                array( 'pickerOptions' =>
                    array('format' => 'yyyy',
                        'endDate' => date('Y'),
                        'autoclose' => true,
                        'startView' => 'decade',
                        'minView' => 'decade',
                        'maxView' => 'decade',
                        'todayBtn' => false,
                        'todayHighlight' => false,
                        'keyboardNavigation' => true,
                        'language' => 'fr',
                        'forceParse' => true,
                        'pickerPosition' => 'bottom-right',
                        'viewSelect' => 'decade',
                        'showMeridian' => false,
                    )))
            ->add('authors', 'entity', array(
                    'required'=>false,
                    'class'    => 'ADMUserBundle:User',
                    'property' => 'label',
                    'multiple' => true
                ))
            ->add('organizations', 'entity', array(
                    'required'=>false,
                    'class'    => 'ADMReportsBundle:Organization',
                    'property' => 'legalName',
                    'multiple' => true
                ))
            ->add('keywords', 'entity', array(
                    'required'=>false,
                    'class'         => 'ADMReportsBundle:Keyword',
                    'property' => 'name',
                    'multiple' => true
                ))
            ->add('abstract', 'textarea', array('required'=>false))
            ->add('articleBody', 'textarea', array('required'=>false))
            ->add('latitude', 'number', array(
                    'scale' => 12,
                    'precision' => 12
                ))
            ->add('longitude', 'number', array(
                    'scale' => 12,
                    'precision' => 12
                ))
            ->add('country', 'text', array('required'=>false))
            ->add('published', 'checkbox')
            ->add('save',      'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ADM\ReportsBundle\Entity\Report'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'adm_reportsbundle_report';
    }
}
