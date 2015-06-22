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
                        'autoclose' => false,
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
                    'property' => 'username',
                    'multiple' => true
                ))
            ->add('articleBody', 'textarea', array('required'=>false))
            ->add('latitude', 'number')
            ->add('longitude', 'number')
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
