<?php
/**
 * AppController
 * Created by Product_Tracker
 * Since: 04 Mar 2016
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\I18n\I18n;
use Cake\Event\Event;

/**
 * Application Controller for application wide methods
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     * Use this method to add common initialization code like loading components.
     * e.g. `$this->loadComponent('Security');`
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'loginRedirect' => [
                'controller' => 'Homes',
                'action' => 'home'
            ],
            'logoutRedirect' => [
                'controller' => 'Homes',
                'action' => 'home'
            ]
        ]);
    }

    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }

        $session = $this->request->session();

        if(!$session->check('Config.language')){
            $session->write('Config.language', 'fr');
        } else {
            I18n::locale($session->read('Config.language'));
        }
    }

    public function beforeFilter(Event $event)
    {
        // Use auth-> allow in you own controller instead of here for better control
    }
}
