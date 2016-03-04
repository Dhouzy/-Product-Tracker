<?php
/**
 * Created by PhpStorm.
 * User: gogo
 * Date: 19/02/16
 * Time: 10:44 AM
 */
namespace App\Controller;
//include('\var\www\Product_tracker\src\Controller\Component\AmazonHelper.php');

class HomesController extends AppController
{

    public function home() {
        $amazon = new AmazonHelper();
        if ($this->request->is('post')) {
            $received = $this->request->data;
            $this->Flash->success(__('Your search for '.$received['search'].' returned no results.'));
            $this->redirect($amazon->search($received['search']));
        }
    }

}