<?php

namespace App\Controller;

use App\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Attribute\Route;

final class ProduitController extends AbstractController
{
    #[Route('/produit', name: 'app_produit')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        if ($request->isMethod('POST')) {

            $produit = new Produit();

            $produit->setNom($request->request->get('nom'));
            $produit->setPrix($request->request->get('prix'));
            $produit->setQuantité($request->request->get('quantité'));
            $produit->setDescription($request->request->get('description'));

            $em->persist($produit);
            $em->flush();

            // message de succès
            $this->addFlash('success', 'Produit ajouté avec succès');

            return $this->redirectToRoute('app_produit');
        }
        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    }

    #[Route('/produit/list', name: 'app_list')]

    public function list(EntityManagerInterface $em): Response
    {
        $produits= $em->getRepository(Produit::class)->findAll();
        return $this->render('produit/list.html.twig', [
           'produits'=> $produits 
        ]);

    }

    #[Route('/produit/{id}', name: 'produit_show')]
public function show(Produit $produit)
{
    return $this->render('produit/show.html.twig', [
        'produit' => $produit,
    ]);
}

#[Route('/produit/{id}/edit', name: 'produit_edit')]
public function edit(Produit $produit, Request $request, EntityManagerInterface $em)
{
    if ($request->isMethod('POST')) {

        $produit->setNom($request->request->get('nom'));
        $produit->setPrix( $request->request->get('prix'));
        $produit->setQuantité( $request->request->get('quantité'));
        $produit->setDescription($request->request->get('description'));

        $em->flush(); 

        $this->addFlash('success', 'Produit modifié avec succès');

        return $this->redirectToRoute('app_list');
    }

    return $this->render('produit/index.html.twig', [
        'produit' => $produit
    ]);
}

#[Route('/produit/{id}/supprimer', name: 'produit_delete')]
public function delete(Produit $produit, Request $request, EntityManagerInterface $em)
{
   if ($request->isMethod('POST')) {

    $em->remove($produit);
    $em->flush();

    return $this->redirectToRoute('app_list');
}

return $this->redirectToRoute('app_list');

  
}

#[Route('/blog', name: 'blog_index')]
public function page(EntityManagerInterface $em)
{
    $produit = $em->getRepository(Produit::class)->findAll();

    return $this->render('produit/index.html.twig', [
        'produit' => $produit
    ]);
}


}
