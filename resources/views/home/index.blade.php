

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Student Portal</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="row">
	<div class="col-md-12">
		<img src="{{ URL::to('/') }}/images/logo.jpg" class="img-responsive" alt="logo" style="height: 100px;" >
	</div>
	<div class="col-md-12">
		<img src="{{ URL::to('/') }}/images/uniten.jpg" class="img-responsive" alt="logo" >
	</div>
	<div class="col-md-12" style="margin: 15px 0px">
		<div class="col-md-4 text-center"><a href="/login" class="btn btn-primary" style="min-width: 150px">Administrator</a></div>
		<div class="col-md-4 text-center"><a href="/login" class="btn btn-primary" style="min-width: 150px">Lecturer</a></div>
		<div class="col-md-4 text-center"><a href="/login" class="btn btn-primary" style="min-width: 150px">Parent</a></div>
	</div>
	<div class="col-md-6 text-center">
		<p>For enquiries, suggestions or comments, please contact us via i-Recommend.</p>
		<p>If you experience difficulties viewing the website, please contact webmaster@uniten.edu.my</p>
		<p>Copyright © 2016 Universiti Tenaga Nasional. All rights reserved. </p>
		<p>Disclaimer and Personal Data Protection Policy</p>
	</div>
	<div class="col-md-6 text-center">
		<p><b>UNITEN, Putrajaya Campus</b></p>
		<p>Jalan Ikram-Uniten, 43000 Kajang, Selangor, Malaysia</p>
		<br>
		<p></p>
	</div>
</div>

</body>
</html>