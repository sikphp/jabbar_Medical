<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __Construct()
	{
		parent::__Construct();
		$this->load->model('Home_model');
		$this->load->helper(array('form', 'url'));
	}
	public function index()
	{
		//$this->load->model('Home_model');
		//$data['id'] = $userid;
		$data['first_Qiz']= $this->Home_model->first_Qiz();
		$data['second_Qiz']= $this->Home_model->second_Qiz();
		$data['Patient']= $this->Home_model->getPatient();
		$data['query_rule']=$this->Home_model->getRules();
		$data['query_rule1']=$this->Home_model->getRules();
		//$data['Simple']=$this->Home_model->getSimple();
		//$data1['data1']=$this->Home_model->getAnswer($userid);
		$this->load->view('welcome_message',$data,$data,$data,$data,$data);
		
		
		
	}

	function insert_rules()
	{
		$statement_id = $this->input->post('statement_id');
		$first_qiz_id = $this->input->post('first_qiz_id');
		$qiz_type_id = $this->input->post('qiz_type_id');
		$str_replec_id = $this->input->post('str_replec_id');
		$col_id = $this->input->post('col_td_id');  
		if($qiz_type_id==2)
		{
			for($count = 0; $count < count($col_id+$str_replec_id); $count++)
   			{
				echo $this->Home_model->insert_rules($statement_id,$first_qiz_id,$qiz_type_id,$str_replec_id[$count],$col_id[$count]);
			}
				
		}if($statement_id && $first_qiz_id && $qiz_type_id)
		{
			echo $this->Home_model->insert_rules($statement_id,$first_qiz_id,$qiz_type_id);
		}
		
	}

	function getSimple()
	{
		$myInput["myInput"] = $this->input->post("myInput");
		$patient_id = $this->input->post('patient_id');
		$condition_id = $this->input->post('condition_id');
		//$qiz_level_one_id = $this->input->post('qiz_level_one');
		//$qiz_level_one = $this->input->post('qiz_level_one');
		
		if($patient_id && $condition_id)
		{
		
			echo $this->Home_model->getSimple($patient_id,$condition_id);
		}
		
	}

	function view_all()
	{
		$myInput["myInput"] = $this->input->post("myInput");
		$patient_id = $this->input->post('patient_id');
		$condition_id = $this->input->post('condition_id');
		//$qiz_level_one_id = $this->input->post('qiz_level_one');
		//$qiz_level_one = $this->input->post('qiz_level_one');
		
		if($patient_id && $condition_id)
		{
		
			echo $this->Home_model->view_all($patient_id,$condition_id);
		}

	}
	function first_Ans()
	{
		//$data1['data1']=$this->Home_model->getAnswer($country_id);
		//$this->load->view('welcome_message',$data1);

		if($this->input->post('first_qiz_id'))
		{
		
			echo $this->Home_model->first_Ans($this->input->post('first_qiz_id'
			
		));
		}
	}

	function second_Ans()
	{
		//$data1['data1']=$this->Home_model->getAnswer($country_id);
		//$this->load->view('welcome_message',$data1);

		if($this->input->post('second_qiz_id'))
		{
		
			echo $this->Home_model->second_Ans($this->input->post('second_qiz_id'
			
		));
		}
	}

	// function fetch_city()
	// 	{
	// 		if($this->input->post('state_id'))
	// 	{
		
	// 		echo $this->Home_model->fetch_city($this->input->post('state_id'
			
	// 	));
	// 	}

	// 	}
	function update_rule()
	{
		$statement_id = $this->input->post("statement_id");
		$condition_id = $this->input->post('condition_id');
		if($statement_id && $condition_id)
		{
		
			echo $this->Home_model->update_rule($statement_id,$condition_id);
			
		
		}
		
	}
	
	public function delete_data(){  
		$id = $this->uri->segment(3);  
		$this->load->model("Home_model");  
		$this->Home_model->delete_data($id);  
		redirect(base_url() . "index/deleted");  
   }  
   
   public function deleted()  
   {  
		$this->index();  
   }  

}

