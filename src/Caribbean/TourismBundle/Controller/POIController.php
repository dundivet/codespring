<?php

namespace Caribbean\TourismBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Caribbean\TourismBundle\Entity\POI;
use Caribbean\TourismBundle\Form\POIType;

/**
 * POI controller.
 *
 * @Route("/poi")
 */
class POIController extends Controller
{

    /**
     * Lists all POI entities.
     *
     * @Route("/", name="poi")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $qb = $this->get('doctrine.orm.entity_manager')->createQueryBuilder();

        $entities = $qb->select('d')
            ->from('TourismBundle:POI', 'd');

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $entities,
            $request->query->get('page', 1),
            10
        );

        return  $this->render('@Tourism/POI/index.html.twig', array(
            'entities' => $pagination
        ));
    }
    /**
     * Creates a new POI entity.
     *
     * @Route("/", name="poi_create")
     * @Method("POST")
     * @Template("TourismBundle:POI:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new POI();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('poi_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a POI entity.
     *
     * @param POI $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(POI $entity)
    {
        $form = $this->createForm(new POIType(), $entity, array(
            'action' => $this->generateUrl('poi_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new POI entity.
     *
     * @Route("/new", name="poi_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new POI();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a POI entity.
     *
     * @Route("/{id}", name="poi_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TourismBundle:POI')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find POI entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
        );
    }

    /**
     * Displays a form to edit an existing POI entity.
     *
     * @Route("/{id}/edit", name="poi_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TourismBundle:POI')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find POI entity.');
        }

        $editForm = $this->createEditForm($entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
    * Creates a form to edit a POI entity.
    *
    * @param POI $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(POI $entity)
    {
        $form = $this->createForm(new POIType(), $entity, array(
            'action' => $this->generateUrl('poi_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar'));

        return $form;
    }
    /**
     * Edits an existing POI entity.
     *
     * @Route("/{id}", name="poi_update")
     * @Method("PUT")
     * @Template("TourismBundle:POI:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TourismBundle:POI')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find POI entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('poi_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a POI entity.
     *
     * @Route("/{id}", name="poi_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TourismBundle:POI')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find POI entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('poi'));
    }

    /**
     * Creates a form to delete a POI entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('poi_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar'))
            ->getForm()
        ;
    }
}
