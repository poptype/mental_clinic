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
        // --管理者ID（１）で一致しなければ強制ページ移動-- //
        $user_id = $this->Authentication->getResult()->getData()->id; //認証ID取得
        if ($user_id != 1) {
            return $this->redirect(['controller' => 'Users', 'action' => 'index']);
        }//-- END --//
        $clinic = $this->Clinics->newEmptyEntity();
        if ($this->request->is('post')) {
            $clinic = $this->Clinics->patchEntity($clinic, $this->request->getData());
            //-- Image upload process --//
            if (!$clinic->getErrors) {
                $image = $this->request->getData('image_file');
                $name = $image->getClientFilename();
                $targetPath = WWW_ROOT . 'img/upload' . DS . $name;
                if ($name) $image->moveTo($targetPath);
                print($name);
                $clinic->image = $name;
            }
            //-- END Image upload process-- //
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
         // --管理者ID（１）で一致しなければ強制ページ移動-- //
        $user_id = $this->Authentication->getResult()->getData()->id; //認証ID取得
        if ($user_id != 1) {
            return $this->redirect(['controller' => 'Users', 'action' => 'index']);
        }//-- END --//

        $clinic = $this->Clinics->get($id, [
            'contain' => [],
        ]);

        //中身を見たい変数などがあれば確認できます。
        //debug();
        //処理をここで止めます。
        //return;

        if ($this->request->is(['patch', 'post', 'put'])) {
            $clinic = $this->Clinics->patchEntity($clinic, $this->request->getData());
	    //-- Image upload process --//
        if(!$clinic->getErrors) {
            $image = $this->request->getData('image_file');
            $name = $image->getClientFilename();
            $targetPath = WWW_ROOT. 'img/upload' .DS.$name;
            if($name) $image->moveTo($targetPath);
            $clinic->image = $name;
        }
            //-- END Image upload process-- //
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
        // --管理者ID（１）で一致しなければ強制ページ移動-- //
        $user_id = $this->Authentication->getResult()->getData()->id; //認証ID取得
        if ($user_id != 1) {
            return $this->redirect(['controller' => 'Users', 'action' => 'index']);
        }//-- END --//

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
