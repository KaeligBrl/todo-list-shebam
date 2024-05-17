<?php

namespace App\Form\Front\Conditions;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\Common\Collections\Collection;

class SelectedUsersValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$value instanceof Collection || $value->isEmpty()) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}