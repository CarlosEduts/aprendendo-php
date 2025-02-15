<?php

echo "Verificar se uma lita de números é divisivel:";
echo "\n";

echo "De 1 até: ";
$verify_user_num = (int) fgets(STDIN);

echo "Divisor: ";
$divider = (int) fgets(STDIN);

$divisible_numbers = [];
$amount_divisibles = 0;

for ($i = 1; $i <= $verify_user_num; $i++) {
    if ($i % $divider === 0) {
        array_push($divisible_numbers, $i);
        $amount_divisibles += 1;
    }
}

echo "Qunatidade de divisíveis: " . $amount_divisibles . "\n";
print_r($divisible_numbers);
