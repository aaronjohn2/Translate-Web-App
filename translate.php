<?php 
	require('includes/config.php'); 

	//if not logged in redirect to login page
	if(!$user->is_logged_in() )
	{ 
		$user->redirect('login.php');
		
		exit(); 
	}

	//define page title
	$title = 'Translate Now';

	//include header template
	require('layout/header.php'); 
	require('layout/nav.php'); 
?>

<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			<div class="panel panel-primary">
				<div class="panel-heading text-center">
					Translate Words to Italian Now
				</div>
				<div class="panel-body">
					<?php 
						if (isset($_POST['action_type']) && $_POST['action_type'] == 'translate')
						{
							$text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_STRING);

							$stmt = $db->prepare('SELECT english_word, italian_word FROM dictionary where english_word = :word');
							$stmt->execute(array(':word' => $text));
							$count = $stmt->rowCount();
							
							if ($count == 1)
							{
								$result = $stmt->fetch();

								echo '<pre><b>'.$text.'</b> translation to italian is'. $result['italian_word'].'</pre>';	
							}
							elseif ($count > 1)
							{
								$result = $stmt->fetchAll();

								foreach ($result as $value)
								{
									echo '<pre><b>'.$text.'</b> translation to italian is <span class="text-primary">'.$value['italian_word'].'<span>,'.'</pre>';	
								}
							}
							else
							{
								echo '<pre class="text-danger">Whoops!! English word <b>"'.$text.'"</b> not found in our dictionary</pre>';	
							}

						}
					?>

					<form action="" method="post" autocomplete="off">
						<div class="form-group">
							<input type="text" class="form-control" name="text" required="" placeholder="input english word">
						</div>
						<div class="form-group">
							<input type="hidden" name="action_type" value="translate">
							<button type="submit" class="btn btn-primary">Translate Now</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>


</div>

<?php 
//include header template
	require('layout/footer.php'); 
?>
