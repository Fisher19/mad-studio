<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class AboutController extends AbstractController {

/**
 * @Route("/contents/a-propos", name="about_index")
 */

public function about(){

    $title = "A propos";
    $presentation = "Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Et vitae quidem consequuntur minus doloribus explicabo, quod quo architecto delectus ad cum,
                    assumenda, obcaecati debitis unde. Eos accusantium natus sunt vero?
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Et vitae quidem consequuntur minus doloribus explicabo, quod quo architecto delectus ad cum,
                    assumenda, obcaecati debitis unde. Eos accusantium natus sunt vero?
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Et vitae quidem consequuntur minus doloribus explicabo, quod quo architecto delectus ad cum,
                    assumenda, obcaecati debitis unde. Eos accusantium natus sunt vero?
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Et vitae quidem consequuntur minus doloribus explicabo, quod quo architecto delectus ad cum,
                    assumenda, obcaecati debitis unde. Eos accusantium natus sunt vero?
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Et vitae quidem consequuntur minus doloribus explicabo, quod quo architecto delectus ad cum,
                    assumenda, obcaecati debitis unde. Eos accusantium natus sunt vero?
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Et vitae quidem consequuntur minus doloribus explicabo, quod quo architecto delectus ad cum,
                    assumenda, obcaecati debitis unde. Eos accusantium natus sunt vero?";

    return $this->render(
        '/contents/about/about.html.twig', 
        [ 
            'title' => $title,
            'presentation' => $presentation
        ]
    );
}
}