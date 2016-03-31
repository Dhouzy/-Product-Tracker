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
    public function initialize(){
        parent::initialize();
        $this->amazon = new AmazonHelper();
    }

    public function home($search = null, $page = null) {
        if (isset($search)) {
            $searchKeywordsEncoded = urlencode($search);

            if(isset($page)) {
                if(!ctype_digit($page))
                    $page = 1;
                else if(intval($page) < 1)
                    $page = 1;
                else if(intval($page) > 10)
                    $page = 10;
            } else
                $page = 1;

            $searchResult = $this->amazon->search($searchKeywordsEncoded, $page);
            $this->set(compact('searchResult', 'page', 'search'));
        }
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->set('doNotShowSearchBarInHeader', true);
        $this->Auth->allow(['home']);
    }
}