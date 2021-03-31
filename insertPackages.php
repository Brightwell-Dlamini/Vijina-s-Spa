<?php require_once("./includes/db.php"); ?>
<?php require_once("./includes/functions.php"); ?>
<?php require_once("./includes/sessions.php"); ?>

<!-- FORM VALIDATION BEGGINING -->
<?php
if (isset($_POST["Submit"])) {
	$PackageImage = $_FILES['pimage']['name'];
	$target = "uploadsImg/".basename($_FILES["pimage"]["name"]);
	$PackageName = $_POST["pname"];
	$pinfo = $_POST['info'];
	$PackagePrice = $_POST['pprice'];
	$PackageDuration = $_POST['pduration'];
	$PackageCode = $_POST["pcode"];
	if (empty($PackageImage)){
	//||empty($PackageName)||empty($pinfo)|| empty($PackagePrice) ||empty($PackageDuration)||empty($PackageCode)) {
		$_SESSION["errorMessage"] = "All Fields Must Be Filled out";
		redirectTo("insertPackages.php");
	} else {
		//Query to insert product in database if everything is fine
		$sql = "INSERT INTO packages (pimage,pname,pinfo,pprice,pduration,pcode)";
		$sql .= "VALUES(?,?,?,?,?,?)";
		$stmt = $connectingDB->prepare($sql);
		$stmt->bind_param('sssiis',$PackageImage,$PackageName,$pinfo,$PackagePrice,$PackageDuration,$PackageCode );
		$Execute = $stmt->execute();
		move_uploaded_file($_FILES["pimage"]["tmp_name"],$target);
//var_dump($Execute);
		if ($Execute) {
			$_SESSION["successMessage"] = "Package Successfully added";
	        redirectTo("insertPackages.php");
		} else {
		    $_SESSION["errorMessage"] = "Something Went Wrong Try Again";
		    redirectTo("insertPackages.php");
		}
	}
}
//Ending of the submit button
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
    <link rel="stylesheet" href="./bootstrap-4.3.1/css/bootstrap.min.css">
	<title>Product</title>
</head>

<body>
	<section class="container py-2 mb-4">
		<div class="row">
			<div class="offset-lg-1 col-lg-10" style="min-height:100vh;">
				

				<form class="" action="insertPackages.php" method="POST" enctype="multipart/form-data">
					<div class="card bg-secondary text-light mb-3">
				
						<div class="card-header">
							<h1>Upload Your Package</h1>
							<?php
				echo errorMessage();
				echo successMessage();
				?>
						</div>
						<div class="card-body bg-dark">
						    <div class="form-group mb-1">
                                <label for="imageSelect"><span class="fieldInfo">Select Image</span></label>
                                <div class="custom-file">
                                    <input class="custom-file-input" type="File" name="pimage" id="imageSelect">
                                </div>
                            </div>
							<div class="form-group mb-1">
								<label for="title"><span class="fieldInfo">Package Name:</span></label>
								<input class="form-control" type="text" name="pname" id="title" placeholder="Type Title Here">
							</div>
							<div class="form-group mb-1">
								<label for="album"><span class="fieldInfo">General Info :</span></label>
								<input class="form-control" type="text" name="info" id="album" placeholder="Type Song Album Here">
							</div>
                            <div class="form-group mb-1">
								<label for="album"><span class="fieldInfo">Package Price:</span></label>
								<input class="form-control" type="text" name="pprice" id="album" placeholder="Type Song Album Here">
							</div>
							<div class="form-group mb-1">
								<label for="album"><span class="fieldInfo">Package Duration:</span></label>
								<input class="form-control" type="text" name="pduration" id="album" placeholder="Type Song Album Here">
							</div>
							<div class="form-group mb-1">
								<label for="album"><span class="fieldInfo">Package Code:</span></label>
								<input class="form-control" type="text" name="pcode" id="album" >
							</div>
							<div class="row">
								<div class="col-lg-6 d-grid gap-2 mx-3">
									<button type="submit" name="Submit" class="btn btn-success btn-block"><i class="fas fa-check"></i>Add Package</button>
								</div>
							</div>

						</div>
					</div>
				</form>
			</div>
		</div>
	</section>

	

</body>

</html>