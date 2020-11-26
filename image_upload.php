<?php
if(isset($_POST['btn'])){
	//print_r($_FILES);
	$type = array('jpeg','jpg');
	$imageName = $_FILES['image']['name'];
	$imageType = pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
	$imageSize = $_FILES['image']['size'];
	$imgageTmp	= $_FILES['image']['tmp_name'];
	$directory = 'images/';
	$imgUrl = $directory.$imageName;
	
	if($imageName != null){
		if(file_exists(imgUrl)){
			$imgErr = 'File already exists';
	}	
	elseif($imageSize >1000000){
		$imgErr = 'Image Size Should be below 1 Mb';
	}elseif(!in_array($imgType,$type)){
		$imgErr = 'Image should be JPEG or JPG extension';
	}else{
		move_uploaded_file($imgageTmp,$imgUrl);
		$imgok = 'Image Uploded Successfully';
	}
    }else{
		$imgErr = 'PLease select an image';
	}
	
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container mt-3">
  <h2>Image Upload</h2>
  <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
    <p>Custom file:</p>
    <div class="custom-file mb-3">
      <input type="file" class="custom-file-input" id="customFile" name="image" accept="image/*">
      <label class="custom-file-label" for="customFile">Choose file</label>
    </div>
    <div class="mt-3">
      <button type="submit" class="btn btn-primary" name="btn">Submit</button>
    </div>
  </form>
</div>
<div class="container mt-3">
			<div class="row">
				<?php
				$dirname = "images/";
				$images = glob($dirname."*.{jpg,jpeg,png}",GLOB_BRACE);
				foreach($images as $image){
				?>
					<div class="col-md-4">
						<?php
						echo '<img class="" src="'.$image.'" alt="Chania" width="100%" height="250px">';
						echo pathinfo($image, PATHINFO_FILENAME);
						?>
					</div>
				<?php
				}
				?>
			</div>	
	</div>
	
	



</body>
</html>