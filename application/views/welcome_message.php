<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Report Bot</title>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- <script>
$(document).ready(function(){
  $("#next").click(function(){
    
	$("#myform").clone(true).appendTo("#myform1");
	
  });
  	
});
</script> -->
</head>
<body>
	<div class="container">
	<div class="jumbotron">
	<h1>Report Bot</h1>
</div>
	<div class="row">
	<div class="col-sm-4" id="myform">
	<p>Condition.</p>
	<!-- <select name ="condition" id="condition" class="form-control"> -->
	<!-- <option value="">Select Condition</option> -->
	<table class="table">
	<?php 
	
	foreach ($query_rule->result() as $rule)
    {

		echo '<tr>';
		if($rule->question_id !='')
		{
		echo '<td><button type="button" class="btn btn-primary btn-sm">R</button></td>';
		}else{
			echo '<td><button type="button" class="btn btn-primary btn-sm">P</button></td>';
		}
		echo '<td><a href=# name="'.$rule->qiz_id.'" id="'.$rule->question_id.'" class=condition placeholder="'.$rule->rule_text.'">'.$rule->rule_text.'</a></td>';
		echo '<td><a href=# class=delete_data id='.$rule->question_id.'> Delete</a></td>';
		echo '<tr>';
	}
	
    ?>
	</table>
	<input type="hidden"  id="condition">
	<!-- </select> -->
	<br/>
	<p>Questions Type:-1</p> 
	<select class="form-control" id="qiz_type">
	<option value="0">Select Questions Type</option>
	<option value="1">Placeholder</option>
	<option value="2">String Replacement</option>
	</select>
	<div id="engine">
	<p>Select the Question:-1.</p>
	<select name ="first_qiz" id="first_qiz" class="form-control">
	<option value="">Select Questions</option>
	<?php foreach ($first_Qiz->result() as $row)
    {
    
		echo '<option value="'.$row->id.'">'.$row->question_text.'</option>';
		
    }
    
    ?>
	</select>
	<br/>	
	<div class="ans_engine">
	<!-- <select name="state" id="state" class="form-control">
	<option value="" >Select Answer</option>
	</select> -->
	<br/>
	<table name="first_ans" id="first_ans" class="table">
	</table>
	<!-- <select name="city" id="city" class="form-control">
	<option value="">Select Answers</option>
	</select> -->
	<!-- <p name="city" id="city">
		
	</p> -->
	</div>
	<p>Questions Type:-2</p> 
	<select class="form-control" id="qiz_type1">
	<option value="0">Select Questions Type</option>
	<option value="3">Placeholder</option>
	<option value="4">String Replacement</option>
	</select>
	<br/>
	<div id="engine1">
	<p>Select the Question:-2.</p>
	<select name ="second_qiz" id="second_qiz" class="form-control">
	<option value="">Select Questions</option>
	<?php foreach ($second_Qiz->result() as $row)
    {
    
		echo '<option value="'.$row->id.'">'.$row->question_text.'</option>';
		
    }
    
    ?>
	</select>
	</div>
	<br/>
	<div class="ans_engine1">
	<!-- <select name="ans_level_one" id="ans_level_one" class="form-control">
	<option value="" >Select Answer</option>
	</select> -->
	<table name="second_ans" id="second_ans" class="table">
	</table>
	</div>
	</div>
	<br/>
	<p>Statement</p>
	<input type="text" class="form-control" id="statement" name="statement">
	<br/>
 <button type="button" class="btn btn-danger" onclick="getInputValue();" name="add" id="add">Save</button>
 <button type="button" class="btn btn-danger" name="update" id="update">Update</button>
 
</div>
<br/>
<div class="col-sm-4">
<!-- <button type="button" class="btn btn-danger" id="next">Add Questions</button> -->
<button type="button" class="btn btn-danger" name="view_all" id="view_all">View All</button>
<p>
<p>Select the Patient.</p>
	<select name ="patient" id="patient" class="form-control">
	<option value="">Select Patient</option>
	<?php foreach ($Patient->result() as $row1)
    {
    
		echo '<option value="'.$row1->id.'">'.$row1->name.'</option>';
		//$userid=$row1->id;
    }
    
    ?>
	</select>
	<br/>
	<p name="rules" id="rules"></p>
	<p name="view_all_rules" id="view_all_rules1">
	<table class="table">
		<tr>
			<th>View All Condition</th>
		</tr>
		<tr>
			<td id="view_all_rules"></td>
		</tr>

	</table>
	</p>
<!-- <script type='text/javascript' >
        function getInputValue(){
            // Selecting the input element and get its value 
            
            var inputVal = document.getElementById("myInput").value;
            var ans = document.getElementById("state");
			var ans1 = document.getElementById("city");
			var selectedText = ans.options[ans.selectedIndex].text;
			var selectedText1 = ans1.options[ans1.selectedIndex].text;
           	var res = inputVal.replace("[]",selectedText);
			var res1 = inputVal.replace("[]",selectedText1);
			// Displaying the value
			
			if(selectedText1 !='')
			{
			alert(res1);
			}else if(selectedText !='No'){
				alert(res);
			}		
        }
    </script> -->
</div>
<div class="col-sm-12" id="myform1"></div>
</div>
</div>
</body>
</html>
<script>
	$(document).ready(function(){
		$("#engine").hide();
			$('#qiz_type').change(function(){
				var qiz_id = $('#qiz_type').val();
				if(qiz_id ==1)
				{
					$("#engine").show();
					$(".ans_engine").hide();
					$("#engine1").hide();
					$(".ans_engine1").hide();
				}if(qiz_id ==2)
				{
					$("#engine").show();
					$(".ans_engine").show();
					$("#engine1").hide();
					$(".ans_engine1").hide();
				}

			})
		});
		$(document).ready(function(){
		$("#engine").hide();
			$('#qiz_type1').change(function(){
				var qiz_id = $('#qiz_type1').val();
				if(qiz_id ==3)
				{
					//$("#engine").show();
					//$(".ans_engine").hide();
					$("#engine1").show();
					$(".ans_engine1").hide();
				}if(qiz_id ==4)
				{
					$("#engine1").show();
					$(".ans_engine1").show();
				}

			})
		});
	$(document).ready(function(){
			$('#first_qiz').change(function(){
				var first_qiz_id = $('#first_qiz').val();
				if(first_qiz_id !='')
				{
					$.ajax({
						url: "<?php echo base_url();?>first_Ans",
						method:"POST",
						data:{first_qiz_id:first_qiz_id},
						success:function(data)
						{
							$('#first_ans').html(data);
						}

					})
				}
			});
				// $('#state').change(function(){
				// 	var state_id = $('#state').val();
				// 	if(state_id != '')
				// 	{
				// 		$.ajax({
						
				// 		url: "<?php //echo base_url();?>fetch_city",
				// 		method:"POST",
				// 		data:{state_id:state_id},
				// 		success:function(data)
				// 		{
				// 			$('#city').html(data);
				// 		}

				// 		})
				// 	}

				// });
				$('#second_qiz').change(function(){
				var second_qiz_id = $('#second_qiz').val();
				if(second_qiz_id !='')
				{
					$.ajax({
						url: "<?php echo base_url();?>second_Ans",
						method:"POST",
						data:{second_qiz_id:second_qiz_id},
						success:function(data)
						{
							$('#second_ans').html(data);
						}

					})
				}
			});
				
			$('#patient').change(function(){
				var patient_id = $('#patient').val();
				var condition_id = $('#condition').val();
				//var condition_id = $('.condition').attr('id');
				
				if(patient_id !='' && condition_id !='')
				{
					$.ajax({
						url: "<?php echo base_url();?>getSimple",
						method:"POST",
						data:{patient_id:patient_id,condition_id:condition_id},
						success:function(data)
						{
							
							$('#rules').html(data);
						}

					})
				}
			});	

			$('.condition').click(function(){
				//var ins_data = $('#add').val();
				var id = $(this).attr("id");
				//var id2 = $(this).attr("name");
				var rules_text = $(this).attr("placeholder");
				//var rules_text = $('.condition').gettext();
				if(id !='')
				{
					$.ajax({
						url: "<?php echo base_url();?>",
						method:"POST",
                    	data:{id:id},
						//dataType: 'json',
                    	//cache: false,
						success:function(data)
						{
							var condition_id = $('#condition').val(id);
							var statement = $('#statement').val(rules_text);
							var first_qiz_id = $('#first_qiz').val(id);
							//var qiz_level_one =$('#qiz_level_one').val(id2);
							//alert(qiz_level_one);
							
						}

					})
				}
			});	

			$('#add').click(function(){
				//var ins_data = $('#add').val();
				var statement_id = $('#statement').val();
				var first_qiz_id = $('#first_qiz').val();
				var qiz_type_id =$('#qiz_type').val();
				//var str_replec_id = $('#str_replec').val();
				//  var col_td_id1 = $('input[name^=col_id]').map(function(idx, elem) {
    			//    return $(elem).val();
 				//    }).get();
				//var col_td_id = document.getElementById('col_td').value;
				 //var col_td_id = $("#col_id").val();
				 var checkbox1 = $('.str_replec');
				var str_replec_id = [];
				$(checkbox1).each(function(){
					str_replec_id.push($(this).val());
			});
				var checkbox = $('.col_id');
				var col_td_id = [];
				$(checkbox).each(function(){
				col_td_id.push($(this).val());
			});
				 
				if(first_qiz_id !='' && qiz_type_id !='' && col_td_id !='' && str_replec_id !='')
				{
					$.ajax({
						url: "<?php echo base_url();?>insert_rules",
						method:"POST",
                    	data:{statement_id:statement_id,first_qiz_id:first_qiz_id,qiz_type_id:qiz_type_id,str_replec_id:str_replec_id,col_td_id:col_td_id},
						//dataType: 'json',
                    	//cache: false,
						success:function(data)
						{
							if(qiz_type_id ==1 && statement_id !='')
							{
							alert("Add Rules");
							}else if(qiz_type_id ==2)
							{
							alert("String Replacement");
							//alert(col_td_id);
							//alert(str_replec_id);
							}
							
							window.location="<?php echo base_url(); ?>delete_data/";
						}

					})
				}
			});	
			$('#update').click(function(){
				//var ins_data = $('#add').val();
				var statement_id = $('#statement').val();
				var condition_id = $('#condition').val();
				//var country_id = $('#country').val();
				if(statement_id !='' && condition_id !='')
				{
					$.ajax({
						url: "<?php echo base_url();?>update_rule",
						method:"POST",
                    	data:{statement_id:statement_id,condition_id:condition_id},
						//dataType: 'json',
                    	//cache: false,
						success:function(data)
						{
							alert("Updated Sucessfully");
							window.location="<?php echo base_url(); ?>delete_data/";
						}

					})
				}
			});	
			$('#view_all').click(function(){
				var patient_id = $('#patient').val();
				var condition_id = $('#condition').val();
				//var condition_id = $('.condition').attr('id');
				
				if(patient_id !='' && condition_id !='')
				{
					$.ajax({
						url: "<?php echo base_url();?>view_all",
						method:"POST",
						data:{patient_id:patient_id,condition_id:condition_id},
						success:function(data)
						{
							
							$('#view_all_rules').html(data);
						}

					})
				}
			});	
			
			$('.delete_data').click(function(){  
                var id = $(this).attr("id");  
                if(confirm("Are you sure you want to delete this?"))  
                {  
                     window.location="<?php echo base_url(); ?>delete_data/"+id;  
                }  
                else  
                {  
                     return false;  
                }  
           });
		   
	});
</script>
