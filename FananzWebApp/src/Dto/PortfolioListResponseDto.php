<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto;

/**
 * Description of PortfolioListResponseDto
 *
 * @author anand
 */
class PortfolioListResponseDto {
    //put your code here
    public $portfolioId;
    public $subscriberName;
    public $categoryId;
    public $category;
    public $subcategoryId;
    public $subcategory;
    public $minPrice;
    public $maxPrice;
    public $coverImageUrl;
}
