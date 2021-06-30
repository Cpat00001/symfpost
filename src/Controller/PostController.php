<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkExtraBundle\Configuration\Method;


class PostController extends AbstractController {

    /**
    * @Route("/")
    */

    public function index(){

        // $postname = 'People and nature';
        $posts = ['Post_One', 'Post_Two', 'Post_Three'];

        return $this->render('posts/index.html.twig', ['posts' => $posts,]);
    }
}

