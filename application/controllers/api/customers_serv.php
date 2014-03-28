<?php

require(APPPATH.'/libraries/REST_Controller.php');

class Customers_serv extends REST_Controller{

	function customer_get(){
		if(!$this->get('id')){
			$this->response(NULL, 400);
		}

		$return = $this->db->where('CustomerID', $this->get('id'))->get('customers');
		if($return->row()){
			$this->response($return->row(), 200);
		} else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
	}

	function customers_get(){
		$return = $this->db->select('CustomerID, ContactName, Phone')->get('customers');

		if($return->result()){
			$this->response($return, 200);
		} else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
	}

	function customer_delete(){
		if(!$this->get('id')){
			$this->response(NULL, 400);
		}

		$return = $this->db->where('CustomerID', $this->get('id'))->delete('customers');

		if($return){
			$this->response($return, 200);
		} else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
	}
}