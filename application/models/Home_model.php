<?php
class Home_model extends CI_Model //CI_Controller
{
	public function first_Qiz()
{
	//$this->load->database();
	
	$this->db->select("*");
	$this->db->from("questions");
	$this->db->where("question_level",0);
	$this->db->order_by("display_order", "asc");
	$query = $this->db->get();
	//$query = $this->db->get('questions');
	
	return $query;
	//$query->result_array();
	//return $query->result();	
}
public function second_Qiz()
{
	//$this->load->database();
	
	$this->db->select("*");
	$this->db->from("questions");
	$this->db->where("question_level",0);
	$this->db->order_by("display_order", "asc");
	$qizlevelone = $this->db->get();
	//$query = $this->db->get('questions');
	
	return $qizlevelone;
	//$query->result_array();
	//return $query->result();	
}
	function getRules()
	{
		$this->db->select('*');
		$this->db->from("simple_rules");
		//$this->db->join('answers','simple_rules.question_id = answers.question_id');
		//$this->db->group_by('simple_rules.question_id','asc');
		//$this->db->group_by('answers.question_id');
		//$this->db->order_by('answers.question_id','asc');
		//$this->db->distinct('simple_rules.question_id');
		//$this->db->limit(3);
		$query = $this->db->get();

		return $query;
	}

	function first_Ans($first_qiz_id)
	{
		$this->db->select('*');
		$this->db->where('question_id',$first_qiz_id);
		$this->db->order_by('answer_text','ASC');
		$query = $this->db->get('answer_options');
		//$output = '<option value="">Select Answer</option>';
		$this->db->where('question_id',$first_qiz_id);
		$query1 = $this->db->get('answers');
		//$row1 = $query1->row();
		$output = '<tr value="">';
		
		foreach($query1->result() as $row1)
		{
			foreach($query->result() as $row){
			$output .='<td class="ans_LZ" value="'.$row->id.'">'.$row->answer_text.'</td>
			<td><input type="text" class="str_replec form-control" id="str_replec" value="'.$row1->free_text_field.'">
			<input type="hidden" value="'.$row->id.'" name="col_id[]" id="col_id" class="col_id">
			</td></tr>';
		
		}
	break;
	}
		return $output;
	}
	function second_Ans($second_qiz_id)
	{
		$this->db->where('question_id',$second_qiz_id);
		$this->db->order_by('answer_text','ASC');
		$query = $this->db->get('answer_options');
		//$output = '<option value="">Select Answer</option>';
		$this->db->where('question_id',$second_qiz_id);
		$query1 = $this->db->get('answers');
		$output = '<tr value="">';
		foreach($query1->result() as $row1)
		{
			foreach($query->result() as $row){
			$output .='<td value="'.$row->id.'">'.$row->answer_text.'</td>
			<td><input type="text" class="str_replec form-control" id="str_replec" value="'.$row1->free_text_field.'"></td>
			<input type="hidden" value="'.$row->id.'" name="col_id[]" id="col_id" class="col_id">
			</td>
			</tr>';
			
		}
		break;
	}
		return $output;
	}
	// function fetch_city($state_id)
	// {
	// 	$this->db->where('answer_option_id',$state_id);
	// 	$this->db->order_by('free_text_field','ASC');
	// 	$query = $this->db->get('answers');
	// 	$output = '<option value=""></option>';
	// 	foreach($query->result() as $row)
	// 	{
	// 		$output .='<option value="'.$row->id.'">'.$row->free_text_field.'</option>';
			
	// 	}
		
	// 	return $output;

	// }

	function insert_rules($statement_id,$first_qiz_id,$qiz_type_id,$str_replec_id,$col_id)
	{
		if($qiz_type_id ==1)
		{
		$data = array(
			'question_id'=>$first_qiz_id,
			'rule_text'=>$statement_id
		);

		$this->db->insert('simple_rules',$data);
		}else
		{
		$data = array(
			'free_text_field'=>$str_replec_id
		);
		$this->db->where("answer_option_id",$col_id);
		$this->db->update("answers",$data);
		}
	}

	public function getPatient()
{
	
	$this->db->select("*");
	$this->db->from("evaluations");
	//$this->db->where("question_level",0);
	//$this->db->order_by("display_order", "asc");
	$Patient = $this->db->get();
	//$query = $this->db->get('questions');
	
	return $Patient;
	//$query->result_array();
	//return $query->result();	
	
}

	public function getSimple($patient_id,$condition_id)
	{
	$this->db->select("*");
	$this->db->from("answers");
	$this->db->join('answer_options','answers.answer_option_id = answer_options.id','left outer');
	//$this->db->join('answers','answer_options.question_id = answers.question_id','left outer');
	$this->db->where("evaluation_id",$patient_id);
	$this->db->where_in("answers.question_id",array($condition_id));
	//$this->db->order_by("display_order", "asc");
	$Simple = $this->db->get();
	$this->db->from("simple_rules");
	$this->db->where_in("question_id",array($condition_id));
	$rule = $this->db->get();
	//$ret = $rule->row();
	 
	//$query = $this->db->get('questions');
	$output = '<p></p>';
		foreach($Simple->result() as $row2)
		{
			foreach($rule->result() as $ret)
			{
			if($row2->answer_text != "No")
		{
			$array = array(0 => '1', 1 => '2');
			$key = array_search($condition_id,$array);
			if(strpos($condition_id,$array[$key]) !==false )
			{
				if($row2->free_text_field ==null)
				{
				$output .= str_replace(array('[1]','[2]'),$row2->answer_text,$ret->rule_text."<br/>");
				}else
				{
				$output .= str_replace(array('[1]'),$row2->free_text_field,$ret->rule_text);
				}
			} }
		}

		}
		
		return $output;
	
	}

	public function view_all($patient_id,$condition_id)
	{
		$this->db->select("*");
	$this->db->from("answers");
	$this->db->join('answer_options','answers.answer_option_id = answer_options.id','left outer');
	//$this->db->join('answers','answer_options.question_id = answers.question_id','left outer');
	$this->db->where("evaluation_id",$patient_id);
	$this->db->where_in("answers.question_id",array($condition_id));
	//$this->db->order_by("display_order", "asc");
	$Simple = $this->db->get();
	$this->db->from("simple_rules");
	$this->db->where_in("question_id",array($condition_id,114));
	$rule = $this->db->get();
	//$ret = $rule->row();
	 
	//$query = $this->db->get('questions');
	$output = '<p></p>';
	foreach($rule->result() as $ret)
	{
	foreach($Simple->result() as $row2)
		{
			
			if($row2->answer_text != "No")
			
		{
			
			$array = array(0 => '1', 1 => '2');
			$key = array_search($condition_id,$array);
			if(strpos($condition_id,$array[$key]) !==false )
			{
				if($row2->free_text_field ==null)
				{
				$output .= str_replace(array('[1]','[2]'),$row2->answer_text,"<b>".$ret->rule_text."</b><br/>");
				}else
				{
				$output .= str_replace(array('[1]'),$row2->free_text_field,"<b>".$ret->rule_text."</b><br/>");
				}
			} }
		}

		}
		
		return $output;

	}

	public function update_rule($statement_id,$condition_id)
	{
		//$rules = $this->input->post('myInput');
		$data = array(
			'rule_text' => $statement_id
	);
	
		//$this->db->select("*");
		//$this->db->from("simple_rules");
		$this->db->where("question_id",$condition_id);
		$this->db->update("simple_rules",$data);
		//$this->db->get();
		
	}

	function delete_data($id){  
		$this->db->where("question_id", $id);  
		$this->db->delete("simple_rules");  
		//DELETE FROM tbl_user WHERE id = $id  
   }  
}