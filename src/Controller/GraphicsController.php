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

        $graph1Data = array(1, 2, 6);
        $graph2Data = array(3, 2, 1);

        $this->set(compact('graph1Data', 'graph2Data'));
    }

}
