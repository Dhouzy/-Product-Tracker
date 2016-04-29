<?php
/**
 * Created by PhpStorm.
 * User: Hippolyte Glaus
 * Date: 19/02/16
 * Time: 10:44 AM
 */

namespace App\Controller;

use Cake\Event\Event;
use App\Core\Amazon\AmazonHelper;

class HomesController extends AppController
{
    private $amazon;

    public function initialize()
    {
        parent::initialize();
        $this->amazon = new AmazonHelper();
    }

    public function home()
    {
        $search = $this->request->query('q');
        $page = $this->request->query('p');

        if ($search != null) {
            $searchKeywordsEncoded = urlencode($search);

            if ($page != null) {
                if (!ctype_digit($page))
                    $page = 1;
                else if (intval($page) < 1)
                    $page = 1;
                else if (intval($page) > 10)
                    $page = 10;
            } else
                $page = 1;

            $searchResult = $this->amazon->search($searchKeywordsEncoded, $page);
            $tableOnly = $this->request->query('tableOnly') == "true";
            $this->set(compact('searchResult', 'page', 'search', 'tableOnly'));
        }
    }

    public function search()
    {
        if (isset($this->request->data)) {
            return $this->redirect(
                ['controller' => 'Homes', 'action' => 'home', 'search' => $this->request->data['search']]
            );
        }
        return $this->redirect(
            ['controller' => 'Homes', 'action' => 'home']
        );
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->set('doNotShowSearchBarInHeader', true);
        $this->Auth->allow(['home', 'search']);
    }
}