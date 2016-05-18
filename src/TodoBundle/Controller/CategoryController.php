<?php

namespace TodoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\VarDumper\VarDumper;
use TodoBundle\Entity\Category;
use TodoBundle\Form\Type\CategoryType;

class CategoryController extends Controller
{
    /**
     * @Route("/category/create", name="create_category")
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($category);
            $em->flush();

            $this->addFlash(
                'notice',
                'Category added with success'
            );

            return $this->redirect('/');
        }

        return $this->render('TodoBundle:Category:create.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/category/list", name="list_category")
     */
    public function listAction()
    {
        $categories = $this->getDoctrine()->getRepository('TodoBundle:Category')->findAll();

        return $this->render('TodoBundle:Category:list.html.twig', array(
            'categories' => $categories,
        ));
    }

    /**
     * @Route("/category/delete/{id}", requirements={"id" = "\d+"}, name="delete_category")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $category = $em->getRepository('TodoBundle:Category')
            ->find($id);

        $tasks = $this
            ->getDoctrine()
            ->getRepository('TodoBundle:Task')
            ->getTasksByCategoryAndUser(
                $this->getUser(),
                $id,
                "label",
                "asc"
            );

        if(empty($tasks)) {
            $em->remove($category);
            $em->flush();

            $this->addFlash(
                'notice',
                'Category deleted with success'
            );
        }
        else {
            $this->addFlash(
                'warning',
                'Category contains task(s) and could not be deleted'
            );
        }

        return $this->redirectToRoute('list_category');
    }


}
