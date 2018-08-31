<?php

namespace App\Service;

class YoutubeLinkUploader
{
    public function getLink($url)
    {
        parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
        return 'https://www.youtube.com/embed/' . $my_array_of_vars['v'];
    }
}