<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TodoController extends Controller
{
    /**
     * @Route("/", name="todo_list")
     */
    public function listAction()
    {
        // replace this example code with whatever you need
        // Test AppBundle
        return $this->render('todo/index.html.twig');
    }
    /**
     * @Route("todos/create",name="todo_create")
     */
    public function createAction(){
        return $this->render('todo/create.html.twig');
    }

    /**
     * @Route ("todos/edit/{id}",name="edit_todo")
     */
    public function  editAction($id,Request $request){
        return $this->render('todo/edit.html.twig');
    }
    /**
     * @Route ("todos/details/{id}",name="details_todo")
     */
    public function  detailsAction($id,Request $request){
        return $this->render('todo/details.html.twig');
    }
}
