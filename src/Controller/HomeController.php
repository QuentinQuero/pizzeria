<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpClient\HttpClient;

class HomeController extends AbstractController
{
    public function index()
    {
        return $this->render('home/home.html.twig');
    }

    public function Menu()
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'http://web.cryfter.ovh:1337/pizzas');
        $pizzas = $response->toArray();

        return $this->render('home/home.html.twig', [
            'pizzas' => $pizzas
        ]);
   }
}
