<?php

declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;

class MyComponent extends Component
{

	public $components = array('Authentication');


	/**
	 * 管理者ID（１）で一致しなければ強制ページ移動
	 *
	 * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
	 */
	public function is_admin()
	{
		$controller = $this->getController();
		// --管理者ID（１）で一致しなければ強制ページ移動-- //
		if(empty($this->Authentication->getResult()->getData()->id)) return $controller->redirect(['controller' => 'Users', 'action' => 'index']);
		$user_id = $this->Authentication->getResult()->getData()->id; //認証ID取得
		if ($user_id != 1) {
			return $controller->redirect(['controller' => 'Users', 'action' => 'index']);
		} //-- END --//
	}

	public function image_upload($entity, $request)
	{
		//-- Image upload process --//
		if (!$entity->getErrors) {
			$image = $request->getData('image_file');
			$name = $image->getClientFilename();
			$targetPath = WWW_ROOT . 'img/upload' . DS . $name;
			if ($name) $image->moveTo($targetPath);
			print($name);
			$entity->image = $name;
		}
		//-- END Image upload process-- //
	}
}
