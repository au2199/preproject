<!DOCTYPE html>
<html lang='en' dir='ltr'>

<?php
$web = "KUCPE";
$topic = "ผลการเลือกกรรมการ(admin)";

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
<header>
    <div id='ui_main'></div>
</header>

<!--############################################## Body ###########################################################################-->

<body>
    <?php
    $state = false; // recieve if admin click 'confirm button' /commit_result
    $show_grp = $show[0];
    $show_tch = $show[1];
    $group_ids = array();
    $name_projects = array();
    $fnames = array();
    foreach ($show_grp->result() as $row_grp) {
        array_push($group_ids, $row_grp->group_id);
        array_push($name_projects, $row_grp->name_project);
    }
    foreach ($show_tch->result() as $row_tch) {
        array_push($fnames, $row_tch->fname);
    }
    ?>
    <div class="container-fluid text-center">
        <div class="row">
            <!-- Bar -->
            <div class="col-sm-2 colora" style="min-height: 100vh">
                <div id='ui_tab'></div>
            </div>
            <!-- End Bar -->
            <div class="col-sm-10 text-left bgimg">
                <div class="colora" style="padding: 10px">
                    <h2><?php echo $topic ?></h2>
                </div>
                <div class="container-fluid well">
                    <!-- Body -->
                    <form action="<?= base_url('Controller/commit_result') ?>" method='post'>
                        <?php
                        if ($state) {
                            echo "<div><center><h3>อยู่ระหว่างการดำเนินการ</h3></center</div>";
                        } else {
                            ?>
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>
                                        <center>กลุ่ม</center>
                                    </th>
                                    <th>
                                        <center>กรรมการ</center>
                                    </th>
                                    <th>
                                        <center>กรรมการ</center>
                                    </th>
                                </tr>
                            <?php
                                for ($i = 0; $i < sizeof($name_projects); $i++) {
                                    $c = $i;
                                    $c1 = "";
                                    $c2 = "";
                                    $name_c1 = "";
                                    $name_c2 = "";
                                    if ($c >= sizeof($fnames) - 2) {
                                        $c = sizeof($fnames) - (sizeof($fnames) - 2);
                                    }
                                    foreach ($show_grp->result() as $row_grp) {
                                        if ($row_grp->group_id == $group_ids[$i]) {
                                            $c1 = $row_grp->teacher_commit_id_1;
                                            $c2 = $row_grp->teacher_commit_id_2;
                                        }
                                    }
                                    foreach ($show_tch->result() as $row_tch) {
                                        if ($row_tch->teacher_id == $c1) {
                                            $name_c1 = $row_tch->fname;
                                        }
                                        if ($row_tch->teacher_id == $c2) {
                                            $name_c2 = $row_tch->fname;
                                        }
                                    }
                                    echo "<tr>
                                        <td>" . $name_projects[$i] . "</td>
                                        <td>" . $name_c1 . "</td>
                                        <td>" . $name_c2 . "</td>
                                    </tr>";
                                }
                            }
                            ?>
                            </table>
                            <button name='submit' class="btn colora" value='true'>ยืนยัน</button>
                    </form>
                    <!-- Body -->
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