<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Shop;
use AppBundle\Form\ShopType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Shop controller.
 *
 * @Route("/shop")
 */
class ShopController extends Controller
{
    /**
     * Lists all Shop entities.
     *
     * @Route("/", name="app_shop_index")
     * @Template()
     * @Method("GET")
     * @return array
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $shops = $em->getRepository('AppBundle:Shop')->findAll();

        return compact('shops');
    }

    /**
     * Creates a new Shop entity.
     *
     * @Route("/new", name="app_shop_new")
     * @param Request $request
     * @Template()
     * @Method({"GET", "POST"})
     * @return array
     */
    public function newAction(Request $request)
    {
        $shop = new Shop();
        $form = $this->createForm('AppBundle\Form\ShopType', $shop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($shop);
            $em->flush();

            $this->addFlash(
                'success',
                "Shop with ID#{$shop->getId()} was successfull saved!"
            );

            return $this->redirectToRoute('app_shop_index', array('id' => $shop->getId()));
        }

        return [
            'shop' => $shop,
            'form' => $form->createView()
        ];
    }

    /**
     * Finds and displays a Shop entity.
     *
     * @Route("/{id}", name="app_shop_show")
     * @param Request $request
     * @param Shop $shop
     * @Template()
     * @Method("GET")
     * @return array
     */
    public function showAction(Request $request, Shop $shop)
    {
        $deleteForm = $this->createDeleteForm($shop);

        return [
            'shop' => $shop,
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Displays a form to edit an existing Shop entity.
     *
     * @Route("/{id}/edit", name="app_shop_edit")
     * @Template()
     * @param Request $request
     * @param Shop $shop
     * @Method({"GET", "POST"})
     * @return array
     */
    public function editAction(Request $request, Shop $shop)
    {
        $deleteForm = $this->createDeleteForm($shop);
        $editForm = $this->createForm('AppBundle\Form\ShopType', $shop);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($shop);
            $em->flush();

            $this->addFlash(
                'success',
                "Shop with ID#{$shop->getId()} was successfull edited!"
            );

            return $this->redirectToRoute('app_shop_index', array('id' => $shop->getId()));
        }

        return [
            'shop' => $shop,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Deletes a Shop entity.
     *
     * @Route("/{id}", name="app_shop_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Shop $shop)
    {
        $form = $this->createDeleteForm($shop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($shop);
            $em->flush();
        }

        return $this->redirectToRoute('app_shop_index');
    }

    /**
     * Creates a form to delete a Shop entity.
     *
     * @param Shop $shop The Shop entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Shop $shop)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('app_shop_delete', array('id' => $shop->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
