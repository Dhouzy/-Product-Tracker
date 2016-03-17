<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 19/02/2016
 * Time: 09:19
 */

namespace App\Controller;
use App\Shell\PriceUpdateShell;

/**
 * Class ProductsController
 * @package App\Controller
 */
class ProductsController extends AppController
{

    public function product()
    {
        if (isset($this->request->uid)) {
            $update = new PriceUpdateShell();
            $itemUpdate = $update->main($this->request->uid);

            $this->set(compact('itemUpdate'));
        }
    }

}