<?php

require(APPPATH.'/libraries/REST_Controller.php');

class Employees_serv extends REST_Controller{

	function employee_get(){
		if(!$this->get('id')){
			$this->response(NULL, 400);
		}

		$return = $this->db->where('EmployeeID', $this->get('id'))->get('employees');
		if($return){
			$this->response($return->row(), 200);
		} else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
	}

	function employees_get(){
		$return = $this->db->select('FirstName, LastName, HomePhone')->get('employees')->result();

		if($return){
			$this->response($return, 200);
		} else {
            $this->response(array('error' => 'Couldnt find any users!'), 404);
        }
	}

	function employee_delete(){
		$id = $this->get('id');

		if(!$id){
			$this->response(NULL, 400);
		}

		if($id){
			$return = $this->db->where('EmployeeID', $id)->delete('employees');

			if($return){
				$this->response($return, 200);
			} else {
	            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
	        }	
		}
		$this->response(NULL, 400);
	}

	function employee_post(){
		$data = $this->post();
		
		if($data){
			if($this->db->update('employees', $data, array('EmployeeID'=>$data['EmployeeID']))){
				$this->response($data, 200);
			}
		}
	}

	function employee_put(){
		$data = $this->put();
		
		if($data){
			if($this->db->insert('employees', $data)){
				$this->response($data, 200);
			}
		}
	}
}