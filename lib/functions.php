<?php

function save_job($description){

    Global $link;
    $query = "INSERT INTO `jobs` (`description`)
	VALUES ('$description')";

    if  ($link->query($query)){
        //return mysqli_insert_id($link);
        return true;
    }
    else{
        return false; //mysqli_connect_error();
    }
}

function save_user($name,$username,$password){

    Global $link;
    $password = md5($password);
    $query = "INSERT INTO `users` (`name`,`username`,`password`)
	VALUES ('$name','$username','$password')";

    if  ($link->query($query)){
        //return mysqli_insert_id($link);
        return true;
    }
    else{
        return false; //mysqli_connect_error();
    }
}

function save_department($description){

    Global $link;
    $query = "INSERT INTO `departments` (`description`)
	VALUES ('$description')";

    if  ($link->query($query)){
        //return mysqli_insert_id($link);
        return true;
    }
    else{
        return false; //mysqli_connect_error();
    }
}

function save_job_to_department($department,$job){

    Global $link;
    $query = "INSERT INTO `jobs_to_departments` (`department`,`job`)
	VALUES ('$department','$job')";

    if  ($link->query($query)){
        //return mysqli_insert_id($link);
        return true;
    }
    else{
        return false; //mysqli_connect_error();
    }
}

function save_source($description){
    Global $link;
    $query = "INSERT INTO `sources` (`description`)
	VALUES ('$description')";

    if  ($link->query($query)){
        //return mysqli_insert_id($link);
        return true;
    }
    else{
        return false; //mysqli_connect_error();
    }
}

function save_status($description){
    Global $link;
    $query = "INSERT INTO `status` (`description`)
	VALUES ('$description')";

    if  ($link->query($query)){
        //return mysqli_insert_id($link);
        return true;
    }
    else{
        return false; //mysqli_connect_error();
    }
}

function save_candidate($name,$birth_date,$job,$source,$resume_path,$profile){
    Global $link;
    $create_date = date('Y/m/d h:i:s');

    $query = "INSERT INTO `candidates` (`name`,`birth_date`,`job`,`source`,`resume_path`,`profile`,`create_date`)
	VALUES ('$name','$birth_date','$job','$source','$resume_path','$profile','$create_date')";

    if  ($link->query($query)){
        //return mysqli_insert_id($link);
        return true;
    }
    else{
        return false; //mysqli_connect_error();
    }
}

function save_action($candidate_id,$comment,$created_by,$status_id){
    Global $link;
    $created_date = date('Y/m/d h:i:s');
    $query = "INSERT INTO `candidate_history` (`candidate_id`,`comment`,`created_by`,`created_date`,`status_id`)
	VALUES ('$candidate_id','$comment','$created_by','$created_date','$status_id')";

    if  ($link->query($query)){
        //return mysqli_insert_id($link);
        return true;
    }
    else{
        return false; //mysqli_connect_error();
    }
}

function show_alert($status){
    if ($status) {
        return '
            <div class="alert">
                <img src="images/animat-checkmark-color.gif" class="gif-success"/>
                <p class="alert-text">New Record Added!</p>
            </div>
        ';
    }
    else{
         return '
            <div class="alert">
                <img src="images/animat-pencil-color.gif" class="gif-success"/>
                <p class="alert-text">Something goes wrong, try again please.</p>
            </div>
        ';
        }
    }

function job_list(){
    Global $link;
    $result = $link->query("SELECT  * FROM  `jobs`");
    while ($row = $result->fetch_assoc()) {
        $jobs[]= $row;
    }
    return $jobs;
}

function user_list(){
    Global $link;
    $result = $link->query("SELECT  * FROM  `users`");
    while ($row = $result->fetch_assoc()) {
        $users[]= $row;
    }
    return $users;
}

function job_to_department_list(){
    Global $link;
    $result = $link->query("SELECT `departments`.`description` as department, `jobs`.`description` as job  FROM `jobs_to_departments`
left join `jobs` on `jobs`.`id` = `jobs_to_departments`.`job`
left join `departments` on `departments`.`id` = `jobs_to_departments`.`department`");
    while ($row = $result->fetch_assoc()) {
        $job_to_department[]= $row;
    }
    return $job_to_department;
}

function department_list(){
    Global $link;
    $result = $link->query("SELECT  * FROM  `departments`");
    while ($row = $result->fetch_assoc()) {
        $departments[]= $row;
    }
    return $departments;
}

function source_list(){
    Global $link;
    $result = $link->query("SELECT  * FROM  `sources`");
    while ($row = $result->fetch_assoc()) {
        $jobs[]= $row;
    }
    return $jobs;
}

function status_list(){
    Global $link;
    $result = $link->query("SELECT  * FROM  `status`");
    while ($row = $result->fetch_assoc()) {
       $status[]= $row;
    }
    return $status;
}

function candidate_list_bo_department($department_id){
    Global $link;
    $result = $link->query("SELECT `candidates`.`id`,`name`,`birth_date`,`profile`,`resume_path`,`jobs`.`description` as job , `sources`.`description` as `source` FROM `candidates` right join `jobs` on `jobs`.`id` = `candidates`.`job` right join `sources` on `sources`.`id` = `candidates`.`source` where `candidates`.`job` in (SELECT `job` FROM `jobs_to_departments` where `department` = $department_id) order by `create_date` DESC ");
    while ($row = $result->fetch_assoc()) {
        $candidates[] = $row;
    }
    return $candidates;
}

function candidate_list_bo_filter($job_id,$source_id,$status_id){
    Global $link;
    $database_model = array('`jobs`.`id`','`sources`.`id`','`status`.`id`');
    $arg_list = func_get_args();
    $where_clause =' where ';
    $where_clause_updated = false;
    $query = "SELECT `candidates`.`id`,`name`,`birth_date`,`profile`,`resume_path`,`jobs`.`description` as job , `sources`.`description` as `source` , `status`.`description` as `status` , `status`.`color_style` as `status_style`
FROM `candidates`
right join `jobs` on `jobs`.`id` = `candidates`.`job`
right join `sources` on `sources`.`id` = `candidates`.`source`
inner join `status` on `status`.`id` = `candidates`.`status_id`";

    // build where clause
    for($i=0;$i<count($database_model);$i++) {
        if ($arg_list[$i] != "All" and !empty($arg_list[$i])) {
            if($where_clause_updated) $where_clause = $where_clause." and ";
            $where_clause = $where_clause .$database_model[$i]." = '$arg_list[$i]' ";
            $where_clause_updated = true;
        }
    }
    // add where clause to query and check if its not empty
    if(strlen($where_clause) > 9) $query = $query.$where_clause;

    //order
    $query = $query." order by `candidates`.`id` DESC";

    $result = $link->query($query);
    if($result){
        while ($row = $result->fetch_assoc()) {
            $candidates[] = $row;
        }
        return $candidates;
    }else{ // no result found for this query
        return false;
    }
}

function candidate_list_bo_search($name){
    Global $link;
    $query = "SELECT `candidates`.`id`,`name`,`birth_date`,`profile`,`resume_path`,`jobs`.`description` as job , `sources`.`description` as `source` , `status`.`description` as `status` , `status`.`color_style` as `status_style`
FROM `candidates`
right join `jobs` on `jobs`.`id` = `candidates`.`job`
right join `sources` on `sources`.`id` = `candidates`.`source`
inner join `status` on `status`.`id` = `candidates`.`status_id` where `name` like '%$name%'";

    //order
    $query = $query." order by `candidates`.`id` DESC";

    $result = $link->query($query);
    if($result){
        while ($row = $result->fetch_assoc()) {
            $candidates[] = $row;
        }
        return $candidates;
    }else{ // no result found for this query
        return false;
    }
}




function candidate_history($candidate_id){
    Global $link;
    $result = $link->query("select `comment`,`name`,`status`.`description`,`created_date` from `candidate_history`
left join `users` on `users`.`user_id` = `candidate_history`.`created_by`
left join `status` on `status`.`id` = `candidate_history`.`status_id`
where `candidate_id` = '$candidate_id' order by `created_date` ASC");
    while ($row = $result->fetch_assoc()) {
        $history[]= $row;
    }
    if (!empty($history)){
        return $history;
    }

}

function department_name($department_id){
    Global $link;
    $result = $link->query("SELECT  `description` FROM  `departments` where `id`= $department_id");
    $department = $result->fetch_assoc();
    return $department;
}

function status_name($status_id){
    Global $link;
    $result = $link->query("SELECT  `description` FROM  `status` where `id`= $status_id");
    $description = $result->fetch_assoc();
    return $description;
}

function status_style($status_id){
    Global $link;
    $result = $link->query("SELECT  `color_style` FROM  `status` where `id`= $status_id");
    $description = $result->fetch_assoc();
    return $description;
}

function candidate_profile($id){
    Global $link;
    $result = $link->query("SELECT `candidates`.`id`,`name`,`birth_date`,`profile`,`resume_path`,`jobs`.`description` as job , `sources`.`description` as `source`, `candidates`.`create_date`, `candidates`.`status_id` FROM `candidates` right join `jobs` on `jobs`.`id` = `candidates`.`job` right join `sources` on `sources`.`id` = `candidates`.`source` where `candidates`.`id`='$id'");
    $row = $result->fetch_assoc();
    return $row;
}

function upload_file($file,$upload_folder){
    require_once('class.upload.php');

    $handle = new Upload($file);
    if ($handle->uploaded) {
        $handle->file_new_name_body = uniqid();
        $handle->process($upload_folder);
        if ($handle->processed) {
            $image_uri =$upload_folder."/".$handle->file_dst_name_body.".".$handle->file_dst_name_ext;
            $handle->clean();
        } else {
            //return false;
            echo 'error : ' . $handle->error;
            die();
        }
    }else{
        echo 'error : ' . $handle->error;
        die();
    }
    return $image_uri;
}

function update_status($id,$status_id){

    Global $link;
    $query ="UPDATE `candidates`
	SET `status_id` = '$status_id' WHERE `id` = '$id'";

    if  ($link->query($query)){
        return true;
    }
    else{
        return false; //mysqli_connect_error();
    }
}

function is_option_selected($item_id,$selected_id){
    if ($item_id ==$selected_id) return "selected";
}

function user_info($username){
    Global $link;
    $query = "SELECT  * FROM  `users` where `username`= '$username'";
    $result = $link->query($query);
    while ($row = $result->fetch_assoc()) {
        $users[]= $row;
    }
    if (!empty($users))return $users;
}

function IsPasswordCorrect($username,$password){
    $user_info = user_info($username);
    if (md5($password) == $user_info[0]['password']) {
        return true;
    }else{
        return false;
    }
}

function Authorize($user_id){
    session_start();
    $_SESSION['authorize'] = 'true';
    $_SESSION['user_id'] = $user_id;
}

function IsAuthorize($REQUEST_URI){
    if (isset($_SESSION['authorize']) and ($_SESSION['authorize'] == 'true')){
        return true;
    }else{
        header("location: login.php?url=".$REQUEST_URI);
        die();
    }
}

function calculate_age($birth_date){
    //create jalali date
    require_once("lib/jdatetime.class.php");
    $date = new jDateTime(true, true, 'Asia/Tehran');
    $current_year =  $date->date("Y", false, false);
    $birth_year = explode("-",$birth_date);
    $age = intval($current_year) - intval($birth_year[0]);

    if ($age > 0 and $age < 1300) return $age;
    return 0;
}

function get_candidate($id){

    Global $link;
    $result = $link->query("SELECT * FROM `candidates` where `id` = '$id'");
    $row = $result->fetch_assoc();
    return $row;
}

function stat_job_status($job_id,$status_id){

    Global $link;
    $query = "SELECT count(*) as total FROM `candidates` where `status_id` = '$status_id' and `job` = '$job_id'";
    $result = $link->query($query);
    $row = $result->fetch_assoc();
    if(empty($row)) $row['total'] = 0;
    return $row['total'];
}

function stat_job_description_total(){
    Global $link;
    $query = "SELECT count(`job`) as total, `jobs`.`description` as jobdesc FROM `candidates` left join `jobs` on `jobs`.`id` = `candidates`.`job` group by `job` ";
    $result = $link->query($query);
    while ($row = $result->fetch_assoc()) {
        $rows[]= $row;
    }
    $result = array();
    for ($i = 0;$i < count($rows);$i++){
        $temp = $rows[$i]['jobdesc'];
        $result[$temp] = $rows[$i]['total'];
    }
    return $result;
}

function stat_job_total(){

    Global $link;
    $query = "SELECT count(`job`) as total, `job` as job FROM `candidates` group by `job` ";
    $result = $link->query($query);
    while ($row = $result->fetch_assoc()) {
        $rows[]= $row;
    }
    $result = array();
    for ($i = 0;$i < count($rows);$i++){
        $temp = $rows[$i]['job'];
        $result[$temp] = $rows[$i]['total'];
    }
    return $result;
}

function stat_job($job_id){
    $status_list = status_list();
    $result = array();
    for($i=0;$i<count($status_list);$i++){
        $temp = stat_job_status($job_id,$status_list[$i]['id']);
        $associative_index = $status_list[$i]['description'];
        $result[$associative_index] = $temp;
    }

    $temp = stat_job_total();
    $result['total'] = $temp[$job_id];

return $result;
}

function stat_source_status($source_id,$status_id){

    Global $link;
    $query = "SELECT count(*) as total FROM `candidates` where `source` = '$source_id' and `status_id` = '$status_id'";
    $result = $link->query($query);
    $row = $result->fetch_assoc();
    if(empty($row)) $row['total'] = 0;
    return $row['total'];
}

function stat_source_total(){

    Global $link;
    $query = "SELECT count(`source`) as total, `source` as source FROM `candidates` group by `source` ";
    $result = $link->query($query);
    while ($row = $result->fetch_assoc()) {
        $rows[]= $row;
    }
    $result = array();
    for ($i = 0;$i < count($rows);$i++){
        $temp = $rows[$i]['source'];
        $result[$temp] = $rows[$i]['total'];
    }
    return $result;
}

function stat_source($source_id){
    $status_list = status_list();
    $result = array();
    for($i=0;$i<count($status_list);$i++){
        $temp = stat_source_status($source_id,$status_list[$i]['id']);
        $associative_index = $status_list[$i]['description'];
        $result[$associative_index] = $temp;
    }

    $temp = stat_source_total();
    $result['total'] = $temp[$source_id];

    return $result;
}

function update_profile($id, $name, $birth_date, $job,$source, $profile){

    Global $link;
    $query ="UPDATE `candidates` SET `name`='$name',`birth_date`='$birth_date',`job`='$job',`source`='$source',`profile`='$profile' WHERE `id` = '$id'";
    if  ($link->query($query)){
        return true;
    }
    else{
        return false; //mysqli_connect_error();
    }
}