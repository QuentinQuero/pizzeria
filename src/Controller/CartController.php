<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }
    public function buttonPressed()
    {
        if(isset($_POST['modifyCart']))
            return $this->modifyCart();
    }
    public function cart()
    {
        $this->session->set('pizzaToCart', ['pizzaToCart' => 
        [
            'pizza1' => 
                ['pizzaName'=>'Royale',
                'pizzaPrice'=>12,
                'nbrPizza'=>5,
                'id' =>1],
            'pizza2' =>
                ['pizzaName'=>'BBQ',
                'pizzaPrice'=>10,
                'nbrPizza'=>1,
                'id' =>1]
        ]]);
        return $this->render('cart/cart.html.twig', $this->session->get('pizzaToCart'));
        // return new Response(var_dump($this->session->get('pizzaToCart')));
    }

    public function modifyCart()
    {

    }
}