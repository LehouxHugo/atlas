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
                    'class'    => 'ADMUserBundle:User',
                    'property' => 'label',
                    'multiple' => true
                ))
            ->add('keywords', 'entity', array(
                    'class'         => 'ADMReportsBundle:Keyword',
                    'property' => 'name',
                    'multiple' => true
                ))
            ->add('abstract', 'textarea', array('required'=>false))
            ->add('articleBody', 'textarea', array('required'=>false))
            ->add('latitude', 'number')
            ->add('longitude', 'number')
            ->add('country')
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
