<?php
session_start();

require_once('lib/config.php');
require_once('lib/functions.php');
require_once('lib/db-connect.php');
IsAuthorize($_SERVER['REQUEST_URI']);
$page_name = "User Management";


if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['submit-user']) )
{
    $result = save_user($_POST['name'],$_POST['username'],$_POST['password']);
}

?>

<?php
require_once("menu.php");
?>

<?php if (isset($result))echo show_alert($result) ?>

    <div class="box-container">
        <form method="post">
            <div class="row">
                <div class="three columns">
                    <label for="name">Name</label>
                    <input name="name" id="name" placeholder="" type="text" class="u-full-width">
                </div>

                <div class="one columns"></div>

                <div class="three columns">
                    <label for="username">User Name</label>
                    <input name="username" id="name" placeholder="" type="text" class="u-full-width">
                </div>
                <div class="three columns">
                    <label for="password">Password</label>
                    <input name="password" id="password" placeholder="" type="text" class="u-full-width">
                </div>
            </div>
            <div class="row">
                <input class="button-primary" value="Add Users" type="submit" name="submit-user">
            </div>
        </form>
    </div>

    <div class="box-container">
        <div class="row">
            <label for="user_list">User List</label>
            <?php
            $user_list=user_list();
            for($i=0;$i<count($user_list);$i++){
                echo '<div class="row list"><i class="fa fa-info fa-padding" aria-hidden="true"></i>';
                echo $user_list[$i]['name']. "    ";
                echo $user_list[$i]['username'];
                echo '</div>';
            }
            ?>
        </div>
    </div>



</div>
</body>
</html>

