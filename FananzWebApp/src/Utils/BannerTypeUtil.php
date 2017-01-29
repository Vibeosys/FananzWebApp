<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Utils;

/**
 * Description of BannerTypeUtil
 *
 * @author anand
 */
class BannerTypeUtil {

//put your code here
    public static function getDefaultTypeList() {
        return [
            -1 => 'Select Banner Location',
            HOME_PAGE_TOP_BANNER => 'Home Page Top Banner',
            HOME_PAGE_BOTTOM_BANNER => 'Home Page Bottom Banner',
            PORTFOLIO_PAGE_TOP_BANNER => 'Portfolio Page Top Banner',
            PORTFOLIO_PAGE_BOTTOM_BANNER => 'Portfolio Page Bottom Banner'
        ];
    }

}
