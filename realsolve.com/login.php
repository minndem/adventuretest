<?php include('include/header.php'); ?>
<?php include('include/jumbotron.php'); ?>
<div class="row">
<?php
	$emailErr=$passErr=$error="";
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		include('mysqli_connect.php');
		
		$error_tracker=array();
		
		//Validate the input
		//Validate the email
		
		if(empty($_POST['email']))
		{
			$emailErr="Please provide your email address";
			$error_tracker[]=1;
		}else{
			$email=mysqli_real_escape_string($dbc, input_test($_POST['email']));
			
			//Check if the input format is valid
			
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$emailErr="Invalide email addres";
				$error_tracker[]=2;
			}else{
					//------------Validate the password
				if(empty($_POST['password'])){
					
					$passErr="Please enter your password";
					$error_tracker[]=3;
					
				}else{
					$pass=mysqli_real_escape_string($dbc, input_test($_POST['password']));
					
					//Decrypte the password
					$sql="SELECT * FROM users WHERE email='$email'";
					$run=mysqli_query($dbc, $sql);
					
					$num_row=mysqli_num_rows($run);
					
					if($num_row>0)
					{
						$row=mysqli_fetch_array($run, MYSQLI_ASSOC);
						
						$passCheck=password_verify($pass, $row['password']);
						
						if($passCheck == true)
						{
							$_SESSION['id']=$row['user_id'];
							$_SESSION['first_name']=$row['first_name'];
							$_SESSION['last_name']=$row['last_name'];
							$_SESSION['email']=$row['email'];
							
							header("Location: include/main_index.php");
							
						}elseif($passCheck == false)
						{
							$error="The userid and/or password are/is incorrect";
							
						}
					}
					
					
				}
			}
		}
		
	
		
	}
	
	//function to test the inputs
	
	function input_test($data)
	{
		$data=htmlspecialchars($data);
		$data=trim($data);
		$data=stripslashes($data);
		return($data);
	}
	
	?>
	<div class="container">
		<div class="col-md-6"></div>
		<div class="col-md-6">
			<form method="POST" autocomplete="off" action="login.php">
    			<div class="form-group">
       			 	<label for="exampleInputEmail1">Email address: <span class="text-danger"> * <?php echo($emailErr); ?></span></label>
        				<input type="text" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter email">
    			</div>
   				<div class="form-group">
       				<label for="exampleInputPassword1">Password: <span class="text-danger"> * <?php echo($passErr); ?></span></label>
        				<input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
    			</div>
 

    			<button type="submit" class="btn" style=" background-color:#275760; color: #FFFFFF; border-radius: 0px;">Continue</button> or <a href="create_account.php">Create one !</a>
			</form>
			
			
		</div>
	</div>
</div>


<?php include('include/footer.php'); ?>