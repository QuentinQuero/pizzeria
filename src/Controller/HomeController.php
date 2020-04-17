<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class HomeController extends AbstractController
{
    public function index()
    {
        return $this->render('home.html.twig');
    }
    public function menu()
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'http://web.cryfter.ovh:1337/pizzas');
        $pizzas = $response->toArray();

        return $this->render('home/home.html.twig', ['pizzas' => $pizzas
        ]);
   }


    public function buttonPressed()
    {
        if(isset($_POST['validateCart']))
            return $this->validateCart();
    }

    public function validateCart()
    {
        
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
