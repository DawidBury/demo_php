<?php declare(strict_types=1);

namespace App\Utils;

use Symfony\Component\Console\Exception\InvalidArgumentException;

class Validator
{
    public function validateInputNumber($number)
    {
        $number = (int)$number;
        if ($number === null) {
            throw new InvalidArgumentException('Wprowadzona liczba nie może być pusta');
        }

        if ($number <= 1 || $number >= 99999) {
            throw new InvalidArgumentException('Wprowadzona liczba musi być liczbową całkowitą większą lub równą jeden');
        }
    }
}