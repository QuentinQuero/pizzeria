<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpClient\HttpClient;

class OrderController extends AbstractController
{
    public function index(SessionInterface $session)
    {
        $pizzaToCart = $session->get('pizzaToCart', []);

        $basket = [];

        $client = HttpClient::create();
        $response = $client->request('GET', 'http://web.cryfter.ovh:1337/pizzas');
        $pizzas = $response->toArray();

        foreach ($pizzaToCart as $id => $quantity)
        {
            $basket[] = [
            'pizzas' => $pizzas,
            'quantity' => $quantity
            ];
        }

        return $this->render('order.html.twig', [

        ]);
    }

    public function add ($id, SessionInterface $session)
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
        dd($session->get('pizzaToCart'));
        //return $this->render('home/home.html.twig',
        //    $session->get('pizzaToCart');
    }
}
