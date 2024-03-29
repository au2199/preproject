<!DOCTYPE html>
<html lang='en' dir='ltr'>
<?php
$web = "KUCPE";
$topic = "แก้ไขข้อมูล";

?>
<!--############################################## Head ###########################################################################-->

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
			$('#ui_tab').load('<?= base_url('Controller/ui_tabstd') ?>');
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

	<?php
	$count = 0;
	$group_id = array();
	$info_project = array();
	$name_project = array();
	$name_project_eng = array();
	
	foreach ($show->result() as $row) {
		array_push($group_id, $row->group_id);
		array_push($info_project, $row->info_project);
		array_push($name_project, $row->name_project);
		array_push($name_project_eng, $row->name_project_eng);
		//$count++;
		// echo $row->fname;
	}
	
	?>


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
				<div class="container-fluid well text-center">
					<table class="table table-bordered table-striped">
						<form action="<?= base_url('Controller/update_project') ?>" method='post'>
							<table class="table table-bordered table-striped ">
	                          
	                            <tr>
	                                <td class="colora">ชื่อโปรเจค</td>
	                                <td ><input class="form-control" type="text" name="name_project" value="<?php echo $name_project[0] ?>" placeholder=''></td>
	                            </tr>
	                            <tr>
	                                <td class="colora">Project Name</td>
	                                <td ><input class="form-control" type="text" name="name_project_eng" value="<?php echo $name_project_eng[0] ?>" placeholder=''></td>
	                            </tr>
	                            <tr>
	                                <td class="colora" >info project</td>
	                                <td><textarea class="form-control" rows="5" name="info_project" value="<?php echo $info_project[0]?>"><?php echo $info_project[0]?></textarea></td>
	                            </tr>
	                        </table>
	                        
	                        <button name='submit' class="btn colora" value='update_project'>ยืนยัน</button>
	                    </form>

					</table>
					<table class="table table-bordered table-striped ">
						
	                    <form action="<?= base_url('Controller/myGroup') ?>" method='post'>
								<button class='btn colora' value='1'>back
									<input name="group_id" value="1" style="display: none">

								</button>
						</form>
					</table>
				</div>

				<div>
					
				</div>
				<!--test-->
				<!-- <div class="container-fluid text-center">
				  
				  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
				  
				  <div class="modal fade" id="myModal" role="dialog">
				    <div class="modal-dialog modal-lg">
				      
				      <div class="modal-content">
				        <div class="modal-body">
				          <p>Some text in the modal.</p>
					    </div>
					  </div>
					</div>
				 </div>
				</div> -->
				<!-- </div> -->
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