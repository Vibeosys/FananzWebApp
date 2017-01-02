<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto;

/**
 * Description of PortfolioAdditionDto
 *
 * @author anand
 */
class PortfolioAdditionDto extends JsonDeserializer {

    //put your code here
    public $portfolioId;
    public $categoryId;
    public $subCategoryId;
    public $fbLink;
    public $youtubeLink;
    public $aboutUs;
    public $minPrice;
    public $maxPrice;

}
