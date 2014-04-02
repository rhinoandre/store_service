<?php

require(APPPATH.'/libraries/REST_Controller.php');

class Customers_serv extends REST_Controller{

	function customer_get(){
		if(!$this->get('id')){
			$this->response(NULL, 400);
		}

		$return = $this->db->where('CustomerID', $this->get('id'))->get('customers');
		if($return){
			$this->response($return->row(), 200);
		} else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
	}

	function customers_get(){
		$return = $this->db->select('CustomerID, ContactName, Phone')->get('customers')->result();

		if($return){
			$this->response($return, 200);
		} else {
            $this->response(array('error' => 'Couldnt find any users!'), 404);
        }
	}

	function customer_delete(){
		$data = $this->delete();
		$this->response($data, 200);
		/*if($data){
			$return = $this->db->where('CustomerID', $data['CustomerID'])->delete('customers')->row();

			if($return){
				$this->response($return, 200);
			} else {
	            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
	        }	
		}
		$this->response(NULL, 400);*/
	}

	function customer_post(){
		$data = $this->post();
		
		if($data){
			if($this->db->update('customers', $data, array('CustomerID'=>$data['CustomerID']))){
				$this->response($data, 200);
			}
		}
	}

	function customer_put(){
		$data = $this->put();
		
		if($data){
			if($this->db->insert('customers', $data)){
				$this->response($data, 200);
			}
		}
	}
}