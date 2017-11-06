<?php include('include/header.php'); ?>
<?php include('include/jumbotron.php'); ?>

<div class="row">
<?php
	$fnameErr=$lnameErr=$emailErr=$createpassErr=$confirmpassErr=$passErr=$error="";
	
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		include('mysqli_connect.php');		//establish the connection to the databases
		
		$pass1=$pass2="";
		$erro_tracker=array();
		
		
		//Validate the input from the from 
		//Validate the firat name
		
		if(empty($_POST['first_name'])){
			$fnameErr="Please provide your first name";
			$erro_tracker[]=1;
		}else{
			$fname=mysqli_real_escape_string($dbc, input_test($_POST['first_name']));
		}
		//Validate the last name
		
		if(empty($_POST['last_name']))
		{
			$lnameErr="Please provide your last name";
			$erro_tracker[]=2;
		}else{
			$lname=mysqli_real_escape_string($dbc , input_test($_POST['last_name']));
			
		}
		//Validate the email
		if(empty($_POST['email']))
		{
			$emailErr="Please provide your email address";
			$erro_tracker[]=3;
		}else{
			$email=mysqli_real_escape_string($dbc, input_test($_POST['email']));
			//Validate the email format
			
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$emailErr="Invalid email format";
				$erro_tracker[]=4;
			}
			
			//prevent the new user to enter register
			$sql="SELECT * FROM users WHERE email='$email'";
			$run=mysqli_query($dbc, $sql);
			//count the number or row
			$num_row=mysqli_num_rows($run);
			if($num_row>0)
			{
				$error="Usert already exist";
				$erro_tracker[]=7;
			}
		}
		
		//Validate the password
		if(empty($_POST['create_password'])){
			$createpassErr="Please create your password";
			$erro_tracker[]=5;
		}else{
			$pass1=mysqli_real_escape_string($dbc, input_test($_POST['create_password']));
		}
		
		if(empty($_POST['confirm_password'])){
			$confirmpassErr="Please confirm your password";
			$erro_tracker[]=6;
		}else{
			$pass2=mysqli_real_escape_string($dbc, input_test($_POST['confirm_password']));

		}
		
		//Validate the equality of the password
		if($pass1 == $pass2){
			//Encrypte the password
			$encrypte=password_hash($pass1, PASSWORD_DEFAULT);
		}else{
			$passErr="Your password does not match";
			$erro_tracker[]=6;
		}
		
		if(empty($erro_tracker))   //if the there is not errot
		{
			//make the query
			
			$sql = "INSERT INTO users (first_name, last_name, email, password, registration_date) VALUES('$fname', '$lname', '$email', '$encrypte', NOW())";
			//run the query
			$run=mysqli_query($dbc, $sql);
			
		}
	}
	
	//function to test the input
	function input_test($data)
	{
		$data=htmlspecialchars($data);
		$data=trim($data);
		$data=stripslashes($data);
		
		return($data);
		
	}
	
	?>
	
	<div class="container" style="background-color: #275760; padding: 0px; height: 100%;">
		<div class="col-md-6" ></div>
		<div class="col-md-6" style="background-color: #FFFFFF; margin: 0px;">
				<span class="text-danger"><?php echo($error) ?></span>
				<p class="text-danger">* required</p><br>
		
				<form autocomplete="off" action="#" method="POST">
   				
    				<div class="form-group">
       					<label for="first_name">First Name: <span class="text-danger">* <?php echo($fnameErr) ?></span></label>
        					<input type="text" class="form-control" name="first_name" placeholder="Enter first name">
    				</div>
    				
    				<div class="form-group">
       					<label for="first_name">Last Name:<span class="text-danger"> * <?php echo($lnameErr) ?></span></label>
        					<input type="text" class="form-control" name="last_name" placeholder="Enter last name">
    				</div>
    				
    				<div class="form-group">
       					<label for="first_name">Email address:<span class="text-danger"> * <?php echo($emailErr) ?></span></label>
        					<input type="text" class="form-control" name="email" placeholder="emailaddress@example.com">
    				</div>
    				
    				<div class="form-group">
        				<label for="exampleInputPassword1">Create password: <span class="text-danger"> * <?php echo($createpassErr) ?></span></label>
        					<input type="password" class="form-control" name="create_password"  placeholder="Create password">
    				</div>
    				
    				<div class="form-group">
        				<label for="exampleInputPassword1">Confirm password: <span class="text-danger"> * <?php echo($confirmpassErr) ?></span></label>
        					<input type="password" class="form-control" name="confirm_password"  placeholder="Retype password">
    				</div>

    				<button type="submit" class="btn" style=" background-color:#275760; color: #FFFFFF; border-radius: 0px;">Submit</button> or <a href="login.php">Login to your account</a>
				</form>
			
				
	
			
			
		</div>
		
		
	</div>
	
</div>



<?php include('include/footer.php'); ?>