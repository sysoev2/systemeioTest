<?php

namespace App\Form;

use App\Entity\CountryTaxCode;
use App\Entity\Product;
use App\Validator\TaxCode;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class PriceCalculatorType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('product', EntityType::class, [
                'required' => true,
                'class' => Product::class,
                'placeholder' => 'Choose a product',
                'constraints' => [
                    new NotBlank(),
                ],
                'choice_label' => function (Product $product) {
                    return $product->getName() . ' ' . $product->getPrice() . '$';
                }
            ])
            ->add('tax_code', TextType::class, [
                'required' => true,
                'label' => 'tax code',
                'constraints' => [
                    new NotBlank(),
                    new TaxCode([
                        'entityClass' => CountryTaxCode::class
                    ])
                ],
            ])
            ->add('submit', SubmitType::class, ['label' => 'Calculate price']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
