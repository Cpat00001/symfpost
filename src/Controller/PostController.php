<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkExtraBundle\Configuration\Method;


class PostController extends AbstractController {

    /**
    * @Route("/post")
    */

    public function index(){

        $postname = 'People and nature';

        return $this->render('posts/index.html.twig', ['postname' => $postname,]);
        // return new Response('<html><body>post category is: '. $postname .'</body></html>');
    }
}

