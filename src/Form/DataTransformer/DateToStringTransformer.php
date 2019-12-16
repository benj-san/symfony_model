<?php


namespace App\Form\DataTransformer ;


use Symfony\Component\Form\DataTransformerInterface;

class DateToStringTransformer implements DataTransformerInterface
{
    public function transform($value) :string
    {
        return $value->format('Y-m-d');
    }

    public function reverseTransform($value)
    {
        return '';
    }
}