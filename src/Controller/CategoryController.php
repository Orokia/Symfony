<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

 #[Route('/category')]
final class CategoryController extends AbstractController
{
//     #[Route('/category', name: 'app_category')]
//     public function index(): Response
//     {
//         return $this->render('category/index.html.twig', [
//             'controller_name' => 'CategoryController',
//         ]);
//     }

    #[Route('/new', name: 'app_category')]
    public function new(Request $request, EntityManagerInterface $entity): Response

    
    {


    $datalist =$entity->getRepository(Category ::class)->findAll();
    $category = new Category();

       $form = $this->createForm(CategoryType::class, $category);
       $form ->handleRequest($request);

       if($form->isSubmitted() && $form->isValid()){
             $entity->persist($category);
             $entity->flush();
       }
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
            'datalist'=> $datalist,
            'form'=>$form->createView(),
        ]);
    }

    #[Route('/modif/{id}', name: 'app_modifier')]
    public function modif(EntityManagerInterface $entity, Request $request, $id): Response
    {
    $datalist =$entity->getRepository(Category ::class)->findAll();
    $category = $entity ->getRepository(Category::class)->find($id); 

       $form = $this->createForm(CategoryType::class, $category);
       $form ->handleRequest($request);

       if($form->isSubmitted() && $form->isValid()){
             $entity->flush();
       }


        return $this->render('category/index.html.twig', [
            'controller_name' => 'ProduitController',
             'datalist'=> $datalist,
             'form'=>$form->createView(),
        ]);
    }

     #[Route('/sup/{id}', name: 'app_supp')]
    public function sup(EntityManagerInterface $entity, Request $request, $id): Response
    {
    $datalist =$entity->getRepository(Category ::class)->findAll();
    $category = $entity ->getRepository(Category::class)->find($id); 

       $entity->remove($category);
       $entity->flush();

       
        return $this->redirectToRoute('app_category');
    }
    #[Route('/list', name: 'app_user')]

    public function list(EntityManagerInterface $entity): Response
    {
        $datalist = $entity->getRepository(Category ::class)->findAll();
         return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
            'datalist'=> $datalist,
        ]);
    }
    
}
