<?php

namespace App\Controller\Test;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController {

    /**
     * @Route("/mytest", name="mytest")
     */
    public function myTest()
    {
        $a = 12;

        return $this->render("test/test.html.twig", [
            "varTitre" => 'Test'
        ]);
    }
}
