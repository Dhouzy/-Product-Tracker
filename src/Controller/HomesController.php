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
    public function home() {
        if (isset($this->request->query['search'])) {
            $searchKeywordsEncoded = urlencode($this->request->query['search']);
            $amazon = new AmazonHelper();

            if(isset($this->request->query['p'])) {
                $currentPage = $this->request->query['p'];
                if(!ctype_digit($currentPage))
                    $this->redirect("/?search=$searchKeywordsEncoded&p=1");
                else if(intval($currentPage) < 1)
                    $this->redirect("/?search=$searchKeywordsEncoded&p=1");
                else if(intval($currentPage) > 10)
                    $this->redirect("/?search=$searchKeywordsEncoded&p=10");
            } else
                $currentPage = 1;

            $searchResult = $amazon->search($this->request->query['search'], $currentPage);
            //echo "<pre>";var_dump($searchResult);echo "</pre>";
            $this->set(compact('searchResult', 'currentPage', 'searchKeywordsEncoded'));
        }
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['home']);
    }
}