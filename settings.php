<?php
session_start();

require_once('lib/config.php');
require_once('lib/functions.php');
require_once('lib/db-connect.php');
IsAuthorize($_SERVER['REQUEST_URI']);

if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['submit-job']) )
{
    $result = save_job($_POST['job_name']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['submit-department']) )
{
    $result = save_department($_POST['department_name']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['submit-job-to-department']) )
{
    $result = save_job_to_department($_POST['department'],$_POST['job']);
}

$page_name = "Settings";
$department_list=department_list();
$job_list=job_list();
$job_to_department_list = job_to_department_list();
?>

<?php
require_once("menu.php");
?>

<?php if (isset($result))echo show_alert($result) ?>

<div class="box-container">
    <!---------- jobs settings -->
    <div class="row">
        <div class="six columns">
            <form method="post">
                <label for="job_name">Job name</label>
                <input name="job_name" id="job_name"  placeholder="" type="text">
                <input class="button-primary" value="Add Job" type="submit" name="submit-job">
            </form>
        </div>
    </div>

    <label for="job_name">Job List</label>
    <?php
    for($i=0;$i<count($job_list);$i++){
        echo '<div class="row list"><i class="fa fa-info fa-padding" aria-hidden="true"></i>';
        echo $job_list[$i]['description'];
        echo '</div>';
    }
    ?>
</div>

<div class="box-container">
    <!---------- department settings -->
    <div class="row">
        <div class="twelve columns">
            <form method="post">
                <label for="department_name">Department name</label>
                <input name="department_name" id="department_name" placeholder="" type="text">
                <input class="button-primary" value="Add Department" type="submit" name="submit-department">
            </form>
        </div>
    </div>

    <label for="department_name">department List</label>
    <?php
    for($i=0;$i<count($department_list);$i++){
        echo '<div class="row list"><i class="fa fa-info fa-padding" aria-hidden="true"></i>';
        echo $department_list[$i]['description'];
        echo '</div>';
    }
    ?>
</div>

<div class="box-container">
    <!---------- department-job settings -->
    <div class="row">
        <form method="post">
        <div class="five columns">
            <label for="job">Job</label>
            <select class="u-full-width" id="job" name="job">
                <?php
                for($i=0;$i<count($job_list);$i++){
                    echo '<option value="'.$job_list[$i]['id'].'">'.$job_list[$i]['description'].'</option>';
                }
                ?>
            </select>
        </div>

        <div class="two columns">
            <label class="u-full-width"> </label>
            belongs to
        </div>

        <div class="five columns">
            <label for="department">department</label>
            <select class="u-full-width" id="department" name="department">
                <?php
                for($i=0;$i<count($department_list);$i++){
                    echo '<option value="'.$department_list[$i]['id'].'">'.$department_list[$i]['description'].'</option>';
                }
                ?>
            </select>
        </div>
        <input class="button-primary"  value="Add relation" type="submit" name="submit-job-to-department">
    </form>

        <label for="job_name">Jobs relation to departments</label>
        <?php
        for($i=0;$i<count($job_to_department_list);$i++){
            echo '<div class="row list"><i class="fa fa-info fa-padding" aria-hidden="true"></i>';
            echo $job_to_department_list[$i]['job'];
            echo " belongs to ";
            echo $job_to_department_list[$i]['department'];
            echo '</div>';
        }
        ?>
    </div>
</div>


</div>
</body>
</html>

