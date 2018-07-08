<?php
session_start();

require_once('lib/config.php');
require_once('lib/functions.php');
require_once('lib/db-connect.php');
IsAuthorize($_SERVER['REQUEST_URI']);
$page_name = "Register Candidates";
$upload_folder = 'resumes';


if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['submit']) )
{
    //upload resume file
    if ($_FILES['resume']['size'] !=0) {
        $resume_path = upload_file($_FILES['resume'], $upload_folder);
    }else{
        //no resume find to upload
        $resume_path ='';
    }

    //save candidate data and file uri
    $result = save_candidate($_POST['name'],
        $_POST['birth_date'],
        $_POST['job'],
        $_POST['source'],
        $resume_path,
        $_POST['profile']);
}
?>

<?php
require_once("menu.php");
?>

<?php if (isset($result))echo show_alert($result) ?>

<form method="post" enctype="multipart/form-data">

        <div class="u-full-width separator">
            <h5>Personal Info</h5>
        </div>

        <div class="row">
            <div class="six columns">
                <label for="name">Name</label>
                <input name="name" id="name" class="u-full-width" placeholder="" type="text">
            </div>

            <div class="six columns">
                <label for="birth_date">Birth date</label>
                <input name="birth_date" id="birth_date" class="u-full-width" placeholder="" type="text">
            </div>
        </div>

        <div class="u-full-width separator">
            <h5>Profession Info</h5>
        </div>

        <div class="row">
            <div class="six columns">
                <label for="job">Job</label>
                <select class="u-full-width" id="job" name="job">
                    <?php
                    $job_list=job_list();
                    for($i=0;$i<count($job_list);$i++){
                        echo '<option value="'.$job_list[$i]['id'].'">'.$job_list[$i]['description'].'</option>';
                    }
                    ?>
                </select>
            </div>



            <div class="six columns">
                <label for="source">Source</label>
                <select class="u-full-width" id="source" name="source">
                    <?php
                    $source_list=source_list();
                    for($i=0;$i<count($source_list);$i++){
                        echo '<option value="'.$source_list[$i]['id'].'">'.$source_list[$i]['description'].'</option>';
                    }
                    ?>
                </select>
            </div>
        </div>

        <!--<div class="twelve columns">
            <label for="tag">Tag</label>
            <input name="tag" id="tag" class="u-full-width" placeholder="" type="text">
        </div>-->

        <div class="row">
            <div class="six columns">
                <label for="profile">Profile URL</label>
                <input name="profile" id="profile" class="u-full-width" placeholder="" type="text">
            </div>

            <div class="six columns">
                <label for="resume">Resume</label>
                <input name="resume" class="u-full-width" type="file" size="32">
            </div>


        </div>

        <div class="row">
            <div class="six columns">
                <input class="button-primary" value="submit input" type="submit" name="submit">
            </div>
        </div>


    </form>
</div>

<script
    src="https://code.jquery.com/jquery-1.12.4.min.js"
    integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
    crossorigin="anonymous"></script>
<script src="lib/babakhani/persian-date-0.1.8.min.js"></script>
<script src="lib/babakhani/persian-datepicker-0.4.5.min.js"></script>
<link href="lib/babakhani/persian-datepicker-0.4.5.min.css" rel="stylesheet" />

<script>
    $(document).ready(function () {
        $("#birth_date").pDatepicker({
            persianDigit : false,
            format: "YYYY-MM-DD"
        });
    });

</script>
</body>
</html>