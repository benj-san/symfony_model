<?php


namespace App\Service;


class CapsGenerator
{
    public function capsMeMaybe($protagonistName)
    {
        $explodedName = explode(' ', $protagonistName);
        for($i = 0; $i < count($explodedName); $i++ )
        {
            $explodedName[$i] = ucfirst($explodedName[$i]);
        }
        $wellWrittenName = implode(' ', $explodedName);

        return $wellWrittenName;
    }
}