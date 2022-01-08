<?php

namespace App\Controller;

use App\Entity\CommandeProducts;
use App\Entity\Produit;
use App\Entity\Commande;
use App\Form\CommandeProductsType;
use App\Repository\CommandeProductsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/commande/products")
 */
class CommandeProductsController extends AbstractController
{
    /**
     * @Route("/", name="commande_products_index", methods={"GET"})
     */
    public function index(CommandeProductsRepository $commandeProductsRepository): Response
    {
        return $this->render('commande_products/index.html.twig', [
            'commande_products' => $commandeProductsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{id}", name="commande_products_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager, Produit $produit): Response
    {
        $commandeProduct = new CommandeProducts();
        $form = $this->createForm(CommandeProductsType::class, $commandeProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commandeProduct->setProduit($produit)
            ->setUser($this->getUser());
            $entityManager->persist($commandeProduct);
            $entityManager->flush();

            return $this->redirectToRoute('commande_products_show', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commande_products/new.html.twig', [
            'commande_product' => $commandeProduct,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/show", name="commande_products_show", methods={"GET"})
     */
    public function show(CommandeProductsRepository $commandeProduct): Response
    {
        $panier = $commandeProduct->findBy(['user'=>$this->getUser()]);

        return $this->render('commande_products/show.html.twig', [
            'commande_products' => $panier,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="commande_products_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, CommandeProducts $commandeProduct, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CommandeProductsType::class, $commandeProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('commande_products_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commande_products/edit.html.twig', [
            'commande_product' => $commandeProduct,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="commande_products_delete", methods={"POST"})
     */
    public function delete(Request $request, CommandeProducts $commandeProduct, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commandeProduct->getId(), $request->request->get('_token'))) {
            $entityManager->remove($commandeProduct);
            $entityManager->flush();
        }

        return $this->redirectToRoute('commande_products_show', [], Response::HTTP_SEE_OTHER);
    }
}
