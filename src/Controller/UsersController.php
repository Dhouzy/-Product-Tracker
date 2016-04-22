<?php
/**
 * Created by PhpStorm.
 * User: Hippolyte Glaus
 * Date: 20/02/16
 * Time: 6:49 PM
 */

namespace App\Controller;

use App\Model\Entity\User;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validation;

/**
 * @property bool|object Users
 */
class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Security');
    }
    public function index()
    {
        $this->set('users', $this->Users->find('all'));
    }

    public function view($id)
    {
        $user = $this->Users->get($id);
        $this->set(compact('user'));
    }

    public function add()
    {
        $user = new User();
        if ($this->request->is('post')) {
            $requestEmail = $this->request->data['email'];
            $requestUsername = $this->request->data['username'];

            if($this->Users->find('emailAlreadyExists', ['email' => $requestEmail])){
                $this->Flash->error(__('Flash.EmailAlreadyExists', $requestEmail));
            } else if($this->Users->find('usernameAlreadyExists', ['username' => $requestUsername])){
                $this->Flash->error(__('Flash.UsernameAlreadyExists', $requestUsername));
            } else {
                $user = $this->Users->patchEntity($user, $this->request->data);
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('Flash.UserRegistered', $user->first_name));
                    return $this->redirect(['controller' => 'Homes', 'action' => 'home']);
                }
                $this->Flash->error(__('Flash.RegistrationFailed'));
            }
        }
        $this->set('user', $user);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['add']);
        $this->Auth->allow(['login']);
        $this->Security->config('unlockedActions', ['login']);
        $this->Security->config('unlockedActions', ['add']);
}

    public function login()
    {
        if ($this->request->is('post')) {
            if (Validation::email($this->request->data['username'])) {
                $this->Auth->config('authenticate', [
                    'Form' => [
                        'fields' => ['username' => 'email']
                    ]
                ]);
                $this->Auth->constructAuthenticate();
                $this->request->data['email'] = $this->request->data['username'];
                unset($this->request->data['username']);
            }

            $user = $this->Auth->identify();

            if ($user) {
                $this->Auth->setUser($user);
                $this->set('loginSucceeded', true);
                $this->set('redirectUrl', $this->Auth->redirectUrl());
            }
            else {
                $this->set('loginSucceeded', false);
                $this->set('redirectUrl', null);
            }

            $this->set('_serialize', ['loginSucceeded', 'redirectUrl']);
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    public function profile()
    {
        $userLogged = $this->request->session()->read('Auth.User');
        $user = $this->Users->get($userLogged['id'], ['contain' => ['Products']]);
        $this->set(compact("user"));
    }
}