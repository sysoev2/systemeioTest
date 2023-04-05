<?php

namespace App\Validator;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class TaxCodeValidator extends ConstraintValidator
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof TaxCode) {
            throw new UnexpectedTypeException($constraint, TaxCode::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        $repository = $this->entityManager->getRepository($constraint->entityClass);
        if (!preg_match('/^[A-Z]{2}[0-9]{9}$/', $value)) {
            $this->context->buildViolation($constraint->messageFormat)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        } else {
            //check if country code is valid
            $countryCode = substr($value, 0, 2);
            $record = $repository->findOneBy(['code' => $countryCode]);
            if (!$record) {
                $this->context->buildViolation($constraint->messageNotFound)
                    ->setParameter('{{ value }}', $countryCode)
                    ->addViolation();
            }
        }
    }
}
