<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class HomeController
 * @package App\Controller
 * @Route("/", name="veto_compar_")
 */
class HomeController extends AbstractController
{
    /**
     * @Route("home", name="home")
     */
    public function homePage()
    {
    return $this->render('home/home_page.html.twig');
    }
}
