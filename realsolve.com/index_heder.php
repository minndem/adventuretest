<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>www.realsolve.com</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style/style.css">
  <style>
	.wrapper{
		height: 200%;
		width: 100%;
		
}

	
	</style>
</head>

<body>


</div>
    <div>
        <nav class="navbar navbar-default navigation-clean" data-aos="slide-down" style="font-family:Aldrich, sans-serif; margin: 0px; border-radius: 0px;" >
            <div class="container">
                <div class="navbar-header"><a class="navbar-brand navbar-link" href="./index.php">realsolve<span class="text-danger">.com</span> </a>
                    <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                </div>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active" role="presentation"><a href="main_index.php">Home </a></li>
                        <li role="presentation"><a href="contact.php">Contact </a></li>
                        <li role="presentation"><a href="about.php">About </a></li>
                        <li role="presentation"><a href="resume.php">Resume </a></li>
                        <li role="presentation"><a href="blog.php">Blog</a></li>
                       
                         <?php
							if(isset($_SESSION['email']))
							{
								?>
								<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i><b><?php echo($_SESSION['email']); ?></i></b><span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="config.inc/signout.php">Sign Out</a></li>
									<li><a href="#">Your account</a>
								</ul>
								</li>
								
								<?php
								
							}else{
								
							
						
						?>
                          
                            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Account <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="../login.php">Login</a></li>
              <li><a href="../create_account.php">Create account</a></li>
            </ul>
          </li>
                   <?php }?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="wrapper">