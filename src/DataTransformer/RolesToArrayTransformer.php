<?php

namespace App\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class RolesToArrayTransformer implements DataTransformerInterface
{
    public function transform($roles): mixed
    {
        if (!is_array($roles)) {
            throw new TransformationFailedException('The roles must be an array.');
        }

        return implode(',', $roles);
    }

    public function reverseTransform($string): mixed
    {
        if (!is_string($string)) {
            throw new TransformationFailedException('The roles must be a string.');
        }

        return explode(',', $string);
    }
}
