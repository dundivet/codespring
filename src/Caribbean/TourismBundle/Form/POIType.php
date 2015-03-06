<?php

namespace Caribbean\TourismBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class POIType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('descripcion')
            ->add('direccion')
            ->add('contacto')
            ->add('ciudad')
            ->add('latitud')
            ->add('longitud')
            ->add('rating')
            ->add('etiquetas')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Caribbean\TourismBundle\Entity\POI'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'caribbean_tourismbundle_poi';
    }
}
