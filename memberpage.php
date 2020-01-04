<?php 
	require('includes/config.php'); 

	//if not logged in redirect to login page
	if(!$user->is_logged_in() )
	{ 
		$user->redirect('login.php');
		
		exit(); 
	}

	//define page title
	$title = 'Dashboard';

	//include header template
	require('layout/header.php'); 
	require('layout/nav.php'); 
?>

<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3" >
			
			<h1 style="margin-bottom: 2rem; text-align: center">
				Hi <?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES); ?>, Welcome back
			</h2>

			<h2 style="margin-bottom: 2rem; text-align: center">Translate words now Using our Lame App</h2>
			
			<hr>
			<div class="panel-body bg-white">
				<table class="table">
					<thead>
						<tr>
							<th>No</th>
							<th>English Word</th>
							<th>Translated Word(To Italian)</th>
						</tr>
					</thead>
					<tbody>
						<tbody>
							<?php 
								$stmt = $db->prepare('SELECT * FROM dictionary');
								$stmt->execute();
								$row = $stmt->fetchAll();
								
								foreach ($row as $value) {
							?>
							<tr>
								<td><?php echo $value['id']; ?></td>
								<td><?php echo $value['english_word']; ?></td>
								<td><?php echo $value['italian_word'] ?></td>
							</tr>
							<?php } ?>
						</tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>


</div>

<?php 
//include header template
	require('layout/footer.php'); 
?>
