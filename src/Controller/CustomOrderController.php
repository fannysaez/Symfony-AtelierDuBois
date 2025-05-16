<?php

namespace App\Controller;

use DateTimeImmutable;
use DateTime;
use App\Entity\CustomOrder;
use App\Form\CustomOrderTypeForm;
use App\Repository\UserRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class CustomOrderController extends AbstractController
{
    // #[Route('/view', name: 'view_custom_order')]
    // public function viewCustomerOrder(): Response
    // {
    //     return $this->render('custom_order/index.html.twig');
    // }

    #[Route('/custom-order-plank', name: 'custom_order_plank')]
    public function addCustomerOrder(Request $request, EntityManagerInterface $em, ProductRepository $productRepository): Response
    {
        $customOrder = new CustomOrder();
        $customOrder->setUser($this->getUser());

        $form = $this->createForm(CustomOrderTypeForm::class, $customOrder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $customOrder->setCreatedAt(new DateTime());


            $em->persist($customOrder);
            $em->flush();
        }

        $latestProducts = $productRepository->findBy(
            [],
            ['createdAt' => 'DESC'],
            3
        );

        return $this->render('custom_order/custom_order.html.twig', [
            'form' => $form->createView(),
            'latestProducts' => $latestProducts,
        ]);
    }

    #[Route('/custom-order-plank/view', name: 'custom_order_plank_view')]
    public function viewCustomerOrder(Request $request, EntityManagerInterface $em, ProductRepository $productRepository): Response
    {

        return $this->render('custom_order/view_custom_order.html.twig');
    }
}
