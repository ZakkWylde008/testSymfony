<?php

namespace App\Controller;

use App\Form\FileUploadType;
use App\CreateEntity\CustomerInstance;
use App\CreateEntity\CarInstance;
use App\CreateEntity\SellerInstance;
use App\CreateEntity\CreateInvoiceInstance;
use App\Repository\CustomerRepository;
use App\Repository\CarRepository;
use App\Repository\SellerRepository;
use App\Repository\EventAccountRepository;
use App\Repository\EventOriginRepository;
use App\Repository\CreateInvoiceRepository;
use App\Repository\BusinessAccountRepository;
use App\Repository\ProspectTypeRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class MainController extends AbstractController
{
    private EntityManagerInterface $em;
    private CustomerRepository $customerRepository;
    private CarRepository $carRepository;
    private SellerRepository $sellerRepository;
    private EventAccountRepository $eventAccountRepository;
    private EventOriginRepository $eventOriginRepository;
    private CreateInvoiceRepository $createInvoiceRepository;
    private BusinessAccountRepository $businessAccountRepository;
    private ProspectTypeRepository $prospectTypeRepository;
    public function __construct(
        EntityManagerInterface $em,
        CustomerRepository $customerRepository,
        CarRepository $carRepository,
        SellerRepository $sellerRepository,
        EventAccountRepository $eventAccountRepository,
        EventOriginRepository $eventOriginRepository,
        CreateInvoiceRepository $createInvoiceRepository,
        BusinessAccountRepository $businessAccountRepository,
        ProspectTypeRepository $prospectTypeRepository
        )
    {
        $this->em = $em;
        $this->customerRepository = $customerRepository;
        $this->carRepository = $carRepository;
        $this->sellerRepository = $sellerRepository;
        $this->eventAccountRepository = $eventAccountRepository;
        $this->eventOriginRepository = $eventOriginRepository;
        $this->createInvoiceRepository = $createInvoiceRepository;
        $this->businessAccountRepository = $businessAccountRepository;
        $this->prospectTypeRepository = $prospectTypeRepository;
    }

    #[Route('/', name: 'app_main')]
    public function index(Request $request): Response
    {
        $tableTitle = [
            "Numéro de fiche",
            "Compte Affaire",
            "Client",
            "Voiture",
            "Vendeur",
            "Type de prospect",
            "Commentaire de facturation",
            "Date de livraison",
            "Actions"
        ];
        $tableData = [];

        $data = [];
        $invoices = [];
        $customers = [];
        $cars = [];
        $sellers = [];
        $invoice = [];
        $customer = [];
        $car = [];
        $seller = [];

        $columnMappings = array(
            "eventAccount" => &$car,
            "lastEventAccount" => &$car,
            "civilCode" => &$customer,
            "actualOwner" => &$car,
            "name" => &$customer,
            "firstname" => &$customer,
            "street" => &$customer,
            "adressComplement" => &$customer,
            "postalCode" => &$customer,
            "city" => &$customer,
            "homePhone" => &$customer,
            "mobilePhone" => &$customer,
            "jobPhone" => &$customer,
            "email" => &$customer,
            "releaseDate" => &$car,
            "lastEventDate" => &$car,
            "brandName" => &$car,
            "model" => &$car,
            "version" => &$car,
            "vin" => &$car,
            "registration" => &$car,
            "mileage" => &$car,
            "energy" => &$car,
            "sellerVN" => &$seller,
            "sellerVO" => &$seller,
            "typeVNVO" => &$seller,
            "folderNumberVNVO" => &$seller,
            "salesIntermediaryVN" => &$seller,
            "eventDate" => &$car,
            "eventOrigin" => &$car
        );

        $formUpload = $this->createForm(FileUploadType::class);
        $formUpload->handleRequest($request);

        if ($formUpload->isSubmitted() && $formUpload->isValid()) {
            $excelFile = $formUpload->get('file')->getData();
            $excelFile->move($this->getParameter('upload_files_dir'), $excelFile->getClientOriginalName());

            // Get data from the excel file
            try {
                $spreadsheet = IOFactory::load($this->getParameter('upload_files_dir') .$excelFile->getClientOriginalName());
                $sheet = $spreadsheet->getActiveSheet();
                foreach ($sheet->getRowIterator() as $row) {
                    $rowData = [];
                    foreach ($row->getCellIterator() as $cell) {
                        $value = $cell->getValue();
                        if ($cell->getDataType() == 'n' && \PhpOffice\PhpSpreadsheet\Shared\Date::isDateTime($cell)) {
                            $value = ExcelDate::excelToTimestamp($value);
                            $date = \DateTimeImmutable::createFromFormat('U', $value);
                            if ($date === false) {
                                throw new \RuntimeException("Erreur lors de la conversion de la date.");
                            }
                            $value = $date;
                        }
                        $rowData[] = $value;
                    }
                    $data[] = $rowData;
                }
                array_shift($data);
                foreach($data as $row){
                    for($i = 0; $i < count($row); $i++){
                        $targetArray = &$columnMappings[$this->getColumnHeaderName($i+1)];
                        $targetArray[$this->getColumnHeaderName($i+1)] = $row[$i];

                        $invoice[$this->getColumnHeaderName($i+1)] = $row[$i];
                    }
                    array_push($customers, $customer);
                    array_push($cars, $car);
                    array_push($sellers, $seller);
                    array_push($invoices, $invoice);
                }
            } catch (\Exception $e) {
                throw $e;
            }

            // Add customers from file into database
            try {
                foreach($customers as $cu){
                    $customerForCheck = $this->customerRepository->findBy([
                        "name" => $cu["name"],
                        "firstname" => $cu["firstname"],
                        "street" => $cu["street"]
                    ]);
                    if(empty($customerForCheck) && $cu["name"] !== null){
                        $customerInstance = new CustomerInstance();
                        $customer = $customerInstance->setCustomer($cu);
                        $this->em->persist($customer);
                        $this->em->flush();
                    }
                }
            } catch (\Exception $e) {
                throw $e;
            }

            // Add cars from file into database
            try {
                foreach($cars as $ca){
                    $carForCheck = $this->carRepository->findBy([
                        "vin" => $ca["vin"]
                    ]);
                    if(empty($carForCheck)  && $ca["brandName"] !== null){
                        $eventAccount = $this->eventAccountRepository->findOneBy(["nameAccount" => $ca["eventAccount"]]);
                        $lastEventAccount = $this->eventAccountRepository->findOneBy(["nameAccount" => $ca["lastEventAccount"]]);
                        $eventOrigin = $this->eventOriginRepository->findOneBy(["eventOrigin" => $ca["eventOrigin"]]);;
                        $ca["eventAccount"] = $eventAccount;
                        $ca["lastEventAccount"] = $lastEventAccount;
                        $ca["eventOrigin"] = $eventOrigin;
                        $carInstance = new CarInstance();
                        $car = $carInstance->setCar($ca);
                        $this->em->persist($car);
                        $this->em->flush();
                    }
                }
            } catch (\Exception $e) {
                throw $e;
            }

            // Add sellers from file into database
            try {
                foreach($sellers as $se){
                    $sellerForCheck = $this->sellerRepository->findBy([
                        "vn" => $se["sellerVN"],
                        "vo" => $se["sellerVO"],
                        "type" => $se["typeVNVO"],
                        "folderNumberVNVO" => $se["folderNumberVNVO"]
                     
                    ]);
                    if(empty($sellerForCheck)){
                        $sellerInstance = new SellerInstance();
                        $seller = $sellerInstance->setSeller($se);
                        $this->em->persist($seller);
                        $this->em->flush();
                    }
                }
            } catch (\Exception $e) {
                throw $e;
            }

            // Add rows from file into database
            try {
                foreach($invoices as $in){
                    $car = $this->carRepository->findOneBy([
                        "vin" => $in["vin"]
                    ]);
                    $createInvoiceForCheck = $this->createInvoiceRepository->findBy([
                        "car" => $car
                    ]);
                    if(empty($createInvoiceForCheck) && $in["fileNumber"] !== null){
                        $businessAccount = $this->businessAccountRepository->findOneBy([
                            "nameAccount" => $in["businessAccount"]
                        ]);
                        $prospectType = $this->prospectTypeRepository->findOneBy([
                            "nameProspect" => $in["prospectType"]
                        ]);
                        $customer = $this->customerRepository->findOneBy([
                            "civilCode" => $in["civilCode"],
                            "name" => $in["name"],
                            "firstname" => $in["firstname"]
                        ]);
                        $seller = $this->sellerRepository->findOneBy([
                            "vn" => $in["sellerVN"],
                            "vo" => $in["sellerVO"],
                            "type" => $in["typeVNVO"],
                            "folderNumberVNVO" => $in["folderNumberVNVO"]
                        ]);
                        $in["prospectType"] = $prospectType;
                        $in["businessAccount"] = $businessAccount;
                        $in["customer"] = $customer;
                        $in["car"] = $car;
                        $in["seller"] = $seller;
                        $createInvoiceInstance = new CreateInvoiceInstance();
                        $createInvoice = $createInvoiceInstance->setCreateInvoice($in);
                        $this->em->persist($createInvoice);
                        $this->em->flush();
                    }
                }
            } catch (\Exception $e) {
                throw $e;
            }

            unlink($this->getParameter('upload_files_dir') .$excelFile->getClientOriginalName());

            return $this->redirectToRoute('app_main');
        }

        $invoicesFromDB = $this->createInvoiceRepository->findAll();
        if(!empty($invoicesFromDB)){
            foreach($invoicesFromDB as $inDB){
                $table = array();
                $table["id"] = $inDB->getId();
                $table["fileNumber"] = $inDB->getFileNumber();
                $table["invoiceComment"] = $inDB->getInvoiceComment();
                $table["deliveryDate"] = $inDB->getDeliveryDate();
                $table["prospectType"] = $inDB->getProspectType()->getNameProspect();
                $table["businessAccount"] = $inDB->getBusinessAccount()->getNameAccount();
                
                $table["customer"]["civilCode"] = $inDB->getCustomer()->getCivilCode();
                $table["customer"]["name"] = $inDB->getCustomer()->getName();
                $table["customer"]["firstname"] = $inDB->getCustomer()->getFirstname();
                $table["customer"]["street"] = $inDB->getCustomer()->getStreet();
                $table["customer"]["adressComplement"] = $inDB->getCustomer()->getAdressComplement();
                $table["customer"]["postalCode"] = $inDB->getCustomer()->getPostalCode();
                $table["customer"]["city"] = $inDB->getCustomer()->getCity();
                $table["customer"]["homePhone"] = $inDB->getCustomer()->getHomePhone();
                $table["customer"]["mobilePhone"] = $inDB->getCustomer()->getMobilePhone();
                $table["customer"]["jobPhone"] = $inDB->getCustomer()->getJobPhone();
                $table["customer"]["email"] = $inDB->getCustomer()->getEmail();
    
                $table["car"]["brandName"] = $inDB->getCar()->getBrandName();
                $table["car"]["model"] = $inDB->getCar()->getModel();
                $table["car"]["version"] = $inDB->getCar()->getVersion();
                $table["car"]["vin"] = $inDB->getCar()->getVin();
                $table["car"]["registration"] = $inDB->getCar()->getRegistration();
                $table["car"]["mileage"] = $inDB->getCar()->getMileage();
                $table["car"]["actualOwner"] = $inDB->getCar()->getActualOwner();
                $table["car"]["energy"] = $inDB->getCar()->getEnergy();
                $table["car"]["releaseDate"] = $inDB->getCar()->getReleaseDate();
                $table["car"]["lastEventDate"] = $inDB->getCar()->getLastEventDate();
                $table["car"]["eventDate"] = $inDB->getCar()->getEventDate();
                $table["car"]["eventOrigin"] = $inDB->getCar()->getEventOrigin()->getEventOrigin();
                $table["car"]["eventAccount"] = $inDB->getCar()->getEventAccount()->getNameAccount();
                $table["car"]["lastEventAccount"] = $inDB->getCar()->getLastEventAccount()->getNameAccount();
    
                $table["seller"]["typeVNVO"] = $inDB->getSeller()->getType();
                $table["seller"]["sellerVN"] = $inDB->getSeller()->getVn();
                $table["seller"]["sellerVO"] = $inDB->getSeller()->getVo();
                $table["seller"]["folderNumberVNVO"] = $inDB->getSeller()->getFolderNumberVNVO();
                $table["seller"]["salesIntermediaryVN"] = $inDB->getSeller()->getSalesIntermediaryVN();

                array_push($tableData, $table);
            }
            array_reverse($tableData);
        }

        return $this->render('main/index.html.twig', [
            'formUpload' => $formUpload->createView(),
            'tableTitle' => $tableTitle,
            'tableData' => $tableData
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
