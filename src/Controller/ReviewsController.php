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
	public function add($clinic_id = null)
	{
		$user_id = $this->Authentication->getResult()->getData()->id;
		$review = $this->Reviews->newEmptyEntity();
		$this->loadModel('Clinics');
		if ($this->request->is('post')) {
			//-- postされた病院名とidを照合してDataBaseにinsertする配列を文字列からidに入れ替える --//
			$post_record = $this->request->getData(); //postRecordの配列取得
			$clinic = $this->Reviews->Clinics->find('list')->select(['id'])->where(['name ' => $post_record['clinic_id']])->toArray(); //postされた病院名からその行のidとの連想配列を取得
			$post_record["clinic_id"] = array_search($post_record['clinic_id'], $clinic); //postされた配列をさっきの連想配列のidと入れ替える
			$review = $this->Reviews->patchEntity($review, $post_record); //patchEntity
			if ($this->Reviews->save($review)) {
				// --update to average of clinic rating-- //
				# debug(array_keys($clinic));
				$clinic = $this->Clinics->get(array_keys($clinic), [#連想配列からKEYを取得する。それはpostされてきたclinic_idを取得することと、同じ。
					'contain' => [],
				]);
				$rating = $this->request->getData('rating');
				$datas = array($clinic->rating, $rating);
				$sum = array_sum($datas);
				$average_rating = $sum / count($datas);
				$clinic->rating = $rating;
				$this->Clinics->save($clinic);
				// --END clinic update-- //
				$this->Flash->success(__('レビューを投稿しました。'));

				return $this->redirect(['controler' => 'Reviews', 'action' => 'top']);
			}
			$this->Flash->error(__('投稿に失敗しました。お手数ですが、入力内容を確認して下さい。'));
		}
		//$users = $this->Reviews->Users->find('list', ['limit' => 200]);

		// -- autosuggestのための処理 -- //
		$clinics_list = $this->Reviews->Clinics->find('list', ['limit' => 200])->toArray(); //clinicのレコードを配列で抽出
		$suggestWordJson = json_encode($clinics_list);    // 配列をJsonデータへ変換 *Jsonにしないと受け取れない

		$this->set(compact('review', 'user_id', 'suggestWordJson'));
	}

	public function addFromClinic($clinic_id = null){
		$user_id = $this->Authentication->getResult()->getData()->id;
		$review = $this->Reviews->newEmptyEntity();
		$this->loadModel('Clinics');
		if ($this->request->is('post')) {
			$review = $this->Reviews->patchEntity($review, $this->request->getData()); //patchEntity
			if ($this->Reviews->save($review)) {
				// --update to average of clinic rating-- //
				# debug(array_keys($clinic));
				$clinic = $this->Clinics->get(($clinic_id), [#連想配列からKEYを取得する。それはpostされてきたclinic_idを取得することと、同じ。
					'contain' => [],
				]);
				$rating = $this->request->getData('rating');
				$datas = array($clinic->rating, $rating);
				$sum = array_sum($datas);
				$average_rating = $sum / count($datas);
				$clinic->rating = $rating;
				$this->Clinics->save($clinic);
				// --END clinic update-- //
				$this->Flash->success(__('レビューを投稿しました。'));

				return $this->redirect(['controler' => 'Reviews', 'action' => 'top']);
			}
			$this->Flash->error(__('投稿に失敗しました。お手数ですが、入力内容を確認して下さい。'));
		}

		$this->set(compact('review', 'user_id', 'clinic_id'));
	}
	/**
	 * Edit method
	 *
	 * @param string|null $id Review id.
	 * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function edit($id = null, $username_id = null)
	{
		// --ログインユーザーのIDとpostされたIDが一致しなければ強制ページ移動-- //
		$user_id = $this->Authentication->getResult()->getData()->id; //認証ID取得
		if ($user_id != $username_id) {
			return $this->redirect(['controller' => 'Users', 'action' => 'index']);
		} //-- END --//

		$review = $this->Reviews->get($id, [
			'contain' => [],
		]);
		$this->loadModel('Clinics');
		$clinic = $this->Clinics->get($review->clinic_id, [
			'contain' => [],
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$review = $this->Reviews->patchEntity($review, $this->request->getData());
			if ($this->Reviews->save($review)) {
				$this->Flash->success(__('The review has been saved.'));
				// --update to average of clinic rating-- //
				$rating = $this->request->getData('rating');
				$datas = array($clinic->rating, $rating);
				$sum = array_sum($datas);
				$average_rating = $sum / count($datas);
				$clinic->rating = $rating;
				$this->Clinics->save($clinic);
				// --END clinic update-- //
				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The review could not be saved. Please, try again.'));
			//中身を見たい変数などがあれば確認できます。
			// debug($average_rating);
			//処理をここで止めます。
			// return;
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
		} //-- END --//

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

		// --form post されてきた value of voting のみpatchEntityする-- //
		if ($this->request->is(['patch', 'post', 'put'])) {
			$review = $this->Reviews->get($this->request->getData('id'), [ #get reviews_id from requestObject
				'contain' => [],
			]);
			$review = $this->Reviews->patchEntity($review, $this->request->getData());
			if ($this->Reviews->save($review)) {
				$this->Flash->success(__('口コミに投稿されました'));

				return $this->redirect(['action' => 'top']);
			}
			$this->Flash->error(__('The review could not be saved. Please, try again.'));
		}

		$this->set(compact('reviews'));
		$this->set('disease_categories', $this->DiseaseCategories->find('all'));
	}
}
