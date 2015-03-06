<?php

namespace Caribbean\TourismBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ComentarioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cuerpo')
            ->add('fecha')
            ->add('likes')
            ->add('dislikes')
            ->add('poi')
            ->add('usuario')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Caribbean\TourismBundle\Entity\Comentario'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'caribbean_tourismbundle_comentario';
    }
}
