<?php

namespace App\Controller;
use App\Entity\User;
use App\Form\AccountType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class AccountController extends AbstractController
{
    #[Route('/account/', name: 'app_account')]
    public function index(EntityManagerInterface $entity, Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(AccountType::class, $user);
       $form ->handleRequest($request);
       
       if($form->isSubmitted() && $form->isValid()){
            
             $entity->flush();
             return $this->redirectToRoute('app_account');
       }
        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController',
            'form'=>$form->createView(),
        ]);
    }
    

}
