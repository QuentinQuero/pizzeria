<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

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

            'pizzas' => $pizzas
        return $this->render('home/home.html.twig', [
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
}
