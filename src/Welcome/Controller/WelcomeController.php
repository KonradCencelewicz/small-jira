<?php

namespace App\Welcome\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class WelcomeController extends AbstractController
{
    #[Route('/', name: 'app_welcome', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('Welcome/index.html.twig');
    }
}
