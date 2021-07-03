<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkExtraBundle\Configuration\Method;
use App\Entity\Post;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class PostController extends AbstractController {

    /**
    * @Route("/", name="homepage")
    */

    public function index(){

        // $postname = 'People and nature';
        // $posts = ['Post_One', 'Post_Two', 'Post_Three'];
        $posts = $this->getDoctrine()->getRepository(Post::class)->findAll();

        return $this->render('posts/index.html.twig', ['posts' => $posts,]);
    }
   
    // route to handle with form
    /**
     * @Route("/new",name = "new_post")
     * Method({"GET","POST"});
     */

     public function new(Request $request){
         $post = new Post();

         $form = $this->createFormBuilder($post)
         ->add('title',TextType::class,array('attr' => array('class' => 'form-control')))
         ->add('body',TextareaType::class, array('required' => true, 
         'attr' => array('class' => 'form-control')))
         ->add('save',SubmitType::class, ['label' => 'Create Post', 
         'attr' => array('class' => 'btn btn-primary mt-5')])
         ->getForm();
        //  handle with form and insert data to DB
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            // save data to DB -> Doctrine EntityManager
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($data);
            $entityManager->flush();

            // redirect after submitting form
            return $this->redirectToRoute("homepage");
        }

        //  render form
        return $this->render('posts/new.html.twig',['form' => $form->createView(),]);
     }
     /**
     * @Route("/post/edit/{id}",name = "update_post")
     * Method({"GET","POST"});
     */

    public function update(Request $request, $id){
        // get post with a chosen ID passed to edit()as argument
        // $post = $this->getDoctrine()->getRepository(Post::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $post = $entityManager->getRepository(Post::class)->find($id);


        $form = $this->createFormBuilder($post)
        ->add('title',TextType::class,array('attr' => array('class' => 'form-control')))
        ->add('body',TextareaType::class, array('required' => true, 
        'attr' => array('class' => 'form-control')))
        ->add('save',SubmitType::class, ['label' => 'Change Post and Save', 
        'attr' => array('class' => 'btn btn-success mt-5')])
        ->getForm();
       //  handle with form and insert data to DB
       $form->handleRequest($request);

       if($form->isSubmitted() && $form->isValid()){

           // save data to DB -> Doctrine EntityManager
           $entityManager->flush();

           // redirect after submitting form
           return $this->redirectToRoute("homepage");
       }

       //  render form
       return $this->render('posts/update.html.twig',['form' => $form->createView(),]);
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
    /**
     *  @Route("/posts/delete/{id}", methods={"DELETE"})
     * 
     */
    public function delete(Request $request, $id){
         
        $repository = $this->getDoctrine()->getRepository(Post::class);
        $post = $repository->find($id);
        
        // if Post with given $id have been found -> then remove and execute flush()
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($post);
            $entityManager->flush();

            // send Resposne to fetch().response() javascript
            $response = new Response();
            $response->send();
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

