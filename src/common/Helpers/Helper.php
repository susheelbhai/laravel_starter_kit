<?php

namespace App\Helpers;

class Helper
{

    public static function maskEmail($email)
    {
        print preg_replace_callback('/(\w)(.*?)(\w)(@.*?)$/s', function ($matches) {
            return $matches[1] . preg_replace("/\w/", "*", $matches[2]) . $matches[3] . $matches[4];
        }, $email);
    }

    public static function maskPhone($number)
    {

        $mask_number =  str_repeat("*", strlen($number) - 4) . substr($number, -4);

        return $mask_number;
    }
    
    public static function cleanPhone($number)
    {
        $number =  str_replace(' ', '', $number);
        $number =  str_replace('+', '', $number);
        $number =  str_replace('-', '', $number);
        $number =  str_replace('(', '', $number);
        $number =  str_replace(')', '', $number);
        $number =  substr($number, -10);
        return $number;
    }

    public static function customDate($params = '')
    {
        $date = date_create($params);
        return date_format($date, "jS F Y");
    }

    public static function customTime($params = '')
    {
        $date = date_create($params);
        return date_format($date, "h:i A");
    }

    public static function customDateTime($params = '')
    {
        $date = date_create($params);
        return date_format($date, "jS F Y, h:i A");
    }


    public static function getPercentageDiscount($mrp = '1', $sale_price = 1)
    {
        $amount = (1 - $sale_price / $mrp) * 100;


        return round($amount, 2) . " %";
    }

    public static function customMoneyFormat($amount = '0')
    {
        $amount = number_format($amount, 2, '.', '');
        $amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $amount);
        // dd($amount);

        return $amount;
    }

    public static function customCurrencyFormat($amount = '0')
    {
        // $currency = Currency::whereIsActive(1)->first();
        $currency['sign'] = '₹';
        $amount = number_format($amount, 2, '.', '');
        $amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $amount);

        return $currency['sign'] . " " . $amount;
    }


    public static function rupeesInWord($amount)
    {
        $number = $amount;
        $no = floor($number);
        $point = round($number - $no, 2) * 100;
        $hundred = null;
        $digits_1 = strlen($no);
        $i = 0;
        $str = array();
        $words = array(
            '0' => '', '1' => 'one', '2' => 'two',
            '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
            '7' => 'seven', '8' => 'eight', '9' => 'nine',
            '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
            '13' => 'thirteen', '14' => 'fourteen',
            '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
            '18' => 'eighteen', '19' => 'nineteen', '20' => 'twenty',
            '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
            '60' => 'sixty', '70' => 'seventy',
            '80' => 'eighty', '90' => 'ninety'
        );
        $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
        while ($i < $digits_1) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += ($divider == 10) ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str[] = ($number < 21) ? $words[$number] .
                    " " . $digits[$counter] . $plural . " " . $hundred
                    :
                    $words[floor($number / 10) * 10]
                    . " " . $words[$number % 10] . " "
                    . $digits[$counter] . $plural . " " . $hundred;
            } else $str[] = null;
        }
        $str = array_reverse($str);
        $result = implode('', $str);
        $paise = ($point > 0) ? "and " . ($words[(int)($point / 10) * 10] . " " . $words[$point % 10]) . ' Paise' : '';


        $amount_in_word = $result . "Rupees " . $paise . " only";
        return ucwords($amount_in_word);
    }

}