<?php

namespace App\Controller;

use App\Entity\CustomOrder;
use App\Form\CustomOrderTypeForm;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/custom-order')]
final class CustomOrderController extends AbstractController
{
    // #[Route('/view', name: 'view_custom_order')]
    // public function viewCustomerOrder(): Response
    // {
    //     return $this->render('custom_order/index.html.twig');
    // }

    #[Route('/add', name: 'add_custom_order')]
    public function addCustomerOrder(Request $request, EntityManagerInterface $em): Response
    {
        $customOrder = new CustomOrder();

        $form = $this->createForm(CustomOrderTypeForm::class, $customOrder);
        $form->handleRequest($request); 

if ($form->isSubmitted() && $form->isValid()) {

            $customOrder->setCreatedAt(new DateTime());

            $em->persist($customOrder);
            $em->flush();
        }


return $this->render('custom_order/custom_order.html.twig', [
            
            'form' => $form->createView(),
        ]);
        
    }

}
