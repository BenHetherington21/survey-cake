<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Surveys Controller
 *
 * @property \App\Model\Table\SurveysTable $Surveys
 */
class SurveysController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Surveys->find()
            ->contain(['Users']);
        $surveys = $this->paginate($query);

        $this->set(compact('surveys'));
    }

    /**
     * View method
     *
     * @param string|null $id Survey id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function manage($id = null)
    {
        $survey = $this->Surveys->get($id, contain: ['Users', 'Questions', 'Responses']);
        $this->set(compact('survey'));
    }

    public function share($code) {
        $survey = $this->Surveys->find()->where(['code IS' => $code])->first();

        if($survey != null) {
            return $this->redirect(['action' => 'survey', $survey->id]);
        }
        
        return $this->redirect(['action' => 'index']);
    }

    public function survey($id) {
        $survey = $this->Surveys->get($id, contain: ['Users', 'Questions', 'Responses']);
        $this->set(compact('survey'));
    }

    public function generateCode() {
        if($this->request->is('post')) {
            $id = $this->request->getData('id');
            $code = substr(base_convert((string) mt_rand(), 10, 36), 0, 8);

            $survey = $this->Surveys->get($id);
            $survey->code = $code;

            if($this->Surveys->save($survey)) {
                return $this->redirect(['controller' => 'Surveys', 'action' => 'manage', $id]);
            }
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userID = $this->request->getAttribute('identity')->getIdentifier();

        $survey = $this->Surveys->newEmptyEntity();
        if ($this->request->is('post')) {
            $survey = $this->Surveys->patchEntity($survey, $this->request->getData());
            if ($this->Surveys->save($survey)) {
                return $this->redirect(['action' => 'manage', $survey->id]);
            }
            $this->Flash->error(__('The survey could not be saved. Please, try again.'));
        }
        $users = $this->Surveys->Users->find('list', limit: 200)->all();
        $this->set(compact('survey', 'users', 'userID'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Survey id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $survey = $this->Surveys->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $survey = $this->Surveys->patchEntity($survey, $this->request->getData());
            if ($this->Surveys->save($survey)) {
                $this->Flash->success(__('The survey has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The survey could not be saved. Please, try again.'));
        }
        $users = $this->Surveys->Users->find('list', limit: 200)->all();
        $this->set(compact('survey', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Survey id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $survey = $this->Surveys->get($id);
        if ($this->Surveys->delete($survey)) {
            $this->Flash->success(__('The survey has been deleted.'));
        } else {
            $this->Flash->error(__('The survey could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
