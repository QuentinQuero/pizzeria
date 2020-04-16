<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpClient\HttpClient;

class HomeController extends AbstractController
{
    public function index()
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'http://web.cryfter.ovh:1337/pizzas');
        $pizzas = $response->getContent();    
        return $this->render('home/home.html.twig',['pizzas'=>$pizzas]);
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