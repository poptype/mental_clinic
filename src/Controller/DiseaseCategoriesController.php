<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * DiseaseCategories Controller
 *
 * @property \App\Model\Table\DiseaseCategoriesTable $DiseaseCategories
 * @method \App\Model\Entity\DiseaseCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DiseaseCategoriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $diseaseCategories = $this->paginate($this->DiseaseCategories);

        $this->set(compact('diseaseCategories'));
    }

    /**
     * View method
     *
     * @param string|null $id Disease Category id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $diseaseCategory = $this->DiseaseCategories->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('diseaseCategory'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $diseaseCategory = $this->DiseaseCategories->newEmptyEntity();
        if ($this->request->is('post')) {
            $diseaseCategory = $this->DiseaseCategories->patchEntity($diseaseCategory, $this->request->getData());
            if ($this->DiseaseCategories->save($diseaseCategory)) {
                $this->Flash->success(__('The disease category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The disease category could not be saved. Please, try again.'));
        }
        $this->set(compact('diseaseCategory'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Disease Category id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $diseaseCategory = $this->DiseaseCategories->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $diseaseCategory = $this->DiseaseCategories->patchEntity($diseaseCategory, $this->request->getData());
            if ($this->DiseaseCategories->save($diseaseCategory)) {
                $this->Flash->success(__('The disease category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The disease category could not be saved. Please, try again.'));
        }
        $this->set(compact('diseaseCategory'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Disease Category id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $diseaseCategory = $this->DiseaseCategories->get($id);
        if ($this->DiseaseCategories->delete($diseaseCategory)) {
            $this->Flash->success(__('The disease category has been deleted.'));
        } else {
            $this->Flash->error(__('The disease category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
