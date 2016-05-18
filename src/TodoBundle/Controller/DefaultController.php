<?php

namespace TodoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $today = date('Y-m-d');

        $tasks = $this
            ->getDoctrine()
            ->getRepository('TodoBundle:Task')
            ->getFinishedTasks($today, $this->getUser());

        return $this->render('TodoBundle:Default:index.html.twig', array(
            'pagination' => $this->getPagination($request, $tasks),
        ));
    }

    private function getPagination($request, $tasks)
    {
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $tasks,
            $request->query->getInt('page', 1),
            2
        );

        return $pagination;
    }
}
