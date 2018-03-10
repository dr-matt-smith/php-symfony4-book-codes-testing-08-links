<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $template = 'default/index.html.twig';
        $args = [];
        return $this->render($template, $args);
    }

    /**
     * @Route("/about", name="about")
     */
    public function aboutAction()
    {
        $template = 'default/about.html.twig';
        $args = [];
        return $this->render($template, $args);
    }

}
