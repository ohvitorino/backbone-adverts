<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Ad;
use AppBundle\Form\AdType;

/**
 * Ad controller.
 *
 * @Route("/ads")
 */
class AdController extends Controller
{

    /**
     * Lists all Ad entities.
     *
     * @Route("/", name="ad")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Ad')->findAll();

        return new JsonResponse(
            $entities
        );
    }

    /**
     * Creates a new Ad entity.
     *
     * @Route("/", name="ad_create")
     * @Method("POST")
     * @param Request $request
     * @return JsonResponse
     */
    public function createAction(Request $request)
    {
        $entity = new Ad();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return new JsonResponse($entity);
        }

        return new JsonResponse(null, 404);
    }

    /**
     * Creates a form to create a Ad entity.
     *
     * @param Ad $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Ad $entity)
    {
        $form = $this->createForm(
            new AdType(),
            $entity,
            array(
                'action' => $this->generateUrl('ad_create'),
                'method' => 'POST',
            )
        );

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Finds and displays a Ad entity.
     *
     * @Route("/{id}", name="ad_show")
     * @Method("GET")
     * @Template()
     * @param $id
     * @return array
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Ad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ad entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Creates a form to edit a Ad entity.
     *
     * @param Ad $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Ad $entity)
    {
        $form = $this->createForm(
            new AdType(),
            $entity,
            array(
                'action' => $this->generateUrl('ad_update', array('id' => $entity->getId())),
                'method' => 'PUT',
            )
        );

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Ad entity.
     *
     * @Route("/{id}", name="ad_update")
     * @Method("PUT")
     * @Template("AppBundle:Ad:edit.html.twig")
     * @param Request $request
     * @param $id
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Ad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ad entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('ad_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Ad entity.
     *
     * @Route("/{id}", name="ad_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Ad')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Ad entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ad'));
    }

    /**
     * Creates a form to delete a Ad entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ad_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }
}
