<?php
/**
 * AppController
 * Created by Product_Tracker
 * Since: 04 Mar 2016
 */
namespace App\Controller;

use Cake\Event\Event;

/**
 * Application Controller for application wide methods
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class GraphicsController extends AppController
{

    public function graphic() {

        if (isset($this->request->product)) {

            $fieldsGraph1 = array('price', 'date');
            $fieldsGraph2 = array('rebate_price', 'date');
            $conditionsGraph2 = array('NOT' => array(
                'prices.rebate_price' => null
            ));

            $product = $this->request->product;
            $graph1Data = $product->prices->find('all', array('fields' => $fieldsGraph1));
            $graph2Data = $product->prices->find('all', array('fields' => $fieldsGraph2, 'conditions' => $conditionsGraph2));
            $this->set(compact('graph1Data', 'graph2Data'));
        }
    }

}
