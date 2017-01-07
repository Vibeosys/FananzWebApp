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

    public function getPortfolioDetails() {
        $this->apiInitialize();
        $portfolioDetaiRequest = \App\Dto\PortfolioDetailRequestDto::Deserialize($this->postedData);
        $portfolioDetails = $this->Portfolio->getPortfolioDetails($portfolioDetaiRequest);
        if ($portfolioDetails) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareJsonSuccessMessage(107, $portfolioDetails));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(208));
        }
    }

    public function addPortfolio() {
        $this->apiInitialize();
        $isAuthorized = $this->isSubscriberAuthorised();
        //If the subscriber is not authorized then return from here
        if (!$isAuthorized) {
            //TODO: add code for error
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(206));
            return;
        }

        $portfolioAddition = \App\Dto\PortfolioAdditionDto::Deserialize($this->postedData);
        $portfolioId = $this->Portfolio->addPortfolio($portfolioAddition, $this->postedSubscriberData->subscriberId);
        if ($portfolioId != 0) {
            $portfolioInfo = new \App\Dto\PortfolioAddResponseDto();
            $portfolioInfo->portfolioId = $portfolioId;
            $this->response->body(\App\Dto\BaseResponseDto::prepareJsonSuccessMessage(105, $portfolioInfo));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(205));
        }
    }

    public function subscriberPortfolioList() {
        $this->apiInitialize();
        $isAuthorized = $this->isSubscriberAuthorised();
        //If the subscriber is not authorized then return from here
        if (!$isAuthorized) {
            //TODO: add code for error
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(206));
            return;
        }

        $portfolioList = $this->Portfolio->getPortfoliosBySubscriber($this->postedSubscriberData->subscriberId);
        if ($portfolioList) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareJsonSuccessMessage(106, $portfolioList));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(207));
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

    public function updatePortfolio() {
        $this->apiInitialize();
        $isAuthorized = $this->isSubscriberAuthorised();
        //If the subscriber is not authorized then return from here
        if (!$isAuthorized) {
            //TODO: add code for error
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(206));
            return;
        }
        $portfolioUpdateRequest = \App\Dto\PortfolioUpdateRequestDto::Deserialize($this->postedData);
        $updateSuccess = $this->Portfolio->updatePortfolio($portfolioUpdateRequest);
        if ($updateSuccess) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareSuccessMessage(115));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(216));
        }
    }

    public function inactivatePortfolio() {
        $this->apiInitialize();
        $isAuthorized = $this->isSubscriberAuthorised();
        //If the subscriber is not authorized then return from here
        if (!$isAuthorized) {
            //TODO: add code for error
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(206));
            return;
        }
        $portfolioInactivateRequest = \App\Dto\InactivatePortfolioRequestDto::Deserialize($this->postedData);
        $inactivateSuccess = $this->Portfolio->inactivatePortfolio
                ($portfolioInactivateRequest->portfolioId, $portfolioInactivateRequest->isActive);
        if ($inactivateSuccess) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareSuccessMessage(118));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(219));
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
