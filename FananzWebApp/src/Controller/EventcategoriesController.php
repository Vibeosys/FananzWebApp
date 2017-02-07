<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Eventcategories Controller
 *
 * @property \App\Model\Table\EventcategoriesTable $Eventcategories
 */
class EventcategoriesController extends AppController {

    public function deleteCategory($categoryId){
        $this->apiInitialize();
        if(!$this->sessionManager->isAdminLoggedIn()){
            $this->redirect('/admin/login');
            return;
        }
        
        $categoryDeleted = $this->Eventcategories->deleteCategory($categoryId);
        $this->response->body(json_encode($categoryDeleted));       
    }

    public function getList() {
        $this->autoRender = FALSE;
        $this->response->type('json');
        $catSubCatList = $this->Eventcategories->getMasterInfo();
        if ($catSubCatList) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareJsonSuccessMessage(102, $catSubCatList));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(202));
        }
    }

    /**
     * Ajax method
     * @return type
     */
    public function addNewCategory() {
        $this->apiInitialize();
        $categoryName = $this->request->data['categoryName'];
        $categoryShortName = \App\Utils\StringUtils::hyphenize($categoryName);
        $categoryExists = $this->Eventcategories->categoryExists(strtolower($categoryName));
        if ($categoryExists) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(227));
            return;
        }
        $categoryAdded = $this->Eventcategories->addNewCategory($categoryName, $categoryShortName);
        if ($categoryAdded) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareJsonSuccessMessage(125));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(228));
        }
    }

    /**
     * Ajax method
     */
    public function updateCategory() {
        $this->apiInitialize();
        $categoryNameToUpdate = $this->request->data['categoryNameToUpdate'];
        $selectedCategoryId = $this->request->data['selectedCategoryId'];

        $categoryUpdated = $this->Eventcategories->updateCategoryName($categoryNameToUpdate, $selectedCategoryId);
        if ($categoryUpdated) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareJsonSuccessMessage(126));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(229));
        }
    }

}
