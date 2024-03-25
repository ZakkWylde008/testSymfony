<?php

namespace App\Form;

use App\Entity\BusinessAccount;
use App\Entity\Car;
use App\Entity\CreateInvoice;
use App\Entity\Customer;
use App\Entity\ProspectType;
use App\Entity\Seller;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fileNumber', null, [
                'label' => 'Numero de fiche',
                'required' => true
            ])
            ->add('businessAccount', EntityType::class, [
                'label' => 'Compte affaire',
                'required' => true,
                'class' => BusinessAccount::class,
                'choice_label' => 'nameAccount'
            ])
            ->add('customer', EntityType::class, [
                'label' => 'Client',
                'required' => true,
                'class' => Customer::class,
                'choice_label' => function($customer) {
                    return $customer->getName() .' ' .$customer->getFirstname();
                }
            ])
            ->add('car', EntityType::class, [
                'label' => 'Voiture',
                'required' => true,
                'class' => Car::class,
                'choice_label' => function($car) {
                    return $car->getBrandName() .'-' .$car->getVersion().' | immatriculé ' .$car->getRegistration();
                }
            ])
            ->add('seller', EntityType::class, [
                'label' => 'Vendeur',
                'class' => Seller::class,
                'choice_label' => 'folderNumberVNVO'
            ])
            ->add('prospectType', EntityType::class, [
                'label' => 'Type de prospect',
                'required' => true,
                'class' => ProspectType::class,
                'choice_label' => 'nameProspect'
            ])
            ->add('invoiceComment', null, [
                'label' => 'Commentaire de facturation'
            ])
            ->add('deliveryDate', null, [
                'label' => 'Date de livraison',
                'required' => true,
                'widget' => 'single_text'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CreateInvoice::class,
        ]);
    }
}
