<?php

namespace App\Controller;

use App\Form\FileUploadType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
// use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

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

        $invoices = [];
        $customers = [];
        $cars = [];
        $sellers = [];

        $columnMappings = array(
            "businessAccount" => &$invoices,
            "eventAccount" => &$invoices,
            "lastEventAccount" => &$invoices,
            "fileNumber" => &$invoices,
            "civilCode" => &$customers,
            "actualOwner" => &$cars,
            "name" => &$customers,
            "firstname" => &$customers,
            "street" => &$customers,
            "adressComplement" => &$customers,
            "postalCode" => &$customers,
            "city" => &$customers,
            "homePhone" => &$customers,
            "mobilePhone" => &$customers,
            "jobPhone" => &$customers,
            "email" => &$customers,
            "releaseDate" => &$cars,
            "deliveryDate" => &$invoices,
            "lastEventDate" => &$cars,
            "brandName" => &$cars,
            "model" => &$cars,
            "version" => &$cars,
            "vin" => &$cars,
            "registration" => &$cars,
            "prospectType" => &$invoices,
            "mileage" => &$cars,
            "energy" => &$cars,
            "sellerVN" => &$sellers,
            "sellerVO" => &$sellers,
            "billingComment" => &$invoices,
            "typeVNVO" => &$sellers,
            "folderNumberVNVO" => &$sellers,
            "salesIntermediaryVN" => &$sellers,
            "eventDate" => &$cars,
            "eventOrigin" => &$cars
        );

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
            array_shift($data);
    
            // $entityManager->flush();
    
            // unlink($this->getParameter('upload_files_dir')."/".$excelFile->getClientOriginalName());
        }

        return $this->render('main/index.html.twig', [
            'formUpload' => $formUpload->createView(),
            'tableTitle' => $tableTitle,
        ]);
    }

    private function getColumnHeaderName(int $index){
        $result = "";
        switch ($index) {
            case 1:
                $result = "businessAccount";
                break;
            case 2:
                $result = "eventAccount";
                break;
            case 3:
                $result = "lastEventAccount";
                break;
            case 4:
                $result = "fileNumber";
                break;
            case 5:
                $result = "civilCode";
                break;
            case 6:
                $result = "actualOwner";
                break;
            case 7:
                $result = "name";
                break;
            case 8:
                $result = "firstname";
                break;
            case 9:
                $result = "street";
                break;
            case 10:
                $result = "adressComplement";
                break;
            case 11:
                $result = "postalCode";
                break;
            case 12:
                $result = "city";
                break;
            case 13:
                $result = "homePhone";
                break;
            case 14:
                $result = "mobilePhone";
                break;
            case 15:
                $result = "jobPhone";
                break;
            case 16:
                $result = "email";
                break;
            case 17:
                $result = "releaseDate";
                break;
            case 18:
                $result = "deliveryDate";
                break;
            case 19:
                $result = "lastEventDate";
                break;
            case 20:
                $result = "brandName";
                break;
            case 21:
                $result = "model";
                break;
            case 22:
                $result = "version";
                break;
            case 23:
                $result = "vin";
                break;
            case 24:
                $result = "registration";
                break;
            case 25:
                $result = "prospectType";
                break;
            case 26:
                $result = "mileage";
                break;
            case 27:
                $result = "energy";
                break;
            case 28:
                $result = "sellerVN";
                break;
            case 29:
                $result = "sellerVO";
                break;
            case 30:
                $result = "billingComment";
                break;
            case 31:
                $result = "typeVNVO";
                break;
            case 32:
                $result = "folderNumberVNVO";
                break;
            case 33:
                $result = "salesIntermediaryVN";
                break;
            case 34:
                $result = "eventDate";
                break;
            case 35:
                $result = "eventOrigin";
                break;
            default:
                break;
        }
        return $result;
    }
}
