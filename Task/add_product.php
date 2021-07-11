<?php
//database connection

$con = new mysqli("localhost", "root", "", "interview_task");
        
		
			if(isset($_REQUEST['btnSubmit'])){
			
			//Code for image Upload
				
				$target_dir = "product_image/";
				$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				
				// Check if image file is a actual image or fake image
				if(isset($_POST["submit"])) {
				  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				  if($check !== false) {
					echo "File is an image - " . $check["mime"] . ".";
					$uploadOk = 1;
				  } else {
					echo "File is not an image.";
					$uploadOk = 0;
				  }
				}
				
				// Check if file already exists
				if (file_exists($target_file)) {
				  echo "Sorry, file already exists.";
				  $uploadOk = 0;
				}
				
				// Check file size
				if ($_FILES["fileToUpload"]["size"] > 500000) {
				  echo "Sorry, your file is too large.";
				  $uploadOk = 0;
				}
				
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
				  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				  $uploadOk = 0;
				}
				
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
				  echo "Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
				} else {
				  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
				  } else {
					echo "Sorry, there was an error uploading your file.";
				  }
				}
				//===================================
		// Check if image file is a actual image or fake image
		 // $Image = $_FILES["fileToUpload"]["name"];
		  
		$Name = mysqli_real_escape_string($con, $_REQUEST['name']);
		$Description = mysqli_real_escape_string($con, $_REQUEST['description']);
		$Price = mysqli_real_escape_string($con, $_REQUEST['price']);

		
		 mysqli_query($con,"INSERT INTO tbl_products(`name`,`image`,`description`,`price`) VALUES('$Name','$target_file','$Description','$Price')");

		header("location:add_product.php?&msg=1");
     }
if($_REQUEST['msg']==1){ $msg = '<span style="color:green">Record added successfully</span>'; }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
		<div class="box-header with-border" style="text-align:center;">
          <h3 class="box-title"> Product Add</a></h3>
              <p> <?php echo $msg; ?></p>

          </div>
<div class="row" style="text-align:center;">
        <div class="col-md-12">

          <div class="box box-danger">
           
            <div class="box-body">
            <form class="form-horizontal" id="Products" name="Products" method="post" action="add_product.php" enctype="multipart/form-data" >
             <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Product Name *</label>
                  <div class="col-sm-6">
                 <input type="text" class="form-control pull-right"  id="name" name="name">
                  </div>
                </div>
               <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Image</label>
                  <div class="col-sm-6">
                 <input type="file"  id="fileToUpload" name="fileToUpload">
                  </div>
            </div>
          	<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Description</label>
                  <div class="col-sm-6">
                 <textarea type="text" class="form-control pull-right"  id="description" name="description"></textarea>
                  </div>
            </div>
 			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Price</label>
                  <div class="col-sm-6">
                 <input type="text" class="form-control pull-right"  id="price" name="price">
                  </div>
                </div>
            
                <!-- Date -->
                 
              <!-- /.box-body -->
              <div class="box-footer">
              <div class="col-sm-8">
                <input type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-info pull-right" value="Add">
                </div>
              </div>
              <!-- /.box-footer -->
            </div>

            </form>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (left) -->
        
        <!-- /.col (right) -->
      </div>
</body>
</html>
