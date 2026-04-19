<?php

namespace App\Controller;
use App\Entity\Post;
use App\Form\PostFormType;
 use App\Entity\Comment;
use App\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/post')]
final class PostController extends AbstractController
{
    #[Route('/new', name: 'app_post')]
      
    public function index(EntityManagerInterface $entity, Request $request): Response
    {
    $datalist =$entity->getRepository(Post ::class)->findAll();
    $post = new Post();

       $form = $this->createForm(PostFormType::class, $post);
       $form ->handleRequest($request);

       if($form->isSubmitted() && $form->isValid()){
             $entity->persist($post);
             $entity->flush();
       }


        return $this->render('post/index.html.twig', [
            'controller_name' => 'ProduitController',
             'datalist'=> $datalist,
             'form'=>$form->createView(),
        ]);
    }

   #[Route('/{id}', name: 'app_post_details')]
public function post(EntityManagerInterface $entity, Request $request, $id): Response
{
    
    $post = $entity->getRepository(Post::class)->find($id);

    if (!$post) {
        return $this->redirectToRoute('app_post');
    }

    
    $comment = new Comment();

    $form = $this->createForm(CommentType::class, $comment);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

        $comment->setPost($post);
        $comment->setUser($this->getUser());
        $comment->setCreatedAt(new \DateTimeImmutable());
        $comment->setPost($post);
        $comment->setUser($this->getUser());
        $comment->setStatus(Comment::STATUS_PENDING);


        $entity->persist($comment);
        $entity->flush();

        return $this->redirectToRoute('app_post_details', [
            'id' => $post->getId()
        ]);
    }

    // 🔥 AFFICHAGE
    return $this->render('post/details.html.twig', [
        'post' => $post,
        'form' => $form->createView(),
    ]);
}
     #[Route('/modif/{id}', name: 'app_modif')]
    public function modif(EntityManagerInterface $entity, Request $request, $id): Response
    {
    $datalist =$entity->getRepository(Post ::class)->findAll();
    $post = $entity ->getRepository(Post::class)->find($id); 

       $form = $this->createForm(PostFormType::class, $post);
       $form ->handleRequest($request);

       if($form->isSubmitted() && $form->isValid()){
             $entity->flush();
       }
        return $this->render('post/index.html.twig', [
            'controller_name' => 'ProduitController',
             'datalist'=> $datalist,
             'form'=>$form->createView(),
        ]);
    }

     #[Route('/sup/{id}', name: 'app_sup')]
    public function sup(EntityManagerInterface $entity, Request $request, $id): Response
    {
    $datalist =$entity->getRepository(Post ::class)->findAll();
    $post = $entity ->getRepository(Post::class)->find($id); 

       $entity->remove($post);
       $entity->flush();

       


        return $this->redirectToRoute('app_post');
    }
    #[Route('/list', name: 'app_user')]

    public function list(EntityManagerInterface $entity): Response
    {
        $datalist = $entity->getRepository(Post ::class)->findAll();
         return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
            'datalist'=> $datalist,
        ]);
    }
   



}
