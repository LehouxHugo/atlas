<?php

namespace ADM\ReportsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OrganizationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name','text')
            ->add('legalName','text')
            ->add('email','email')
            ->add('telephone','text')
            ->add('url','url')
            ->add('foundingDate','collot_datetime',
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
            ->add('save',      'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ADM\ReportsBundle\Entity\Organization'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'adm_reportsbundle_organization';
    }
}
