<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link href="css/normalize.css" rel="stylesheet" />
    <link href="css/skeleton.css" rel="stylesheet" />
    <link href="css/style.css?7132016" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet"/>


    <link href='https://fonts.googleapis.com/css?family=Palanquin:300' rel='stylesheet' type='text/css'>
    <title><?php echo $page_name ?></title>

</head>
<body>
<div id="menu">
    <form method="get" class="search-form">
        <input class="search-query" name="search-query" id="search-query" placeholder="Type name" type="text">
        <input class="button-primary" id="search-button" value="Search" type="submit" name="search-submit">
    </form>


    <a href="index.php">
        <div class="menu-in">
            <i class="fa fa-home fa-padding" aria-hidden="true"></i>
            Candidates List
        </div>
    </a>
    <a href="register-candidate.php">
        <div class="menu-in">
            <i class="fa fa-navicon fa-padding" aria-hidden="true"></i>
            Register Candidate
        </div>
    </a>

    <a href="hr-tools.php">
        <div class="menu-in">
            <i class="fa fa-navicon fa-padding" aria-hidden="true"></i>
            HR Tools
        </div>
    </a>

    <a href="settings.php">
        <div class="menu-in">
            <i class="fa fa-navicon fa-padding" aria-hidden="true"></i>
            Settings
        </div>
    </a>

    <a href="users.php">
        <div class="menu-in">
            <i class="fa fa-navicon fa-padding" aria-hidden="true"></i>
            User Management
        </div>
    </a>

    <a href="stats.php">
        <div class="menu-in">
            <i class="fa fa-navicon fa-padding" aria-hidden="true"></i>
            Statistics
        </div>
    </a>

    <a href="logout.php">
        <div class="menu-in">
            <i class="fa fa-sign-out fa-padding" aria-hidden="true"></i>
            Sign out
        </div>
    </a>

</div>
<div class="container">