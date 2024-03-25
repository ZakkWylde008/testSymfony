<?php

namespace App\Controller;

use App\Form\InvoiceType;
use App\Entity\CreateInvoice;
use App\Repository\CreateInvoiceRepository;
use App\CreateEntity\CreateInvoiceInstance;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

class InvoiceController extends AbstractController
{
    private EntityManagerInterface $em;
    private CreateInvoiceRepository $createInvoiceRepository;

    public function __construct(EntityManagerInterface $em, CreateInvoiceRepository $createInvoiceRepository)
    {
        $this->em = $em;
        $this->createInvoiceRepository = $createInvoiceRepository;
    }

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

        $invoices = [];
        if ($formInvoice->isSubmitted() && $formInvoice->isValid()) {
            $invoices["fileNumber"] = $formInvoice->get('fileNumber')->getData();
            $invoices["businessAccount"] = $formInvoice->get('businessAccount')->getData();
            $invoices["customer"] = $formInvoice->get('customer')->getData();
            $invoices["car"] = $formInvoice->get('car')->getData();
            $invoices["seller"] = $formInvoice->get('seller')->getData();
            $invoices["prospectType"] = $formInvoice->get('prospectType')->getData();
            $invoices["billingComment"] = $formInvoice->get('invoiceComment')->getData();
            $invoices["deliveryDate"] = $formInvoice->get('deliveryDate')->getData();

            $createInvoiceInstance = new CreateInvoiceInstance();
            $createInvoice = $createInvoiceInstance->setCreateInvoice($invoices);
            $this->em->persist($createInvoice);
            $this->em->flush();

            return $this->redirectToRoute('app_main');
        }

        return $this->render('invoice/add.html.twig', [
            'formInvoice' => $formInvoice->createView(),
        ]);
    }

    #[Route('/modification/{id}', name: 'app_invoice_modification')]
    public function update(int $id, Request $request): Response
    {
        $invoice = $this->createInvoiceRepository->findOneBy(["id" => $id]);
        if(!empty($invoice)){
            $formInvoice = $this->createForm(InvoiceType::class, $invoice);
            $formInvoice->handleRequest($request);

            if ($formInvoice->isSubmitted() && $formInvoice->isValid()) {
                $invoice->setFileNumber($formInvoice->get('fileNumber')->getData());
                $invoice->setCustomer($formInvoice->get('customer')->getData());
                $invoice->setCar($formInvoice->get('car')->getData());
                $invoice->setSeller($formInvoice->get('seller')->getData());
                $invoice->setProspectType($formInvoice->get('prospectType')->getData());
                $invoice->setBusinessAccount($formInvoice->get('businessAccount')->getData());
                $invoice->setInvoiceComment($formInvoice->get('invoiceComment')->getData());
                $invoice->setDeliveryDate($formInvoice->get('deliveryDate')->getData());
                
                $this->em->persist($invoice);
                $this->em->flush();

                return $this->redirectToRoute('app_main');
            }
        }

        return $this->render('invoice/update.html.twig', [
            'formInvoice' => $formInvoice->createView(),
        ]);
    }

    #[Route('/suppression/{id}', name: 'app_invoice_suppression')]
    public function delete(int $id): Response
    {
        $invoice = $this->createInvoiceRepository->findOneBy(["id" => $id]);
        if(!empty($invoice)){
            $this->em->remove($invoice);
            $this->em->flush();

            return $this->redirectToRoute('app_main');
        }
        return $invoice;
    }
}
