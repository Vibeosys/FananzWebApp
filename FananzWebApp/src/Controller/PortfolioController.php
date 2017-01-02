<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Portfolio Controller
 *
 * @property \App\Model\Table\PortfolioTable $Portfolio
 */
class PortfolioController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $portfolio = $this->paginate($this->Portfolio);

        $this->set(compact('portfolio'));
        $this->set('_serialize', ['portfolio']);
    }

    public function addPortfolio() {
        $this->apiInitialize();
        $subscriberUserInfo = \App\Dto\SubscriberUserDto::Deserialize($this->postedUserInfo);
        $subscriberTable = new \App\Model\Table\SubscribersTable();
        $isAuthorized = $subscriberTable->validateSubscriber($subscriberUserInfo);
        //If the subscriber is not authorized then return from here
        if (!$isAuthorized) {
            //TODO: add code for error
        }

        $portfolioAddition = \App\Dto\PortfolioAdditionDto::Deserialize($this->postedData);
        $portfolioId = $this->Portfolio->addPortfolio($portfolioAddition);
        if ($portfolioId != 0) {
            $portfolioInfo = new \App\Dto\PortfolioAddResponseDto();
            $portfolioInfo->portfolioId = $portfolioId;
            $this->response->body(\App\Dto\BaseResponseDto::prepareJsonSuccessMessage(105, $portfolioInfo));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(205));
        }
    }

    /**
     * Gets the list of all portfolios
     */
    public function getList() {
        $this->autoRender = FALSE;
        $portfolioList = $this->Portfolio->getPortfolioList();
        $this->response->type('json');
        if ($portfolioList) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareJsonSuccessMessage(101, $portfolioList));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(201));
        }
    }

    /**
     * View method
     *
     * @param string|null $id Portfolio id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $portfolio = $this->Portfolio->get($id, [
            'contain' => []
        ]);

        $this->set('portfolio', $portfolio);
        $this->set('_serialize', ['portfolio']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $portfolio = $this->Portfolio->newEntity();
        if ($this->request->is('post')) {
            $portfolio = $this->Portfolio->patchEntity($portfolio, $this->request->data);
            if ($this->Portfolio->save($portfolio)) {
                $this->Flash->success(__('The portfolio has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The portfolio could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('portfolio'));
        $this->set('_serialize', ['portfolio']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Portfolio id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $portfolio = $this->Portfolio->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $portfolio = $this->Portfolio->patchEntity($portfolio, $this->request->data);
            if ($this->Portfolio->save($portfolio)) {
                $this->Flash->success(__('The portfolio has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The portfolio could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('portfolio'));
        $this->set('_serialize', ['portfolio']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Portfolio id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $portfolio = $this->Portfolio->get($id);
        if ($this->Portfolio->delete($portfolio)) {
            $this->Flash->success(__('The portfolio has been deleted.'));
        } else {
            $this->Flash->error(__('The portfolio could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
