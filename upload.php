<?php 
	require('includes/config.php'); 

	//if not logged in redirect to login page
	if(!$user->is_logged_in() )
	{ 
		$user->redirect('login.php');
		
		exit(); 
	}

	//define page title
	$title = 'Upload file';

	//include header template
	require('layout/header.php'); 

	require('layout/nav.php'); 

	//upload files
	if (isset($_POST['action_type']) && $_POST['action_type'] == 'upload')
	{
		//initialize an empty validation array
		$error = [];

		$check = $_FILES["file"];
		$type  = $check['type'];

		if ($type == "text/plain")
		{
			$target_dir = "uploads/";
			$target_file = $target_dir . basename($_FILES["file"]["name"]);
			$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
			//move uploaded file to folder
			move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

			//initialize an empty array
			$array = array();

			$handle = fopen($target_file, "r");

			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
			{
				$array[$data[0]] = $data[1];

				//save data into db to form dictionary
				$stmt = $db->prepare('INSERT INTO dictionary (user_id, english_word, italian_word) VALUES (:user, :word, :word2)');
				$stmt->execute(array(
					':user'	 => $_SESSION['memberID'],
					':word'  => $data[0], //english word
					':word2' => $array[$data[0]] //translated word
				));

				//redirect
				$user->redirect('memberpage.php');
			}

			fclose($handle);
		}
		else
		{
			$error[] = "Incorrect file format";
		}
		
	}
?>

<style type="text/css">
	.d-block{
		display: block;
	}
</style>
<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			<div class="panel panel-primary">
				<div class="panel-heading text-center">
					Upload the file containing the English words having their equivalent translation to Italian
				</div>
				<div class="panel-body">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label class="d-block form-group text-danger">
								<b>NOTE the following before uploading:</b>
							</label>
							<label class="d-block">File to be <b>ONLY</b> a plain text having extension, <b>.txt</b></label>
							<label class="form-group d-block">
								File contents <b>must</b> be in the following format: (as an example)
							</label>
							
							<pre class="form-group">word1, word1 translation <br>word2, word2 translation <br>word3, word3 translation</pre>
							
							<?php
								//display errors
								if(isset($error))
								{
									foreach($error as $error)
									{
										echo '<p class="alert alert-danger">'.$error.'</p>';
									}
								}
							?>
							<input type="file" class="form-control" name="file"required="">
						</div>
						<div class="form-group">
							<input type="hidden" name="action_type" value="upload">
							<button type="submit" class="btn btn-primary">Submit file</button>
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
