<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if (! function_exists('d')) {

    /**
     * Dump data
     * 
     * Print data dengan var_dump dengan diselimuti tag \<pre\>
     * agar lebih rapih
     * 
     * @param    mixed    $data    Data  yang mau di-print
     */
    function d($data)
    {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
        echo '<br>';
    }
}