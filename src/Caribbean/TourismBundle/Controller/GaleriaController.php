<?php

namespace Caribbean\TourismBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Caribbean\TourismBundle\Entity\Galeria;
use Caribbean\TourismBundle\Form\GaleriaType;

/**
 * Galeria controller.
 *
 * @Route("/galeria")
 */
class GaleriaController extends Controller
{

    /**
     * Lists all Galeria entities.
     *
     * @Route("/", name="galeria")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TourismBundle:Galeria')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Galeria entity.
     *
     * @Route("/", name="galeria_create")
     * @Method("POST")
     * @Template("TourismBundle:Galeria:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Galeria();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('galeria_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Galeria entity.
     *
     * @param Galeria $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Galeria $entity)
    {
        $form = $this->createForm(new GaleriaType(), $entity, array(
            'action' => $this->generateUrl('galeria_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Galeria entity.
     *
     * @Route("/new", name="galeria_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Galeria();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Galeria entity.
     *
     * @Route("/{id}", name="galeria_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TourismBundle:Galeria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Galeria entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Galeria entity.
     *
     * @Route("/{id}/edit", name="galeria_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TourismBundle:Galeria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Galeria entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Galeria entity.
    *
    * @param Galeria $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Galeria $entity)
    {
        $form = $this->createForm(new GaleriaType(), $entity, array(
            'action' => $this->generateUrl('galeria_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Galeria entity.
     *
     * @Route("/{id}", name="galeria_update")
     * @Method("PUT")
     * @Template("TourismBundle:Galeria:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TourismBundle:Galeria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Galeria entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('galeria_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Galeria entity.
     *
     * @Route("/{id}", name="galeria_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TourismBundle:Galeria')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Galeria entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('galeria'));
    }

    /**
     * Creates a form to delete a Galeria entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('galeria_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
