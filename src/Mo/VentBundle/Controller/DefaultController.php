<?php

namespace Mo\VentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MoVentBundle:Default:index.html.twig');
    }
}
