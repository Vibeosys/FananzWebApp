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


}
