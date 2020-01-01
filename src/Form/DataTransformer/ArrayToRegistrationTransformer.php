<?php


namespace App\Form\DataTransformer;


use Symfony\Component\Form\DataTransformerInterface;

class ArrayToRegistrationTransformer implements DataTransformerInterface
{
    public function transform($value)
    {
        return '';
    }

    public function reverseTransform($value)
    {
        return '';
    }
}