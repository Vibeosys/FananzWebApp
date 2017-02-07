<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Subcategories Controller
 *
 * @property \App\Model\Table\SubcategoriesTable $Subcategories
 */
class SubcategoriesController extends AppController {

    /**
     * Ajax call for add sub category
     */
    public function addSubcategory() {
        $this->apiInitialize();
        $categoryId = $this->request->data['categoryId'];
        $subCategoryName = $this->request->data['subCategoryName'];
        $subCategoryExists = $this->Subcategories->checkSubcategoryExists(strtolower($subCategoryName), $categoryId);
        if ($subCategoryExists) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(230));
            return;
        }
        $subCategoryShortName = \App\Utils\StringUtils::hyphenize($subCategoryName);
        $addSuccess = $this->Subcategories->addNewSubcategory($categoryId, $subCategoryName, $subCategoryShortName);
        if ($addSuccess) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareJsonSuccessMessage(127));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(231));
        }
    }

    public function deleteSubcategory($subCategoryId) {
        $this->apiInitialize();
        if (!$this->sessionManager->isAdminLoggedIn()) {
            $this->redirect('/admin/login');
            return;
        }

        $subCategoryDeleted = $this->Subcategories->deleteSubcategory($subCategoryId);
        $this->response->body(json_encode($subCategoryDeleted));
    }

    public function getSubCategoryList($categoryId) {
        $this->apiInitialize();
        $subCategoryList = $this->Subcategories->getSubCategoryList($categoryId);
        $encodedString = json_encode($subCategoryList);
        $this->response->body($encodedString);
    }

    public function updateSubcategory() {
        $this->apiInitialize();
        $subCategoryName = $this->request->data['subCategoryName'];
        $subCategoryId = $this->request->data['subCategoryId'];

        $categoryUpdated = $this->Subcategories->updateSubcategory($subCategoryId, $subCategoryName);
        if ($categoryUpdated) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareSuccessMessage(128));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(232));
        }
    }

}
