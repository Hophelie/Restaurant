<?php

namespace App\Controller;

use App\Repository\RestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AcceuilController extends AbstractController
{
    /**
     * @Route("/", name="acceuil")
     */
    public function index(RestaurantRepository $restaurantRepository): Response
    {   
        return $this->render('acceuil/index.html.twig', [
            'restaurants' => $restaurantRepository->findAll(),
         
        ]);
    }
}
