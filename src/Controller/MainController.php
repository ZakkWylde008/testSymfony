<?php

namespace App\Controller;

use App\Form\FileUploadType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(Request $request): Response
    {
        $formUpload = $this->createForm(FileUploadType::class);
        $formUpload->handleRequest($request);

        $tableTitle = [
            "Compte Affaire",
            "Numéro de fiche",
            "Client",
            "Vehicule",
            "Vendeur",
            "Type de prospect",
            "Commentaire de facturation",
            "Date de livraison",
            "Actions"
        ];
        $data = [];

        if ($formUpload->isSubmitted() && $formUpload->isValid()) {
            $excelFile = $formUpload->get('file')->getData();
            
            $excelFile->move($this->getParameter('upload_files_dir'), $excelFile->getClientOriginalName());
    
            $spreadsheet = IOFactory::load($this->getParameter('upload_files_dir') .$excelFile->getClientOriginalName());
            $sheet = $spreadsheet->getActiveSheet();
            
            foreach ($sheet->getRowIterator() as $row) {
                $rowData = [];
                foreach ($row->getCellIterator() as $cell) {
                    $rowData[] = $cell->getValue();
                }
                $data[] = $rowData;
            }
            dd($data);

            // foreach($data as $row) {
                
            // }
    
            // $entityManager->flush();
    
            // unlink('chemin/vers/repertoire/temporaire/nom_du_fichier.xlsx');
        }

        return $this->render('main/index.html.twig', [
            'formUpload' => $formUpload->createView(),
            'tableTitle' => $tableTitle,
        ]);
    }
}
