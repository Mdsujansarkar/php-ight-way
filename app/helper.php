<?php
declare(strict_types=1);

function formatToDollar(float $amount): string{
    $isNagitive = $amount < 0;

    return ($isNagitive ? '-' : '') . '$' . number_format(abs($amount), 2);
}