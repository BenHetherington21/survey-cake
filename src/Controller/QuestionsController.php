<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;

/**
 * Questions Controller
 *
 * @property \App\Model\Table\QuestionsTable $Questions
 * @property \App\Model\Table\SurveysTable $Surveys
 */
class QuestionsController extends AppController
{
    public function initialize(): void {
        parent::initialize();
        $this->Surveys = TableRegistry::getTableLocator()->get('Surveys');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Questions->find()
            ->contain(['Surveys']);
        $questions = $this->paginate($query);

        $this->set(compact('questions'));
    }

    /**
     * View method
     *
     * @param string|null $id Question id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $question = $this->Questions->get($id, contain: ['Surveys']);
        $this->set(compact('question'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($surveyID)
    {
        $question = $this->Questions->newEmptyEntity();

        $totalQuestions = count($this->Questions->find()->where(['survey_id' => $surveyID])->all());

        if ($this->request->is('post')) {
            $questionData = $this->request->getData();

            if($questionData['required'] == 'on') {
                $questionData['required'] = 1;
            } else {
                $questionData['required'] = 0;
            }

            if($questionData['type'] == 'Multiple Choice' || $questionData['type'] == 'Multiple Selection') {
                $questionData['options'] = [];
                for ($i=1; $i <= $questionData['totalOptions']; $i++) {
                    if($questionData['option-' . $i]) {
                        array_push($questionData['options'], $questionData['option-' . $i]);
                    } else {
                        break;
                    }
                }
                $questionData['options'] = json_encode($questionData['options']);
            } else if($questionData['type'] == 'Number Scale') {
                $questionData['options'] = [intval($questionData['min']), intval($questionData['max'])];
                $questionData['options'] = json_encode($questionData['options']);
            } else {
                $questionData['options'] = null;
            }

            $question = $this->Questions->patchEntity($question, $questionData);

            if ($this->Questions->save($question)) {
                $this->Flash->success(__('The question has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The question could not be saved. Please, try again.'));
        }
        $surveys = $this->Questions->Surveys->find('list', limit: 200)->all();
        $this->set(compact('question', 'surveys', 'surveyID', 'totalQuestions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Question id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $question = $this->Questions->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $question = $this->Questions->patchEntity($question, $this->request->getData());
            if ($this->Questions->save($question)) {
                $this->Flash->success(__('The question has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The question could not be saved. Please, try again.'));
        }
        $surveys = $this->Questions->Surveys->find('list', limit: 200)->all();
        $this->set(compact('question', 'surveys'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Question id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $question = $this->Questions->get($id);
        if ($this->Questions->delete($question)) {
            $this->Flash->success(__('The question has been deleted.'));
        } else {
            $this->Flash->error(__('The question could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
