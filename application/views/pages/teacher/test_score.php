<!DOCTYPE html>
<html lang='en' dir='ltr'>

<?php
$web = "KUCPE";
$topic = "ให้คะแนน(teacher)";

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
    $teacher_id = 1;
    $error = 0;
    $show_grp = $show[0];
    $show_err = $show[1];
    $error = $show_err['error'];
    $weight_document = 0.5;
    $weight_knowledge = 0.5;
    $weight_completly = 0.5;
    $weight_present = 0.5;
    $group_ids = array();
    $name_projects = array();
    foreach ($show_grp->result() as $row) {
        array_push($group_ids, $row->group_id);
        array_push($name_projects, $row->name_project);
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
                    <?php
                    if (!empty($error)) {
                        echo "<div class='alert'>
                            <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
                            <strong>Danger!</strong> Indicates a dangerous or potentially negative action.
                            </div>";
                    }
                    ?>
                    <form action="<?= base_url('Controller/update_score') ?>" method='post'>
                        <?php
                        echo "<input style='display: none' name='weight_document' value='$weight_document'>
                            <input style='display: none' name='weight_knowledge' value='$weight_knowledge'>
                            <input style='display: none' name='weight_completly' value='$weight_completly'>
                            <input style='display: none' name='weight_present' value='$weight_present'>
                        ";
                        ?>
                        <input list="browsers" name="group_name" class="form-control 1" value='' id='reset1' placeholder='Ant'>
                        <table class="table table-bordered table-striped ">
                            <tr>
                                <th>
                                    <center>หัวข้อ</center>
                                </th>
                                <th>
                                    <center>คะแนน</center>
                                </th>
                            </tr>
                            <tr>
                                <td>คะแนนเล่มโครงงาน</td>
                                <td>
                                    <input onclick="f1()" id='r1' class="form-control slider" type="range" name="score_document" value="0" placeholder='max 25' min='0' max='25'>
                                    <p id='v1'></p>
                                </td>
                            </tr>
                            <tr>
                                <td>คะแนนความรู้ในโครงงาน</td>
                                <td>
                                    <input onclick="f2()" id='r2' class="form-control slider" type="range" name="score_knowledge" value="0" placeholder='max 25' min='0' max='25'>
                                    <p id='v2'></p>
                                </td>
                            </tr>
                            <tr>
                                <td>ความสมบูรณ์ของชิ้นงาน</td>
                                <td>
                                    <input onclick="f3()" id='r3' class="form-control slider" type="range" name="score_completly" value="0" placeholder='max 25' min='0' max='25'>
                                    <p id='v3'></p>
                                </td>
                            </tr>
                            <tr>
                                <td>การนําเสนอ</td>
                                <td>
                                    <input onclick="f4()" id='r4' class="form-control slider" type="range" name="score_present" value="0" placeholder='max 25' min='0' max='25'>
                                    <p id='v4'></p>
                                </td>
                            </tr>
                            <!-- <tr>
                                <td>เกรด</td>
                                <td><?php echo "A" ?></td>
                            </tr> -->
                        </table>
                        <p style='color: red'>***โปรดตรวจสอบว่ากรอกข้อมูลครบทุกช่อง***</p>
                        <p style='color: red'>***กรณีที่ให้ 0 โปรดระบุ 0 ไว้ด้วย***</p>
                        <button name='submit' class="btn colora" value='update_score'>ยืนยัน</button>
                    </form>
                    <datalist id="browsers">
                        <!-- Data -->
                        <?php foreach ($show_grp->result() as $row) : ?>
                            <tr>
                                <td><?php echo "<option>" . $row->name_project  . "</option>" ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </datalist>
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

<!-- #################################################################################################################### -->
<!-- #################################################################################################################### -->
<!-- ###############################################       SCRIPT       ################################################# -->
<!-- #################################################################################################################### -->
<!-- #################################################################################################################### -->
<script>
    $(document).ready(function() {
        $("#reset1").click(function() {
            $(".1").val("");
        });
    });

    function f1() {
        var x = document.getElementById("r1").value;
        document.getElementById("v1").innerHTML = x;
        // document.getElementById("v1").value = x;
    }

    function f2() {
        var x = document.getElementById("r2").value;
        document.getElementById("v2").innerHTML = x;
    }

    function f3() {
        var x = document.getElementById("r3").value;
        document.getElementById("v3").innerHTML = x;
    }

    function f4() {
        var x = document.getElementById("r4").value;
        document.getElementById("v4").innerHTML = x;
    }
</script>