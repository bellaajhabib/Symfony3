<?php

namespace MainBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Choice;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MainBundle:Default:index.html.twig');
    }
    public function testAction(Request $request)
    {  $name=$email=$objet=NULL;
        $form= $this->createFormBuilder()
            ->add('name')
            ->add('email')
            ->add('objet',ChoiceType::class,array('choices'=>array('choice'=>array(''=>null,'Yes'=>"Yes"))))
            ->add('send',SubmitType::class,array('label'=>'Ok'))
            ->getForm();
        $form->handleRequest($request);
        if($form->isValid()){
            $name=$form["name"]->getData();
            $email=$form["email"]->getData();
            $objet=$form["objet"]->getData();



        }

        return $this->render('MainBundle:Default:test.html.twig',array('form'=>$form->createView(),
                                                                                               'name'=>$name,
                                                                                               'email'=>$email,
                                                                                                'objet'=>$objet ));
    }
}
