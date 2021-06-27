<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkExtraBundle\Configuration\Method;


class PostController extends AbstractController {
    public function index(){

        /**
         * @Route("/post", methods={"GET","HEAD"})
         */
        $postname = 'People and nature';

        // return $this->render('posts/index.html.twig');
        return new Response('<html><body>post category is: '. $postname .'</body></html>');
    }
}

