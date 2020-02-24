<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<form method="post" action="addtreatment.php">
		
		select task<input type="text" name="task" list="tasks">
		<datalist id = "tasks">
			  <option value="0">billing</option>
		      <option value="1">bloodtest</option>
		      <option value="2">checkup</option>
		      <option value="3">ct-scan</option>
		      <option value="4">fracture</option>
		      <option value="5">medicime</option>
		      <option value="6">mri</option>
		      <option value="7">x-ray</option>
		</datalist>
		<br>


		select gender<input type="text" name="gender" list="genders">
		<datalist id = "genders">
			  <option value="0">Female</option>
    		  <option value="1">Male</option>
		</datalist>
		<br>


		select age<input type="text" name="age" list="ages">
		<datalist id = "ages">
			  <option value="0">adult</option>
			  <option value="1">child</option>
			  <option value="2">old</option>
		</datalist>
		<br>


		select session<input type="text" name="session" list="sessions">
		<datalist id = "sessions">
			  <option value="0">Evening</option>
    		  <option value="1">Morning</option>
		</datalist>
		<br>

		<!----select day<input type="text" name="day" list="days">
		<datalist id = "days">
			  <option value="1">Monday</option>
		      <option value="1">Tuesday</option>
		      <option value="1">Wednesday</option>
		      <option value="1">Thursday</option>
		      <option value="1">Friday</option>
		      <option value="0">Saturday</option>
		      <option value="0">Sunday</option>
		</datalist>
		<br>  --->


		select doctor_type<input type="text" name="doc_type" list="doc_types">
		<datalist id = "doc_types">
			  <option value="0">orthopedic</option>
		      <option value="1">physician</option>
		      <option value="2">surgeon</option>
		      <option value="3">unidentified</option>
		</datalist>
		<br>


		select dept<input type="text" name="dept" list="depts">
		<datalist id = "depts">
			  <option value="0">General Medicine</option>
		      <option value="1">Surgery</option>
		      <option value="2">cashier</option>
		      <option value="3">ct_lab</option>
		      <option value="4">mri_lab</option>
		      <option value="5">pathology_lab</option>
		      <option value="6">pharmacy</option>
		      <option value="7">xray_lab</option>
		</datalist>
		<br>



		<button type="submit" name="submit" class="btn btn-primary btn-block btn-large">Predict</button>

	</form>

</body>
</html>


<?php
if(isset($_POST["submit"]))
{
	$task=$_POST["task"];
	$gender=$_POST["gender"];
	$age=$_POST["age"];
	$sessions=$_POST["session"];
	//$day=$_POST["day"];
	$doc_type=$_POST["doc_type"];
	$dept=$_POST["dept"];

	$string=$task.$gender.$dept.$doc_type.$sessions.$age;
	
	$treattime=exec("model2.py $string");
	
}

?>