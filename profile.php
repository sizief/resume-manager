<?php
session_start();

require_once('lib/config.php');
require_once('lib/functions.php');
require_once('lib/db-connect.php');
IsAuthorize($_SERVER['REQUEST_URI']);
// add new action
if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['submit-action']) )
{
    $result = save_action($_POST['candidate_id'],
        $_POST['comment'],
        $_SESSION['user_id'], // user_id
        $_POST['status_id']);

    update_status($_POST['candidate_id'],$_POST['status_id']);
}

// retrieve profile data
$candidate_profile=candidate_profile($_GET['id']);
if (empty($candidate_profile)){
    echo "Candidate ID is not right or this id is removed.";
    die();
}
$page_name = "Profile: ".$candidate_profile['name'];

?>

<?php
require_once("menu.php");
?>

<?php if (isset($result))echo show_alert($result) ?>

<?php
    echo '<div class="row box-container" style="background: #f6f6f6;padding-left: 1em;">';
    echo '<span class="profile-name">'.$candidate_profile['id'].". ".$candidate_profile['name'].'</span>';
    $status_name = status_name($candidate_profile['status_id']);
    $status_style = status_style($candidate_profile['status_id']);

    echo '<a href="edit-candidate.php?id='.$_GET['id'].'"><i class="fa fa-edit fa-padding" aria-hidden="true"></i></a>';
    echo '<span class="status candidate-status '.$status_style['color_style'].'">'.$status_name['description'].'</span>';

    echo '<span class="profile">'.
         '<i class="fa fa-info fa-padding" aria-hidden="true"></i>'.
        $candidate_profile['job'].
        '</span>';

    echo '<span class="profile">'.
         '<i class="fa fa-info fa-padding" aria-hidden="true"></i>'.
         $candidate_profile['source'].
         '</span>';

    echo '<span class="profile">'.
         '<i class="fa fa-info fa-padding" aria-hidden="true"></i>'.
         $candidate_profile['birth_date'].
         '</span>';

    if (!empty($candidate_profile['profile'])){
        echo  '<span class="profile">'.
            '<i class="fa fa-link fa-padding" aria-hidden="true"></i>'.
            'Profile link: <a target="_blank" href="'.$candidate_profile['profile'].'">'.
            $candidate_profile['profile'].
            '</a></span>';
    }

    if (!empty($candidate_profile['resume_path'])){
        echo '<span class="profile">'.
            '<i class="fa fa-file fa-padding" aria-hidden="true"></i>'.
            'Resume: <a target="_blank" href="'.$candidate_profile['resume_path'].'">'.
            $candidate_profile['resume_path'].
            '</a></span>';
    }


echo '</div>';
?>


<!---------- candidate history -->

    <?php
    echo '<div class="box-container">';
    echo '<span class="history-date">'.$candidate_profile['create_date'].' </span>';
    echo '<span class="history-title"><i class="fa fa-tasks fa-padding" aria-hidden="true"></i>profile created</span>';
    echo '</div>';

    $history = candidate_history($_GET['id']);
    for($i=0;$i<count($history);$i++){
        echo '<div class="box-container">';
        echo '<span class="history-date"><i class="fa fa-calendar fa-padding" aria-hidden="true"></i>'.$history[$i]['created_date']." | ".$history[$i]['name'].'</span>';
        echo '<span class="history-title"><i class="fa fa-tasks fa-padding" aria-hidden="true"></i>'.$history[$i]['description'].'</span>';
        echo '<span class="history-comment"><i class="fa fa-comment fa-padding" aria-hidden="true"></i>'.$history[$i]['comment'].'</span>';
        echo '</div>';
    }
    ?>

<!---------- register new action -->
<form method="post">
    <div class="row">
        <div class="six columns">
            <label for="next_action">Next Action</label>
            <select class="u-full-width" id="status_id" name="status_id">
                <?php
                $status_list=status_list();
                for($i=0;$i<count($status_list);$i++){
                    echo '<option value="'.$status_list[$i]['id'].'">'.$status_list[$i]['description'].'</option>';
                }
                ?>
            </select>
        </div>
    </div>
    <label for="comment">Comment</label>
    <textarea class="u-full-width"  id="comment" name="comment"></textarea>
    <input type="hidden" value="<?php echo $_GET['id'] ?>" name="candidate_id">
    <input class="button-primary" name="submit-action" value="submit action" type="submit">
</form>




</div>

</body>
</html>