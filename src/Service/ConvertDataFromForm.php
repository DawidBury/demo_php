<?php declare(strict_types=1);

namespace App\Service;

class ConvertDataFromForm
{
    public function getDataToArray(string $inputValue)
    {
        $inputValue = str_replace(' ', '', $inputValue);
        return explode(',', $inputValue);
    }
}