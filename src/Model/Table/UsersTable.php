<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\DiseaseCategoriesTable&\Cake\ORM\Association\BelongsTo $DiseaseCategories
 * @property \App\Model\Table\ReviewsTable&\Cake\ORM\Association\HasMany $Reviews
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{
	/**
	 * Initialize method
	 *
	 * @param array $config The configuration for the Table.
	 * @return void
	 */
	public function initialize(array $config): void
	{
		parent::initialize($config);

		$this->setTable('users');
		$this->setDisplayField('username');
		$this->setPrimaryKey('id');

		$this->addBehavior('Timestamp');

		$this->belongsTo('DiseaseCategories', [
			'foreignKey' => 'disease_categorie_id',
			'joinType' => 'INNER',
		]);
		$this->hasMany('Reviews', [
			'foreignKey' => 'user_id',
		]);
	}

	/**
	 * Default validation rules.
	 *
	 * @param \Cake\Validation\Validator $validator Validator instance.
	 * @return \Cake\Validation\Validator
	 */
	public function validationDefault(Validator $validator): Validator
	{
		$validator
			->integer('id')
			->allowEmptyString('id', null, 'create');

		$validator
			->scalar('username')
			->maxLength('username', 255)
			->requirePresence('username', 'create')
			->notEmptyString('username');

		$validator
			->allowEmptyFile('avatar')
			->add('image', [
				'mimeType' => [
					'rule' => ['mineType', ['image/jpg', 'image/png', 'image/jpeg']],
					'message' => 'Please upload only jpg and png.',
				],
				'fileSize' => [
					'rule' => ['fileSize', '<=', '1MB'],
					'message' => 'Image filw size must be less than 1MB.',
				],
			]);

		$validator
			->scalar('password')
			->maxLength('password', 255)
			->requirePresence('password', 'create')
			->notEmptyString('password')
			->add('password', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

		$validator
			->scalar('gender')
			->requirePresence('gender', 'create')
			->notEmptyString('gender');

		$validator
			->integer('age')
			->requirePresence('age', 'create')
			->notEmptyString('age');

		$validator
			->email('email')
			->requirePresence('email', 'create')
			->notEmptyString('email')
			->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

		return $validator;
	}

	/**
	 * Returns a rules checker object that will be used for validating
	 * application integrity.
	 *
	 * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
	 * @return \Cake\ORM\RulesChecker
	 */
	public function buildRules(RulesChecker $rules): RulesChecker
	{
		$rules->add($rules->isUnique(['username']), ['errorField' => 'username']);
		$rules->add($rules->isUnique(['email']), ['errorField' => 'email']);
		$rules->add($rules->isUnique(['password']), ['errorField' => 'password']);
		$rules->add($rules->existsIn(['disease_categorie_id'], 'DiseaseCategories'), ['errorField' => 'disease_categorie_id']);

		return $rules;
	}
}
