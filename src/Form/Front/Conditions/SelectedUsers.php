<?php

namespace App\Form\Front\Conditions;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class SelectedUsers extends Constraint
{
    public $message = 'Veuillez sélectionner au moins un utilisateur.';
}