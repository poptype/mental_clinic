<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Clinics Controller
 *
 * @property \App\Model\Table\ClinicsTable $Clinics
 * @method \App\Model\Entity\Clinic[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClinicsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $clinics = $this->paginate($this->Clinics);

        $this->set(compact('clinics'));
    }

    /**
     * View method
     *
     * @param string|null $id Clinic id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $clinic = $this->Clinics->get($id, [
            'contain' => ['Reviews'],
        ]);

        $this->set(compact('clinic'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $clinic = $this->Clinics->newEmptyEntity();
        if ($this->request->is('post')) {
            $clinic = $this->Clinics->patchEntity($clinic, $this->request->getData());
            if ($this->Clinics->save($clinic)) {
                $this->Flash->success(__('The clinic has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The clinic could not be saved. Please, try again.'));
        }
        $this->set(compact('clinic'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Clinic id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $clinic = $this->Clinics->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $clinic = $this->Clinics->patchEntity($clinic, $this->request->getData());
            if ($this->Clinics->save($clinic)) {
                $this->Flash->success(__('The clinic has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The clinic could not be saved. Please, try again.'));
        }
        $this->set(compact('clinic'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Clinic id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $clinic = $this->Clinics->get($id);
        if ($this->Clinics->delete($clinic)) {
            $this->Flash->success(__('The clinic has been deleted.'));
        } else {
            $this->Flash->error(__('The clinic could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
