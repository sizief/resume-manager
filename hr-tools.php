<?php
session_start();

require_once('lib/config.php');
require_once('lib/functions.php');
require_once('lib/db-connect.php');
IsAuthorize($_SERVER['REQUEST_URI']);
$page_name = "HR Tools";


if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['submit-source']) )
{
    $result = save_source($_POST['source_name']);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['submit-status']) )
{
    $result = save_status($_POST['status_name']);
}
?>

<?php
require_once("menu.php");
?>

<?php if (isset($result))echo show_alert($result) ?>

<div class="box-container">
    <div class="row">
        <div class="six columns">
            <form method="post">
                <label for="job_name">Source Name</label>
                <input name="source_name" id="source_name" placeholder="" type="text">
                <input class="button-primary" value="Add Source" type="submit" name="submit-source">
            </form>
        </div>
    </div>

    <label for="job_name">source List</label>
    <?php
    $source_list=source_list();
    for($i=0;$i<count($source_list);$i++){
        echo '<div class="row list"><i class="fa fa-info fa-padding" aria-hidden="true"></i>';
        echo $source_list[$i]['description'];
        echo '</div>';
    }
    ?>
</div>


<div class="box-container">
    <div class="row">
        <div class="six columns">
            <form method="post">
                <label for="status_name">Status Name</label>
                <input name="status_name" id="status_name" placeholder="" type="text">
                <input class="button-primary" value="Add Status" type="submit" name="submit-status">
            </form>
        </div>
    </div>

    <label for="status_name">Status List</label>
    <?php
    $status_list=status_list();
    for($i=0;$i<count($status_list);$i++){
        echo '<div class="row list"><i class="fa fa-info fa-padding" aria-hidden="true"></i>';
        echo $status_list[$i]['description'];
        echo '</div>';
    }
    ?>
</div>

</div>
</body>
</html>

