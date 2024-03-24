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

    #[Route('/ajout', name: 'app_invoice_ajout')]
    public function add(Request $request): Response
    {
        $formInvoice = $this->createForm(InvoiceType::class);
        $formInvoice->handleRequest($request);

        return $this->render('invoice/add.html.twig', [
            'formInvoice' => $formInvoice->createView(),
        ]);
    }

    #[Route('/modification/{id}', name: 'app_invoice_modification')]
    public function update(int $id): Response
    {
        $formInvoice = $this->createForm(InvoiceType::class);
        $formInvoice->handleRequest($request);

        return $this->render('invoice/update.html.twig', [
            'formInvoice' => $formInvoice->createView(),
        ]);
    }
}
