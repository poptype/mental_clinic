<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Clinics Model
 *
 * @property \App\Model\Table\ReviewsTable&\Cake\ORM\Association\HasMany $Reviews
 *
 * @method \App\Model\Entity\Clinic newEmptyEntity()
 * @method \App\Model\Entity\Clinic newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Clinic[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Clinic get($primaryKey, $options = [])
 * @method \App\Model\Entity\Clinic findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Clinic patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Clinic[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Clinic|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Clinic saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Clinic[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Clinic[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Clinic[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Clinic[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ClinicsTable extends Table
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

		$this->setTable('clinics');
		$this->setDisplayField('name');
		$this->setPrimaryKey('id');

		$this->addBehavior('Timestamp');

		$this->hasMany('Reviews', [
			'foreignKey' => 'clinic_id',
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
			->scalar('name')
			->maxLength('name', 32)
			->requirePresence('name', 'create')
			->notEmptyString('name')
			->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

		$validator
			->scalar('address')
			->maxLength('address', 64)
			->requirePresence('address', 'create')
			->notEmptyString('address')
			->add('address', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

		$validator
			->scalar('station')
			->maxLength('station', 32)
			->requirePresence('station', 'create')
			->notEmptyString('station');

		$validator
			->scalar('time')
			->maxLength('time', 32)
			->requirePresence('time', 'create')
			->notEmptyString('time');

		$validator
			->scalar('phone_number')
			->maxLength('phone_number', 32)
			->requirePresence('phone_number', 'create')
			->notEmptyString('phone_number')
			->add('phone_number', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

		$validator
			->allowEmptyFile('image')
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
			->decimal('rating')
			->allowEmptyString('rating');

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
		$rules->add($rules->isUnique(['name']), ['errorField' => 'name']);
		$rules->add($rules->isUnique(['address']), ['errorField' => 'address']);
		$rules->add($rules->isUnique(['phone_number']), ['errorField' => 'phone_number']);

		return $rules;
	}
}
