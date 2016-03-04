<?php
/**
 * SearchesController
 * Created by M-A
 * Since: 03 Mar 2016
 *
 * Search controller
 */

namespace App\Controller;

class SearchesController extends AppController
{

    public function homeSearch()
    {
        if ($this->request->is('post')) {
            $received = $this->request->data;
            $this->Flash->success(__('Your search for '.$received['search'].' returned no results.'));
        }
    }
}