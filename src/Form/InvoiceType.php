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
                'label_attr' => [
                    'style' => 'color: black;'
                ]
            ])
            ->add('invoiceComment', null, [
                'label' => 'Commentaire de facturation',
                'label_attr' => [
                    'style' => 'color: black;'
                ]
            ])
            ->add('deliveryDate', null, [
                'label' => 'Date de livraison',
                'label_attr' => [
                    'style' => 'color: black;'
                ],
                'widget' => 'single_text',
            ])
            ->add('businessAccount', EntityType::class, [
                'label' => 'Compte affaire',
                'label_attr' => [
                    'style' => 'color: black;'
                ],
                'class' => BusinessAccount::class,
                'choice_label' => 'nameAccount',
            ])
            ->add('prospectType', EntityType::class, [
                'label' => 'Type de prospect',
                'label_attr' => [
                    'style' => 'color: black;'
                ],
                'class' => ProspectType::class,
                'choice_label' => 'nameProspect',
            ])
            ->add('customer', EntityType::class, [
                'label' => 'Client',
                'label_attr' => [
                    'style' => 'color: black;'
                ],
                'class' => Customer::class,
                'choice_label' => 'name',
            ])
            ->add('seller', EntityType::class, [
                'label' => 'Vendeur',
                'label_attr' => [
                    'style' => 'color: black;'
                ],
                'class' => Seller::class,
                'choice_label' => 'folderNumberVNVO',
            ])
            ->add('car', EntityType::class, [
                'label' => 'Voiture',
                'label_attr' => [
                    'style' => 'color: black;'
                ],
                'class' => Car::class,
                'choice_label' => 'model',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CreateInvoice::class,
        ]);
    }
}
