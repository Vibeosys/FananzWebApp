<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Eventcategories Controller
 *
 * @property \App\Model\Table\EventcategoriesTable $Eventcategories
 */
class EventcategoriesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $eventcategories = $this->paginate($this->Eventcategories);

        $this->set(compact('eventcategories'));
        $this->set('_serialize', ['eventcategories']);
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
     * View method
     *
     * @param string|null $id Eventcategory id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $eventcategory = $this->Eventcategories->get($id, [
            'contain' => []
        ]);

        $this->set('eventcategory', $eventcategory);
        $this->set('_serialize', ['eventcategory']);
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
