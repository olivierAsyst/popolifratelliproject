<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/donation')]
class DonationController extends AbstractController
{
    #[Route('/', name: 'app_donation', methods: ['GET'])]
    public function donation(): Response
    {
        
            return $this->render('istm_index/filieres/donation.html.twig', [
                'title' => "Faire un don",
            ]);
    }
}