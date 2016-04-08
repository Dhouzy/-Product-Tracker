<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 16-03-11
 * Time: 10:15
 */

namespace App\Controller;

use Cake\Event\Event;

class LangsController extends AppController
{
    /**
     * Changes the current language as seen by the user.
     */
    public function switchLang() {
        $params = $this->request->query;

        if(isset($params['l']) && isset($params['fromUrl']) && ($params['l'] == 'fr' || $params['l'] == 'en')) {
            $this->request->session()->write('Config.language', $params['l']);
            $this->redirect($params['fromUrl']);
        }
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow('switchLang');
    }
}