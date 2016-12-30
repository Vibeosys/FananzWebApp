<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PortfolioPhotos Controller
 *
 * @property \App\Model\Table\PortfolioPhotosTable $PortfolioPhotos
 */
class PortfolioPhotosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $portfolioPhotos = $this->paginate($this->PortfolioPhotos);

        $this->set(compact('portfolioPhotos'));
        $this->set('_serialize', ['portfolioPhotos']);
    }

    /**
     * View method
     *
     * @param string|null $id Portfolio Photo id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $portfolioPhoto = $this->PortfolioPhotos->get($id, [
            'contain' => []
        ]);

        $this->set('portfolioPhoto', $portfolioPhoto);
        $this->set('_serialize', ['portfolioPhoto']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $portfolioPhoto = $this->PortfolioPhotos->newEntity();
        if ($this->request->is('post')) {
            $portfolioPhoto = $this->PortfolioPhotos->patchEntity($portfolioPhoto, $this->request->data);
            if ($this->PortfolioPhotos->save($portfolioPhoto)) {
                $this->Flash->success(__('The portfolio photo has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The portfolio photo could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('portfolioPhoto'));
        $this->set('_serialize', ['portfolioPhoto']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Portfolio Photo id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $portfolioPhoto = $this->PortfolioPhotos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $portfolioPhoto = $this->PortfolioPhotos->patchEntity($portfolioPhoto, $this->request->data);
            if ($this->PortfolioPhotos->save($portfolioPhoto)) {
                $this->Flash->success(__('The portfolio photo has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The portfolio photo could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('portfolioPhoto'));
        $this->set('_serialize', ['portfolioPhoto']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Portfolio Photo id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $portfolioPhoto = $this->PortfolioPhotos->get($id);
        if ($this->PortfolioPhotos->delete($portfolioPhoto)) {
            $this->Flash->success(__('The portfolio photo has been deleted.'));
        } else {
            $this->Flash->error(__('The portfolio photo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
