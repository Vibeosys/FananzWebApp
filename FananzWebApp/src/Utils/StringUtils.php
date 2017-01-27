<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Utils;

/**
 * Description of StringUtils
 *
 * @author anand
 */
class StringUtils {

    //put your code here
    public static function hyphenize($string) {
        $dict = array(
            "I'm" => "I am",
            "thier" => "their",
        );
        return strtolower(
                preg_replace(
                        array('#[\\s-]+#', '#[^A-Za-z0-9\. -]+#'), array('-', ''),
                        // the full cleanString() can be download from http://www.unexpectedit.com/php/php-clean-string-of-utf8-chars-convert-to-similar-ascii-char
                        static::cleanString(
                                str_replace(// preg_replace to support more complicated replacements
                                        array_keys($dict), array_values($dict), urldecode($string)
                                )
                        )
                )
        );
    }

    private static function cleanString($text) {
        $utf8 = array(
            '/[áàâãªä]/u' => 'a',
            '/[ÁÀÂÃÄ]/u' => 'A',
            '/[ÍÌÎÏ]/u' => 'I',
            '/[íìîï]/u' => 'i',
            '/[éèêë]/u' => 'e',
            '/[ÉÈÊË]/u' => 'E',
            '/[óòôõºö]/u' => 'o',
            '/[ÓÒÔÕÖ]/u' => 'O',
            '/[úùûü]/u' => 'u',
            '/[ÚÙÛÜ]/u' => 'U',
            '/ç/' => 'c',
            '/Ç/' => 'C',
            '/ñ/' => 'n',
            '/Ñ/' => 'N',
            '/–/' => '-', // UTF-8 hyphen to "normal" hyphen
            '/[’‘‹›‚]/u' => ' ', // Literally a single quote
            '/[“”«»„]/u' => ' ', // Double quote
            '/ /' => ' ', // nonbreaking space (equiv. to 0x160)
        );
        return preg_replace(array_keys($utf8), array_values($utf8), $text);
    }

}
