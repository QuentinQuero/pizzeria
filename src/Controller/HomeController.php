<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpClient\HttpClient;

class HomeController extends AbstractController
{
    public function index()
    {
        return $this->render('home/home.html.twig');
    }

    public function menu(SessionInterface $session)
    {
        $pizzaToCart = $session->get('pizzaToCart', []);
        $order = [];

        //$session->clear();

        $client = HttpClient::create();
        $response = $client->request('GET', 'http://web.cryfter.ovh:1337/pizzas');
        $pizzas = $response->toArray();

        foreach ($pizzaToCart as $idPizza => $quantity)
        {
            foreach ($pizzas as $pizza)
            {
                if($pizza['id'] == $idPizza)
                {
                    $order[] = [
                        'pizza' => $pizza,
                        'quantity' => $quantity
                    ];
                }
            }
        }

        //dump($order);

        return $this->render('home/home.html.twig', [
            'pizzas' => $pizzas,
            'order' => $order
        ]);
    }

   public function add($id, SessionInterface $session)
    {
        $pizzaToCart = $session->get('pizzaToCart', []);

        if(!empty($pizzaToCart[$id]))
        {
            $pizzaToCart[$id] ++;
        }
        else
        {
            $pizzaToCart[$id] = 1;
        }

        $session->set('pizzaToCart', $pizzaToCart);

        return $this->redirectToRoute('menu');

    }


    /*public function buttonPressed()
    {
        if(isset($_POST['validateCart']))
            return $this->validateCart();
    }

    public function validateCart()
    {

    }*/
}
