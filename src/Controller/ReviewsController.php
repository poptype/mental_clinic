<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Reviews Controller
 *
 * @property \App\Model\Table\ReviewsTable $Reviews
 * @method \App\Model\Entity\Review[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReviewsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Clinics'],
        ];
        $reviews = $this->paginate($this->Reviews);

        $this->set(compact('reviews'));
    }

    /**
     * View method
     *
     * @param string|null $id Review id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $review = $this->Reviews->get($id, [
            'contain' => ['Users', 'Clinics'],
        ]);

        $this->set(compact('review'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user_id = $this->Authentication->getResult()->getData()->id;
        $review = $this->Reviews->newEmptyEntity();
        if ($this->request->is('post')) {
          //-- postされた病院名とidを照合してDataBaseにinsertする配列を文字列からidに入れ替える --//
            $post_record = $this->request->getData(); //postRecordの配列取得
            $clinic = $this->Reviews->Clinics->find('list')->select(['id'])->where(['name ' =>$post_record['clinic_id']])->toArray(); //postされた病院名からその行のidとの連想配列を取得
            $post_record["clinic_id"] = array_search($post_record['clinic_id'], $clinic);//postされた配列をさっきの連想配列のidと入れ替える
            $review = $this->Reviews->patchEntity($review, $post_record);//patchEntity
            if ($this->Reviews->save($review)) {
                $this->Flash->success(__('The review has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The review could not be saved. Please, try again.'));
        }
        //$users = $this->Reviews->Users->find('list', ['limit' => 200]);

        // -- autosuggestのための処理 -- //
        $clinics_list = $this->Reviews->Clinics->find('list', ['limit' => 200])->toArray(); //clinicのレコードを配列で抽出
        $suggestWordJson = json_encode($clinics_list);    // 配列をJsonデータへ変換 *Jsonにしないと受け取れない

        $this->set(compact('review', 'user_id', 'suggestWordJson'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Review id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
      // --ログインユーザーのIDとpostされたIDが一致しなければ強制ページ移動-- //
        $user_id = $this->Authentication->getResult()->getData()->id; //認証ID取得
        if ($user_id != $id) {
            return $this->redirect(['controller' => 'Users', 'action' => 'index']);
        }//-- END --//

        $review = $this->Reviews->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $review = $this->Reviews->patchEntity($review, $this->request->getData());
            if ($this->Reviews->save($review)) {
                $this->Flash->success(__('The review has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The review could not be saved. Please, try again.'));
        }
        $users = $this->Reviews->Users->find('list', ['limit' => 200]);
        $clinics = $this->Reviews->Clinics->find('list', ['limit' => 200]);
        $this->set(compact('review', 'users', 'clinics'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Review id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
       // --ログインユーザーのIDとpostされたIDが一致しなければ強制ページ移動-- //
        $user_id = $this->Authentication->getResult()->getData()->id; //認証ID取得
        if ($user_id != $id) {
            return $this->redirect(['controller' => 'Users', 'action' => 'index']);
        }//-- END --//

        $this->request->allowMethod(['post', 'delete']);
        $review = $this->Reviews->get($id);
        if ($this->Reviews->delete($review)) {
            $this->Flash->success(__('The review has been deleted.'));
        } else {
            $this->Flash->error(__('The review could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function top($id = null)
    {
        $this->loadModel('DiseaseCategories');
        $this->paginate = [
            'contain' => ['Users', 'Clinics'],
        ];
        $reviews = $this->paginate($this->Reviews);

        $this->set(compact('reviews'));
        $this->set('disease_categories', $this->DiseaseCategories->find('all'));
    }
}
