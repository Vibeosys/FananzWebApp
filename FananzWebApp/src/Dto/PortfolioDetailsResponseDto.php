<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dto;

/**
 * Description of SubscriberPortfolioDetailsResponseDto
 *
 * @author anand
 */
class PortfolioDetailsResponseDto {

    //put your code here
    public $portfolioId;
    public $categoryId;
    public $category;
    public $subCategoryId;
    public $subCategory;
    public $subscriberId;
    public $subscriberName;
    public $minPrice;
    public $maxPrice;
    public $fbLink;
    public $youtubeLink;
    public $aboutUs;
    public $photos;
    public $coverImageUrl;
}
