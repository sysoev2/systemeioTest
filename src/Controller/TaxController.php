<?php

namespace App\Controller;

use App\Entity\CountryTaxCode;
use App\Form\PriceCalculatorType;
use App\Repository\CountryTaxCodeRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tax', name: 'app_tax_')]
class TaxController extends AbstractController
{

    public function __construct(
        private CountryTaxCodeRepository $countryTaxCodeRepository
    )
    {
    }

    #[Route('/', name: 'index')]
    public function index(Request $request): Response
    {
        //there's no information about saving orders in the test task, so it only calculates it
        $form = $this->createForm(PriceCalculatorType::class);

        $form->handleRequest($request);
        $result = null;
        $errors = null;
        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $countryTax = $this->countryTaxCodeRepository->findOneBy(['code' => substr($formData['tax_code'], 0, 2)]);
            $result['price'] = $formData['product']->getPrice() * (1 + $countryTax->getTax() / 100);
            $result['country'] = $countryTax->getCountry();
            $result['taxCode'] = $formData['tax_code'];
        } else {
            $errors = $form->getErrors(true);
        }
        return $this->render('tax/index.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'TaxController',
            'result' => $result,
            'errors' => $errors
        ]);
    }
}
