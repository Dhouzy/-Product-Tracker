<?php
/**
 * Created by PhpStorm.
 * User: M-A
 * Date: 1/03/16
 * Time: 11:58 PM
 */

namespace App\Controller;


class SearchesController extends AppController
{

    public function search()
    {
        $this->set(compact('search'));
    }
}