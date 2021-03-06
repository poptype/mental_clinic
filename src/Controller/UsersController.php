<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
	public function initialize(): void
	{
		parent::initialize();
		$this->loadComponent('My');
	}

	/**
	 * Index method
	 *
	 * @return \Cake\Http\Response|null|void Renders view
	 */
	public function index()
	{
		$this->paginate = [
			'contain' => ['DiseaseCategories'],
		];
		$users = $this->paginate($this->Users);

		$this->set(compact('users'));

		$key = $this->request->getQuery('key');
		if ($key) {
			$users = [];
			$users = $this->Users->find()
				->where([
					'Or' => [
						"username like " => '%' . $key . '%',
						"gender like " => '%' . $key . '%',
						"DiseaseCategories.name like " => '%' . $key . '%',
						"email" => $key,
					]
				]);

			$users = $this->paginate($users);
			$this->set('users', $users);
		}
	}

	/**
	 * View method
	 *
	 * @param string|null $id User id.
	 * @return \Cake\Http\Response|null|void Renders view
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$this->loadModel('Clinics');
		$result = $this->Authentication->getResult();
		$user = $this->Users->get($id, [
			'contain' => ['DiseaseCategories', 'Reviews'],
		]);

		$this->set(compact('user'));
		$this->set('clinics', $this->Clinics->find('all'));
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$user = $this->Users->newEmptyEntity();
		if ($this->request->is('post')) {
			$user = $this->Users->patchEntity($user, $this->request->getData());
			//-- Image upload process --//
			if (!$user->getErrors()) {
				$this->My->image_upload($user, $this->request);
				$this->session = $this->getRequest()->getSession();
				$this->session->write('user_add', $user);
				$this->session->write('user_request', $this->request->getData());
				return $this->redirect(['action' => 'confirm']);
			}
			//-- END Image upload process-- //
			// if ($this->Users->save($user)) {
			//     $this->Flash->success(__('The user has been saved.'));

			//     return $this->redirect(['action' => 'index']);
			// }
			$this->Flash->error(__('The user could not be saved. Please, try again.'));
		}
		$diseaseCategories = $this->Users->DiseaseCategories->find('list', ['limit' => 200]);
		$this->set(compact('user', 'diseaseCategories'));
	}

	public function confirm()
	{
		$user = $this->request->getSession()->read('user_add');
		$user_request = $this->request->getSession()->read('user_request');
		if ($this->request->is('post')) {
			return $this->redirect(['action' => 'complete']);
		}
		$this->loadModel('DiseaseCategories');

		$this->set('diseaseCategories', $this->DiseaseCategories->find('all'));
		//＊＊暗号化する前のpasswordを表示したい処理(patchentityする前のpostdataを渡す)
		$this->set('password', $user_request['password']); //requestは連想配列なのでkeyからvalueを渡す
		$this->set(compact('user'));
	}

	public function complete()
	{
		$user = $this->request->getSession()->read('user_add');
		if (!empty($user)) {
			$result = $this->Users->save($user);
			if (!$result) {
				$this->Flash->error('保存できませんでした。');
				$this->request->session()->write('errors', $user);
				// return $this->redirect($this->referer());
			}
		}
	}
	/**
	 * Edit method
	 *
	 * @param string|null $id User id.
	 * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		if (isset($this->Authentication->getResult()->getData()->id) && $this->Authentication->getResult()->getData()->id != 1)
			$this->is_sessionUser($id);

		$user = $this->Users->get($id, [
			'contain' => [],
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$user = $this->Users->patchEntity($user, $this->request->getData());

			$this->My->image_upload($user, $this->request);

			if ($this->Users->save($user)) {
				$this->Flash->success(__('ユーザー情報が変更されました。'));

				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('入力内容を確認してください。'));
		}
		$diseaseCategories = $this->Users->DiseaseCategories->find('list', ['limit' => 200]);
		$this->set(compact('user', 'diseaseCategories'));
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id User id.
	 * @return \Cake\Http\Response|null|void Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		if (isset($this->Authentication->getResult()->getData()->id) && $this->Authentication->getResult()->getData()->id != 1)
			$this->is_sessionUser($id);

		$this->request->allowMethod(['post', 'delete']);
		$user = $this->Users->get($id);
		if ($this->Users->delete($user)) {
			$this->Flash->success(__('アカウントを削除しました。'));
		} else {
			$this->Flash->error(__('アカウントの削除に失敗しました。もう一度お試し下さい。'));
		}

		return $this->redirect(['action' => 'index']);
	}

	public function beforeFilter(\Cake\Event\EventInterface $event)
	{
		parent::beforeFilter($event);
		// ログインアクションを認証を必要としないように設定することで、
		//
		// 無限リダイレクトループの問題を防ぐことができます
		//
		$this->Authentication->addUnauthenticatedActions(['login', 'add', 'confirm', 'complete']);
	}

	public function login()
	{
		$this->request->allowMethod(['get', 'post']);
		$result = $this->Authentication->getResult();

		// POSTやGETに関係なく、ユーザーがログインしていればリダイレクトします
		//
		if ($result->isValid()) {
			// ログイン成功後に /article にリダイレクトします
			$result = $this->Authentication->getResult();
			$user = $result->getData();
			// 管理者でログインしたら管理者用ページへリダイレクト
			if ($user->id == 1) {
				$redirect = $this->request->getQuery('redirect', [
					'controller' => 'Users',
					'action' => 'admin',
					$user->id,
				]);
				return $this->redirect($redirect);
			} else {
				$redirect = $this->request->getQuery('redirect', [
					'controller' => 'Users',
					'action' => 'view', //ログインUserのviewにリンク
					$user->id,
				]);
				return $this->redirect($redirect);
			}
		}
		// ユーザーの送信と認証に失敗した場合にエラーを表示します
		//
		if ($this->request->is('post') && !$result->isValid()) {
			$this->Flash->error(__('ユーザーネームかパスワードが正しくありません。'));
		}
	}

	public function logout()
	{
		$result = $this->Authentication->getResult();

		// POSTやGETに関係なく、ユーザーがログインしていればリダイレクトします
		//
		if ($result->isValid()) {
			$this->Authentication->logout();

			return $this->redirect(['controller' => 'Users', 'action' => 'login']);
		}
	}

	/**
	 * ログインユーザーのIDとpostされたIDが一致しなければ強制ページ移動
	 *
	 * @return \Cake\Http\Response|null|void Renders view
	 */
	private function is_sessionUser($id)
	{
		$session_id = $this->Authentication->getResult()->getData()->id; //認証ID取得
		if ($id != $session_id) {
			return $this->redirect(['controller' => 'Users', 'action' => 'index']);
		}
	}

	public function admin($id = null)
	{
		$this->loadModel('Clinics');
		$result = $this->Authentication->getResult();
		$user = $this->Users->get($id, [
			'contain' => ['DiseaseCategories', 'Reviews'],
		]);

		$this->set(compact('user'));
		$this->set('clinics', $this->Clinics->find('all'));
	}

	public function list($id = null)
	{
		$this->My->is_admin();
		$users = $this->paginate($this->Users);

		$this->set(compact('users'));
	}
}
