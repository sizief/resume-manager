<?php
session_start();
require_once('lib/config.php');
require_once('lib/functions.php');
require_once('lib/db-connect.php');
IsAuthorize($_SERVER['REQUEST_URI']);
$page_name = "Where is my talent";

if(isset($_GET['filter-submit'])){
    $candidate_list=candidate_list_bo_filter($_GET['job'],$_GET['source'],$_GET['status']);
}elseif(isset($_GET['search-submit'])){
    $candidate_list=candidate_list_bo_search($_GET['search-query']);
}else{
    $candidate_list=candidate_list_bo_filter("All","All","All");
}
?>

<?php
require_once("menu.php");
?>

<!-- filter menu -->

<div class="box-container row">
    <form method="get">
        <div class="three columns u-full-width" id="jobs">
            <label for="jobs">Jobs</label>
            <select id="job" name="job" class="u-full-width">
                <option value="All">All</option>
                <?php
                $job_list = job_list();
                for($i=0;$i<count($job_list);$i++) {
                    echo '<option value="' . $job_list[$i]['id'] .'" '
                        .is_option_selected($job_list[$i]['id'],$_GET['job'])
                        .'>'
                        . $job_list[$i]['description'] . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="three columns" id="sources">
            <label for="source">source</label>
            <select id="source" name="source" class="u-full-width">
                <option value="All">All</option>
                <?php
                $source_list = source_list();
                for($i=0;$i<count($source_list);$i++) {
                    echo '<option value="' . $source_list[$i]['id'] .'" '
                        .is_option_selected($source_list[$i]['id'],$_GET['source'])
                        .'>'
                        . $source_list[$i]['description'] . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="three columns" id="statuses">
            <label for="status">Status</label>
            <select id="status" name="status" class="u-full-width">
                <option value="All">All</option>
                <?php
                $status_list = status_list();
                for($i=0;$i<count($status_list);$i++) {
                    echo '<option value="' . $status_list[$i]['id'] .'" '
                        .is_option_selected($status_list[$i]['id'],$_GET['status'])
                        .'>'
                        . $status_list[$i]['description'] . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="three columns">
            <label for="status" style="height: 20px;"> </label>
            <input class="button-primary" value="Do It!" type="submit" name="filter-submit">
        </div>
    </form>
</div>


<label for="job_name">Candidates</label>
<?php
if ($candidate_list) {
    for ($i = 0; $i < count($candidate_list); $i++) {
        echo '<div class="row candidate-list">';
        echo '<a href="profile.php?id=' . $candidate_list[$i]['id'] . '">';
        //echo '<i class="fa fa-graduation-cap fa-padding" aria-hidden="true"></i>';
        echo '<span class="candidate"><b>' . $candidate_list[$i]['id'] . '</b></span>' .
            '<span class="candidate" style="width:10em">' . $candidate_list[$i]['name'] . '</span>' .
            '<span class="candidate candidate-list-fixed">' . $candidate_list[$i]['job'] . '</span>' .
            '<span class="candidate candidate-list-fixed">' . $candidate_list[$i]['source'] . '</span>' .
            '<span class="candidate candidate-list-fixed"> ' . calculate_age($candidate_list[$i]['birth_date']) . '</span>' .
            '<span class="candidate candidate-list-fixed candidate-status '.$candidate_list[$i]['status_style'] .'">' . $candidate_list[$i]['status'] . '</span>';
        echo '</a></div>';
    }
}else{
    echo '<div class="row candidate-list">';
    echo 'Nothing found, try different filter options';
    echo '</div>';
}
?>



</div>

</body>
</html>