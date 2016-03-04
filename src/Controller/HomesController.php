<?php
/**
 * Created by PhpStorm.
 * User: gogo
 * Date: 19/02/16
 * Time: 10:44 AM
 */

namespace App\Controller;


class HomesController extends AppController
{

    public function home() {
        $this ->set(compact('posts'));
    }

}