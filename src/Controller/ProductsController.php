<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 19/02/2016
 * Time: 09:19
 */

namespace App\Controller;
use App\Shell\PriceUpdateShell;
use Cake\Event\Event;

/**
 * Class ProductsController
 * @package App\Controller
 */
class ProductsController extends AppController
{

    private $uid;
    private $itemUpdate;
    private $updateService;

    public function initialize()
    {
        parent::initialize();
        $this->updateService = new PriceUpdateShell();
    }

    public function product()
    {
        if (isset($this->request->uid)) {
            $itemUpdate = $this->updateService->main($this->request->uid);
            $this->set(compact('itemUpdate'));
        }
    }

    public function addToUser()
    {

    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['product']);
    }
}