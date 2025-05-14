<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


final class CustomOrderController extends AbstractController
{
    #[Route('/custom-order', name: 'app_custom_order')]
    public function viewCustomerOrder(): Response
    {
        return $this->render('custom_order/index.html.twig');
    }
}
