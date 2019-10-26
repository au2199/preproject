<!DOCTYPE html>
<html lang='en' dir='ltr'>

<?php
$web = "KUCPE";
$topic = "แก้ไข้คะแนน(admin)";

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
    <?php
    $show_grp = $show[0];
    $show_sco = $show[1];
    $group_ids = array();
    $name_projects = array();
    $score_ids = array();
    $score_documents = array();
    $score_knowledges = array();
    $score_completlys = array();
    $score_presents = array();
    foreach ($show_grp->result() as $row_grp) {
        array_push($group_ids, $row_grp->group_id);
        array_push($name_projects, $row_grp->name_project);
    }
    foreach ($show_sco->result() as $row_sco) {
        array_push($score_ids, $row_sco->score_id);
        array_push($score_documents, $row_sco->document);
        array_push($score_knowledges, $row_sco->knowledge);
        array_push($score_completlys, $row_sco->completly);
        array_push($score_presents, $row_sco->present);
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
                <div class="container-fluid well">
                    <!-- Body -->
                    <table class="table table-bordered table-striped ">
                        <tr>
                            <th>
                                <center>กลุ่ม</center>
                            </th>
                            <th>
                                <center>คะแนนเล่มโครงงาน</center>
                            </th>
                            <th>
                                <center>คะแนนความรู้ในโครงงาน</center>
                            </th>
                            <th>
                                <center>ความสมบูรณ์ของชิ้นงาน</center>
                            </th>
                            <th>
                                <center>การนําเสนอ</center>
                            </th>
                        </tr>
                        <?php
                        for ($i = 0; $i < sizeof($group_ids); $i++) {
                            $score_document = $score_documents[$i];
                            $score_knowledge = $score_knowledges[$i];
                            $score_completly = $score_completlys[$i];
                            $score_present = $score_presents[$i];
                            ?>
                            <form action='<?= base_url('Controller/edit_score') ?>' method='post'>
                            <?php
                                echo "
                                    <tr>
                                        <td><input class='btn colora' type='submit' name='group_name' value='$name_projects[$i]'></td>
                                        <td><input name='score_document$i' value='$score_document'></td>
                                        <td><input name='score_knowledge$i' value='$score_knowledge'></td>
                                        <td><input name='score_completly$i' value='$score_completly'></td>
                                        <td><input name='score_present$i' value='$score_present'></td>
                                        <input style='display: none' name='i' value='$i'>
                                    </tr>
                                </form>";
                            }
                            ?>
                    </table>
                    <p style='color: red'>***กดชื่อกลุ่มเพื่อเปลี่ยนคะแนนกลุ่มที่ต้องการ***</p>
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