<?php
/**
 * Created by PhpStorm.
 * User: o.ogunsola
 * Date: 4/30/14
 * Time: 7:56 AM
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Input extends CI_Input {
    function dump_post()
    {
        $post = array();
        foreach ( array_keys($_POST) as $key )
        {
            $post[$key] = $this->post($key);
        }
        //echo '<pre>'; var_dump($post); echo '</pre>';
        return $post;
    }

    function dump_get()
    {
        $get = array();
        foreach ( array_keys($_GET) as $key )
        {
            $get[$key] = $this->get($key);
        }
        //echo '<pre>'; var_dump($post); echo '</pre>';
        return $get;
    }

    function dump_file()
    {
        $file = array();
        foreach ( array_keys($_FILES) as $key )
        {
            $file[$key] = $this->file($key);
        }
        //echo '<pre>'; var_dump($post); echo '</pre>';
        return $file;
    }

} 