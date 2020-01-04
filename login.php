<?php
	//include config
	require_once('includes/config.php');

	//check if already logged in move to home page
	if( $user->is_logged_in() )
	{ 
		$user->redirect('memberpage.php');
		
		exit(); 
	}

	//process login form if submitted
	if(isset($_POST['submit']))
	{

		if (!isset($_POST['username'])) $error[] = "Please fill out all fields";
		if (!isset($_POST['password'])) $error[] = "Please fill out all fields";

		$username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);;
		$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);;

		if($user->login($username, $password))
		{
			$user->redirect('memberpage.php');

			exit;
		} 
		else
		{
			$error[] = 'Invalid logins';
		}
	}

	//define page title
	$title = 'Login';

	//include header template
	require('layout/header.php'); 

?>

	
<div class="container">

	<div class="row contentlogin">
        <div class="col-xs-12 col-sm-8 col-md-5 col-sm-offset-3 col-md-offset-3 text-center">
            <h2 class="logintitle">Sign in</h2>
        </div>
	    <div class="col-xs-12 col-sm-8 col-md-5 col-sm-offset-3 col-md-offset-3 loginpage">
			<form role="form" method="post" action="" autocomplete="on">
				

				<?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="alert alert-danger">'.$error.'</p>';
					}
				}				
				?>

				<div class="form-group">
					<input type="text" name="username" id="username" class="form-control input-lg" placeholder="Username" value="<?php if(isset($error)){ echo htmlspecialchars($_POST['username'], ENT_QUOTES); } ?>" tabindex="1">
				</div>

				<div class="form-group">
					<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="3">
				</div>
				
				<div class="row">
					<div class="col-xs-12 col-md-12"><input type="submit" name="submit" value="Sign in" class="btn btn-primary btn-block btn-lg" tabindex="5"></div>
				</div>

				<div class="loginSignUpSeparator"><span class="textInSeparator">or</span></div>
				<div class="row">
					<div class="col-xs-12 col-md-12">
					    <a href="index.php" class="btn btn-default btn-block btn-lg">Sign up</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>


<?php 
//include header template
require('layout/footer.php'); 
?>
