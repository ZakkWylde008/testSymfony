<?php

namespace App\Controller;

use App\Form\InvoiceType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

class InvoiceController extends AbstractController
{
    #[Route('/invoice', name: 'app_invoice')]
    public function index(): Response
    {
        return $this->render('invoice/index.html.twig', [
            'controller_name' => 'InvoiceController',
        ]);
    }

    #[Route('/ajout', name: 'app_main_ajout')]
    public function ajout(Request $request): Response
    {
        $formInvoice = $this->createForm(InvoiceType::class);
        $formInvoice->handleRequest($request);

        return $this->render('invoice/add.html.twig', [
            'formInvoice' => $formInvoice->createView(),
        ]);
    }
}
