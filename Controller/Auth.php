<?php

namespace Controller;


use Models\Auth\JwtAuth;

class Auth
{
    public function jwt1()
    {
        (new JwtAuth())->HS256();
    }


    public function jwt2()
    {
        (new JwtAuth())->RS256();
    }


    public function sign()
    {
        $param = [
            'name' => 'luce',
            'age' => '25',
            'sex' => 'girl',
            'time' => strtotime('2019-04-12 11:02:45'),
            'appid' => 'd930ea5d5a258f4f',
            'nonce' => 'ibuaiVcKdpRxkhJA',

        ]; // get all parameters of $_GET and $_POST

        //array_shift($param); // cli if the $param[0] is function name, please shift it

//        $new_param = array();
//        foreach ($param as $k => $v) {
//            list ($pk, $pv) = explode('=', $v);
//            $new_param[$pk] = $pv;
//            unset($param[$k]);
//        }

        $secret = '6c9f387bb7e5e382898c3868d261254b'; // this is the secret which our appid applied
        $param['secret_key'] = $secret; // please add the key 'secret_key', it will be to get sign
        ksort($param); // this is sort by the key ascending
        if (isset($param['sign'])) { // is exists sign key, please unset
            unset($param['sign']);
        }

        print_r($param);
        $link = ''; // in the after, return md5($link)
        foreach ($param as $k => $v) {
            $k = trim($k);
            $v = trim($v);
            if ($v == '') {
                continue;
            }

            $link .= "$k=$v&";

        }

        $link = rtrim($link, '&');
        echo $link;
        echo PHP_EOL;
        echo strtoupper(md5($link));

        echo "\n";
    }


    public function signCheck()
    {
        //SIGN   5FDC062FD3ECC326BCF8DA2DE57ABE1A

        //SECRET 6c9f387bb7e5e382898c3868d261254b

        $param = [
            'name' => 'luce',
            'age' => '25',
            'sex' => 'girl',
            'time' => strtotime('2019-04-12 11:02:45'),
            'appid' => 'd930ea5d5a258f4f',
            'nonce' => 'ibuaiVcKdpRxkhJA',
            'sign' => '5FDC062FD3ECC326BCF8DA2DE57ABE1A',

        ];

        $sign = $param['sign'];
        $secret = '6c9f387bb7e5e382898c3868d261254b'; // this is the secret which our appid applied
        $param['secret_key'] = $secret; // please add the key 'secret_key', it will be to get sign
        ksort($param); // this is sort by the key ascending
        unset($param['sign']);

        print_r($param);
        $link = ''; // in the after, return md5($link)
        foreach ($param as $k => $v) {
            $k = trim($k);
            $v = trim($v);
            if ($v == '') {
                continue;
            }

            $link .= "$k=$v&";

        }

        $link = rtrim($link, '&');
        echo strtoupper(md5($link));
        echo PHP_EOL;
        $ret = strtoupper(md5($link)) === $sign ?: false ;
        var_dump($ret);
    }
}