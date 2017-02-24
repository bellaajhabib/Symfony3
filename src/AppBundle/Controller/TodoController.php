<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Todo;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\DateTime;


class TodoController extends Controller
{
    /**
     * @Route("/todos", name="todo_list")
     */
    public function listAction()
    {
        $todos = $this->getDoctrine()
            ->getRepository('AppBundle:Todo')
            ->findAll();
        // replace this example code with whatever you need
        // Test AppBundle
        return $this->render('todo/index.html.twig'
            , array('todos' => $todos)
        );
    }

    /**
     * @Route("todos/create",name="todo_create")
     */
    public function createAction(Request $request)
    {
        $todo = new Todo();
        $form = $this->createFormBuilder($todo)
            ->add('name', TextType::class,
                array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('category', TextType::class,
                array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('description', TextareaType::class,
                array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('priorit', ChoiceType::class, array(
                'choices' => array('Low' => 'Low', 'Hight' => 'Hight'),
                'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')
            ))
            ->add('due_dae', DateTimeType::class,
                array('attr' => array('class' => '', 'style' => 'margin-bottom:15px')))
            ->add('save', SubmitType::class, array(
                'label' => 'Create Todo',
                'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-top:25px')
            ))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Get Data
            $name = $form['name']->getData();
            $cateory = $form['category']->getData();
            $description = $form['description']->getData();
            $priorit = $form['priorit']->getData();
            $dueDae = $form['due_dae']->getData();
            $now = new \DateTime("now");
            $todo->setName($name);
            $todo->setCategory($cateory);
            $todo->setDescription($description);
            $todo->setPriorit($priorit);
            $todo->setDueDae($dueDae);
            $todo->setCreateDate($now);
            $em = $this->getDoctrine()->getManager();
            $em->persist($todo);
            $em->flush();
            $this->addFlash(
                'notice', 'Todo Added'
            );

            return $this->redirectToRoute('todo_list');

        }

        return $this->render('todo/create.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route ("todos/edit/{id}",name="edit_todo")
     */
    public function editAction($id, Request $request)
    {
        $todo = $this->getDoctrine()
            ->getRepository('AppBundle:Todo')
            ->find($id);
        $now = new \DateTime("now");
        $todo->setName($todo->getName());
        $todo->setCategory($todo->getCategory());
        $todo->setDescription($todo->getDescription());
        $todo->setPriorit($todo->getPriorit());
        $todo->setDueDae($todo->getDueDae());
        $todo->setCreateDate($now);



        $em = $this->getDoctrine()->getManager();
        $todo=$em->getRepository('AppBundle:Todo')->find($id);


        $form = $this->createFormBuilder($todo)
            ->add('name', TextType::class,
                array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('category', TextType::class,
                array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('description', TextareaType::class,
                array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('priorit', ChoiceType::class, array(
                'choices' => array('Low' => 'Low', 'Hight' => 'Hight'),
                'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')
            ))
            ->add('due_dae', DateTimeType::class,
                array('attr' => array('class' => '', 'style' => 'margin-bottom:15px')))
            ->add('save', SubmitType::class, array(
                'label' => 'Update Todo',
                'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-top:25px')
            ))
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $todo = $this->getDoctrine()
                ->getRepository('AppBundle:Todo')
                ->find($id);

            $todo->setName($todo->getName());
            $todo->setCategory($todo->getCategory());
            $todo->setDescription($todo->getDescription());
            $todo->setPriorit($todo->getPriorit());
            $todo->setDueDae($todo->getDueDae());
            $todo->setCreateDate($now);

            $em->flush();
            $this->addFlash(
                'notice', 'Todo Update'
            );

            return $this->redirectToRoute('todo_list');

        }

        return $this->render('todo/edit.html.twig',array('todo'=>$todo,'form'=>$form->createView()));
    }

    /**
     * @Route ("todos/details/{id}",name="details_todo")
     */
    public function detailsAction($id)
    {

        $todos = $this->getDoctrine()
            ->getRepository('AppBundle:Todo')->find($id);

        return $this->render('todo/details.html.twig', array('todo' => $todos));
    }
    /**
     *@Route ("todos/delete/{id}",name="details_delete")
     */
    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $todo=$em->getRepository('AppBundle:Todo')->find($id);
        $em->remove($todo);
        $em->flush();
        $this->addFlash(
          'notice', 'Todo Remove'
        );
        return $this->redirectToRoute('todo_list');

    }
}
