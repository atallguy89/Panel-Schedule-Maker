<?php
################################################################
#              Scripted by: Will Haggerty                      #
#                  January 13, 2013                            #
#            Please leave this comment intact                  #
################################################################
require('config.php');

$con = mysqli_connect($server['server'],$server['username'],$server['password'],$server['database']);
if (!$con) {
 die('Could not connect: ' . mysqli_error());
}
#mysqli_select_db($server['database'], $con);

$result = mysqli_query($con,"SELECT `index`, `job_name` FROM `job` ORDER BY `index` DESC");
$storeArray = Array();
while ($row = mysqli_fetch_array($result)) {
 $storeArray[] = $row;
}

mysqli_close($con);

?>
<!doctype html>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Make new panel</title>
<style type="text/css">
.top {
 border: 2px black solid;
 padding: 1px 4px 1px 4px;
 font-size: 16px;
}
.left {
 text-align: left;
}
.right {
 text-align: right;
}
.numbers {
 border: 1px black solid;
 text-align: center;
 font-weight: bold;
 font-size: 15px;
}
.spacer {
}
.circuit {
 border: 1px black solid;
 padding: 1px 4px 1px 4px;
 font-size: 14px;
}
.job-list {
 min-width: 200px;
 height: 100px;
}
.no-border {
 border: 0px white solid;
}
</style>
</head>

<body>
<h1>Adding</h1>
<form name='add_panel' action='enter.php' method='post'>
<fieldset class='no-border'>
<p>Please enter the job name</p>
<input type='text' name='job_name' tabindex='1' required>
<p>Or select one from the list:</p>
<select name='job-list' class='job-list' size='2' onclick="var s = this.form.elements['job-list'];
    this.form.elements['job_name'].value = s.options[s.selectedIndex].textContent" <?php if (empty($storeArray)) {echo "disabled";} ?>>
<?php
if (!empty($storeArray)) {
foreach ($storeArray as $value) {echo "<option value='$value[index]'>$value[job_name]</option>";}
} else {echo "<option> No jobs in database</option>";}
?>
</select>
</fieldset>
<fieldset class='no-border'>
<p>Number of circuits: <input type='text' name='num_cct' size='5' required tabindex='4'></p>
</fieldset>
<input style='width: 250px;' type='submit' tabindex='5'>
</form>
<p><a href='view.php'>View</a> or <a href='edit.php'>Edit</a> a panel</p>
</body>
</html>
