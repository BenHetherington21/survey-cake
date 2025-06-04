<?php
declare(strict_types=1);

namespace App\Controller;

use Authentication\PasswordHasher\DefaultPasswordHasher;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event) {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['login', 'add']);

        if($this->request->getAttribute('identity') != null) {
            $this->set('login', 'Logout');
        } else {
            $this->set('login', 'Login');
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Users->find();
        $users = $this->paginate($query);

        $userID = $this->request->getAttribute('identity')->getIdentifier();

        $this->set(compact('users'));
    }

    public function profile() {
        $userID = $this->request->getAttribute('identity')->getIdentifier();

        if($this->request->is('post')) {
            dd($this->request);
        }

        $user = $this->Users->get($userID, contain: []);
        $this->set(compact('user'));
    }

    public function update() {
        $userID = $this->request->getAttribute('identity')->getIdentifier();

        $user = $this->Users->get($userID);

        $this->Users->patchEntity( $user, $this->request->getData());

        $this->Users->save($user);

        return $this->redirect(['action'=> 'profile']);
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
        $userID = $this->request->getAttribute('identity')->getIdentifier();

        // Prevent user from accessing profile that isn't there's
        if($userID != $id) {
            return $this->redirect('/');
        }

        $user = $this->Users->get($id, contain: []);
        $this->set(compact('user'));
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
            // dd($user);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Registered successfully. Please login using your username and password'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('There was a problem registering your account. Please, try again.'));
        }
        $this->set(compact('user'));
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
        $user = $this->Users->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    public function changePassword($id = null) {
        $user = $this->Users->get($id, contain: []);
        if($this->request->is(['post'])) {
            $data = $this->request->getData();

            if($data['newpassword'] != $data['confirm-newpassword']) {
                return $this->Flash->error(__('Passwords did not match'));
            }

            $hasher = new DefaultPasswordHasher();

            if(!$hasher->check($data['oldpassword'], $user->password)) {
                return $this->Flash->error(__('Old password is incorrect'));
            }

            $user->password = $data['newpassword'];

            if($this->Users->save($user)) {
                $this->Flash->success(__('Your password has been changed successfully'));
                return $this->redirect(['action'=> 'profile']);
            }

            return $this->Flash->error(__('There was an error changing your password.'));
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login() {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();

        if($result && $result->isValid()) {
            $redirect = $this->request->getQuery('redirect', [
                '/'
            ]);

            return $this->redirect($redirect);
        }

        if($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid email or password'));
        }
    }

    public function logout() {
        $result = $this->Authentication->getResult();
        if($result && $result->isValid()) {
            $this->Authentication->logout();

            return $this->redirect('/');
        }
    }
}
