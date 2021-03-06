<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomePageController extends AbstractController
{
    /**
     * @Route("/", name="home_page")
     */
    public function index()
    {
        return $this->render('default/homepage.html.twig');
    }

    /**
     * @Route("/console-info", name="console_info")
     */
    public function consoleVersionInfo()
    {
        return $this->render('default/console-version-info.html.twig');
    }
}