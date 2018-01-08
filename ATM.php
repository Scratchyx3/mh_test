<?php
/**
 * Created by PhpStorm.
 * User: Christoph Rohrmoser
 * Date: 14.12.2017
 * Time: 18:35
 */
$input = explode(" ", trim(fgets(STDIN)));
$cash_draw_amount = $input[0];
$initial_account_balance = floatval($input[1]);

if ($cash_draw_amount % 5 == 0 && $cash_draw_amount <= ($initial_account_balance - 0.50)) {
    $result =  $initial_account_balance - ($cash_draw_amount + 0.50);
} else {
    $result = $initial_account_balance;
}
echo $result;
