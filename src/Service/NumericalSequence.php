<?php declare(strict_types=1);

namespace App\Service;

class NumericalSequence
{
    public function getMaximumValue($length)
    {
        $result = [];
        $result[0] = 0;
        $result[1] = 1;
        for ($i = 1; $i <= $length; $i++) {
            $result[2 * $i] = $result[$i];
            $result[2 * $i + 1] = $result[$i] + $result[$i + 1];
        }

        return $result[$length];
    }
}