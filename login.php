<?php
require_once('lib/config.php');
require_once('lib/functions.php');
require_once('lib/db-connect.php');
$page_name = "Login";


if (isset($_POST['submit-login'])){
    if (IsPasswordCorrect($_POST['username'],$_POST['password'])){
        $user_info = user_info($_POST['username']);
        Authorize($user_info[0]['user_id']);

        if (empty($_GET['url']) or !isset($_GET['url']))$url = "./";
        else $url = $_GET['url'];
        header("location:".$url);

    }else{
        $result = false;
    }
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
                <label for="username">Username</label>
                <input name="username" id="username" placeholder="" type="text" class="u-full-width">
            </div>

            <div class="one columns"></div>

            <div class="three columns">
                <label for="password">Password</label>
                <input name="password" id="password" placeholder="" type="password" class="u-full-width">
            </div>
        </div>
        <div class="row">
            <input class="button-primary" value="Login" type="submit" name="submit-login">
        </div>
    </form>
</div>

</body>
</html>
