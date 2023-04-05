<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class TaxCode extends Constraint
{
    public string $messageFormat = 'Tax code "{{ value }}" should be in format AA123456789.';
    public string $messageNotFound = 'Country code "{{ value }}" is not found.';

    public $entityClass;

    public function getRequiredOptions()
    {
        return ['entityClass'];
    }

    public function validatedBy()
    {
        return static::class . 'Validator';
    }
}
