<!DOCTYPE html>
<html lang='en' dir='ltr'>

<?php
$web = "KUCPE";
$topic = "เพิ่มข้อมูลอาจารย์์";

?>

<head>
	<!-- Okp config -->
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Load style.css file, which store in css folder -->
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'></script>
	<!-- Latest compiled and minified CSS -->
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css'>
	<!-- jQuery library -->
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
	<!-- Latest compiled JavaScript -->
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
	<link rel="stylesheet" href="<?php echo base_url() ?>css/style.css">
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<meta charset='utf-8'>
	<script>
		$(function() {
			$('#ui_main').load('<?= base_url('Controller/ui_main') ?>');
			$('#ui_footer').load('<?= base_url('Controller/ui_footer') ?>');
			$('#ui_tab').load('<?= base_url('Controller/ui_tabtch') ?>');
		})
	</script>
	<style media="screen">
		.bgimg {
			background-image: url('<?= base_url('./image/back_inweb.jpg') ?>');
			min-height: 100%;
			background-position: center;
			background-size: cover;
			/* z-index: -1; */
		}
	</style>
	<title><?php echo $web ?></title>
</head>

<!--############################################## Header ###########################################################################-->
<header style="height: 12.7vh">
	<div id='ui_main'></div>
</header>

<!--############################################## Body ###########################################################################-->

<body>
	<div class="container-fluid text-center">
		<div class="row">
			<!-- Bar -->
			<div class="col-sm-2 colora" style="min-height: 87.3vh">
				<div id='ui_tab'></div>
			</div>
			<!-- End Bar -->
			<div class="col-sm-10 text-left bgimg">
				<div class="colora" style="padding: 10px">
					<h2><?php echo $topic ?></h2>
				</div>
				<div class="container-fluid well">
					<!-- Body -->
					<form class="form-horizontal" action="<?= base_url('Controller/insertstd_ad') ?>" method='post'>
						<div class="row">
							<div class="col-sm-4"></div>
							<!-- ///////////////////////////////////////////////// -->
							<div class="col-sm-4" style="text-align: center;">
								<label>
									<h1 style="color:black;">ปีการศึกษา 2562</h1>
								</label>
								<!-- <label><h2>นำข้อมูลเข้านิสิต</h2> </label> -->
							</div>
							<div class="col-sm-4"></div>
						</div>
						<!--//////////////////////////////////////////////////-->
						<div class="row">
            							<div class="col-sm-12">


                                  <div class="form-group">
                                    <label for="email" class="control-label col-sm-2">title : </label>
                                      <div class="col-sm-10">
                                        <input type='text'  class="form-control"  name='titleso' value='' >
                                      </div>
                                  </div>

                                  <div class="form-group">
                                    <label for="email" class="control-label col-sm-2">firstname :</label>
                                      <div class="col-sm-10">
                                        <input type='text' class="form-control" name='fnameso' value='' >
                                      </div>
                                  </div>

                                  <div class="form-group">
                                    <label for="email" class="control-label col-sm-2">lastname :</label>
                                      <div class="col-sm-10">
                                    	   <input type='text' class="form-control" name='lnameso' value='' >
                                      </div >
                                  </div>

                                  <div class="form-group">
                                    <label for="email" class="control-label col-sm-2">email :</label>
                                    <div class="col-sm-10">
                                  	   <input type='text' class="form-control" name='emailso' value='' >
                                     </div>
                                  </div>

                                  <div class="form-group">
                                    <div class="row">
                                      <div class="col-sm-5"></div>
                                      <div class="col-sm-7">
                                        <button type='submit' class='btn-success btn' name='submit' value='submit' >Submit</button>
                                        <button type='submit' class='btn-danger btn' name='can' value='can' >Cancel</button>
                                      </div>

                                     </div>
                                  </div>

            					</div>
            				</div>
                    </div>
		        </div>
          </form>
	       </div>
      </div>
    </div>
  </div>
</body>
<!--############################################## Footer ###########################################################################-->

<footer>
	<div id='ui_footer'></div>
</footer>
<!--############################################## End ###########################################################################-->

</html>
