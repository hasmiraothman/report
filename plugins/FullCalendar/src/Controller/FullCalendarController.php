<?php

/*
 * Controller/FullCalendarController.php
 * CakePHP Full Calendar Plugin
 *
 * Copyright (c) 2010 Silas Montgomery
 * http://silasmontgomery.com
 *
 * Licensed under MIT
 * http://www.opensource.org/licenses/mit-license.php
 */

namespace FullCalendar\Controller;

use Cake\Event\Event;
use FullCalendar\Controller\FullCalendarAppController;

class FullCalendarController extends FullCalendarAppController
{
	public $name = 'FullCalendar';

	public function index() {

    $this->paginate = [
            'contain' => ['Users']
        ];
		// $eventType = $this->EventTypes->get($id, [
  //           'contain' => []
  //       ]);
  //       if ($this->request->is(['patch', 'post', 'put'])) {
  //           if (!$id && empty($this->request->data)) {
  //               $this->Flash->error(__('Invalid event type', true));
  //               $this->redirect(['action' => 'index']);
  //           }
  //           if (!empty($this->request->data)) {
  //               $eventType = $this->EventTypes->patchEntity($eventType, $this->request->data);
  //               if ($this->EventTypes->save($eventType)) {
  //                   $this->Flash->success(__('The event type has been saved', true));
  //                   return $this->redirect(['action' => 'index']);
  //               } else {
  //                   $this->Flash->error(__('The event type could not be saved. Please, try again.', true));
  //               }
  //           }
  //           if (empty($this->request->data)) {
  //               $this->request->data = $this->EventTypes->read(null, $id);
  //           }
  //       }
  //       $this->set(compact('eventType'));
  //       $this->set('_serialize', ['eventType']);

        
	}
  
}