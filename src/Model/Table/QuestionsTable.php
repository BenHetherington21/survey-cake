<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Questions Model
 *
 * @property \App\Model\Table\SurveysTable&\Cake\ORM\Association\BelongsTo $Surveys
 *
 * @method \App\Model\Entity\Question newEmptyEntity()
 * @method \App\Model\Entity\Question newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Question> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Question get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Question findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Question patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Question> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Question|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Question saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Question>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Question>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Question>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Question> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Question>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Question>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Question>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Question> deleteManyOrFail(iterable $entities, array $options = [])
 */
class QuestionsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('questions');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->belongsTo('Surveys', [
            'foreignKey' => 'survey_id',
            'joinType' => 'INNER',
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
            ->integer('survey_id')
            ->notEmptyString('survey_id');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('type')
            ->maxLength('type', 50)
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

        $validator
            ->scalar('options')
            ->maxLength('options', 4294967295)
            ->allowEmptyString('options');

        $validator
            ->integer('position')
            ->requirePresence('position', 'create')
            ->notEmptyString('position');

        $validator
            ->boolean('required')
            ->requirePresence('required', 'create')
            ->notEmptyString('required');

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
        $rules->add($rules->existsIn(['survey_id'], 'Surveys'), ['errorField' => 'survey_id']);

        return $rules;
    }
}
