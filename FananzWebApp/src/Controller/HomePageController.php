<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use App\Controller\AppController;

//use App\Model\Table;

/**
 * Description of HomeController
 *
 * @author jyotima
 */
class HomePageController extends AppController {

    //put your code here


    public function index() {

        $eventCategoriesTable = new \App\Model\Table\EventcategoriesTable();
        $eventCategoryList = $eventCategoriesTable->getCategoriesAndSubcategories();

        $this->set(['eventCategoryList' => $eventCategoryList]);

        $portfolioTable = new \App\Model\Table\PortfolioTable();
        $portfoioList = $portfolioTable->getSelectedPortfolioList();

        $this->set(['portfoioList' => $portfoioList]);
    }

}
