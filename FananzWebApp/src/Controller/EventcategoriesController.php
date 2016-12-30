<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Eventcategories Controller
 *
 * @property \App\Model\Table\EventcategoriesTable $Eventcategories
 */
class EventcategoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $eventcategories = $this->paginate($this->Eventcategories);

        $this->set(compact('eventcategories'));
        $this->set('_serialize', ['eventcategories']);
    }

    /**
     * View method
     *
     * @param string|null $id Eventcategory id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $eventcategory = $this->Eventcategories->get($id, [
            'contain' => []
        ]);

        $this->set('eventcategory', $eventcategory);
        $this->set('_serialize', ['eventcategory']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $eventcategory = $this->Eventcategories->newEntity();
        if ($this->request->is('post')) {
            $eventcategory = $this->Eventcategories->patchEntity($eventcategory, $this->request->data);
            if ($this->Eventcategories->save($eventcategory)) {
                $this->Flash->success(__('The eventcategory has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The eventcategory could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('eventcategory'));
        $this->set('_serialize', ['eventcategory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Eventcategory id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $eventcategory = $this->Eventcategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $eventcategory = $this->Eventcategories->patchEntity($eventcategory, $this->request->data);
            if ($this->Eventcategories->save($eventcategory)) {
                $this->Flash->success(__('The eventcategory has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The eventcategory could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('eventcategory'));
        $this->set('_serialize', ['eventcategory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Eventcategory id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $eventcategory = $this->Eventcategories->get($id);
        if ($this->Eventcategories->delete($eventcategory)) {
            $this->Flash->success(__('The eventcategory has been deleted.'));
        } else {
            $this->Flash->error(__('The eventcategory could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
