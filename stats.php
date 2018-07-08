<?php
session_start();
require_once('lib/config.php');
require_once('lib/functions.php');
require_once('lib/db-connect.php');
IsAuthorize($_SERVER['REQUEST_URI']);
$page_name = "wow look how much talent we have!";

if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['submit'])){
    if($_POST['submit'] == "Job-Stats") {
        $result = stat_job($_POST['job']);
    }elseif($_POST['submit'] == "Source-Stats"){
        $result = stat_source($_POST['source']);
    }
}
?>

<?php
require_once("menu.php");
?>

    <div class="row">
        <form method="post">
            <div class="seven columns">
                <select id="job" style="width: 300px" name="job">
                    <?php
                    $job_list = job_list();
                    for($i=0;$i<count($job_list);$i++){
                        echo '<option value="'.$job_list[$i]['id'].'">'.$job_list[$i]['description'].'</option>';
                    }
                    ?>
                </select>
                <input class="button-primary"  value="Job-Stats" type="submit" name="submit">
            </div>
        </form>
    </div>

    <div class="row">
        <form method="post">
            <div class="seven columns">
                <select style="width: 300px" id="source" name="source">
                    <?php
                    $source_list = source_list();
                    for($i=0;$i<count($source_list);$i++){
                        echo '<option value="'.$source_list[$i]['id'].'">'.$source_list[$i]['description'].'</option>';
                    }
                    ?>
                </select>
                <input class="button-primary"  value="Source-Stats" type="submit" name="submit">
            </div>
        </form>
    </div>

    <div class="row">
        <?php
        if (isset($result)){
            echo "<b>".$_POST['submit']."</b>";
            echo '<table>';
            echo '<tr>';
            foreach ($result as $key => $value){
                echo '<td style="text-align: center">'.$key.'<br>'.$value.'</td>';
            }
            echo '</tr>';
            echo '</table>';
        }
        ?>
    </div>

<div class="row">
    <?php
        $stat_job_description_total = stat_job_description_total();
        echo "<b> Overall </b>";
        echo "<table>";
        foreach ($stat_job_description_total as $key => $value){
            echo "<tr>";
            echo '<td>'.$key.'</td><td>'.$value.'</td>';
            echo "</tr>";
        }
        echo "</table>";
    ?>
</div>


</body>
</html>