<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkExtraBundle\Configuration\Method;
use App\Entity\Post;


class PostController extends AbstractController {

    /**
    * @Route("/")
    */

    public function index(){

        // $postname = 'People and nature';
        // $posts = ['Post_One', 'Post_Two', 'Post_Three'];
        $posts = $this->getDoctrine()->getRepository(Post::class)->findAll();

        return $this->render('posts/index.html.twig', ['posts' => $posts,]);
    }
    // show individual ID Post
    /**
     * @Route("post/{id}", name="post_show")
     */
    public function show($id)
    {
        $post = $this->getDoctrine()->getRepository(Post::class)->find($id);
        // render view for individual post from Twig
        return $this->render('posts/show.html.twig' , [ 'post' => $post]);

        if(!$post){
            throw $this->createNotFoundException('
            No post found with id' .$id);
        }
    }
    // adding new Post from url - example
    /**
     * @Route("/post/save")
     */
    // public function save(){

    //     $entityManager = $this->getDoctrine()->getManager();

    //     $post = new Post();
    //     $post->setTitle("Post Test 2");
    //     $post->setBody("Text for body field for Post Test 2");

    //     //tel Doctrine you want to (eventually)  save the Post(no queries yet)
    //     $entityManager->persist($post); 
    //     // execute a query and save in DB
    //     $entityManager->flush();

    //     // return a message that Pst was saved, show post's ID
    //     return new Response('Saved a new post with id: ' . $post->getId());
    // }
}

