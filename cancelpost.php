<?php
    require_once "conndb.php";
    session_start();
    $status = "";
    
    if(isset($_POST['update']))
    {
        $id = $_REQUEST['radio'];
        $_SESSION['id']=$id;
        if($id){
            header("Location: update.php");
        }
    }
    
    
    if(isset($_POST['submit']))
    {
        $id = $_REQUEST['radio'];
        $username = $_SESSION["username"]; //
        $del_query = "DELETE FROM book_user WHERE book_id=$id";
        if(mysqli_query($conn, $del_query))
        {
            $query = "DELETE FROM Ride WHERE ride_id = $id";
            
            if(mysqli_query($conn, $query))
            {
                $status = "Ride cancelled successfully.
                </br></br><a href='view.php'>View Posted Ride</a>";
            }
            
        }
    }
    
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style.css" />
<title>Ride History</title>
<style>
input[type=submit], input[type=update]{
    background-color: #008CBA;
    border: none;
    border-radius: 10px;
    color: white;
    padding: 10px 22px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
}
</style>
</head>
<body>
<div class="form">
<ul>
<li><a href="home.php">PickMeUp</a></li>
<li><a href="home.php">Home</a></li>
<li><a href="view.php">Book a Ride</a></li>
<li><a href="history.php">My Booked Ride</a></li>
<li><a href="post.php">Post a Ride</a></li>
<li><a href="cancelpost.php">My Posted Ride</a></li>
<li style="float:right"><a href="logout.php">Logout</a></li>
</ul>
<h1><p align="center">My Posted Rides</p></h1>
<br>
<table width="100%" border="1" style="border-collapse:collapse;", name="table">
<thead>
<tr>
<th><strong>Ride Id</strong></th>
<th><strong>Posted By</strong></th>
<th><strong>From City</strong></th>
<th><strong>To City</strong></th>
<th><strong>Car Make</strong></th>
<th><strong>Car Model</strong></th>
<th><strong>Cost</strong></th>
<th><strong>Travel Date</strong></th>
<th><strong>Select</strong></th>
</tr>
</thead>
<?php
    $username = $_SESSION["username"];
    $count=1;
    $sel_query="SELECT * FROM Ride r WHERE r.name_user='".$username ."';";
    $result = mysqli_query($conn,$sel_query);
    while($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td align="center"><?php echo $row["ride_id"]; ?></td>
        <td align="center"><?php echo $row["name_user"]; ?></td>
        <td align="center"><?php echo $row["source"]; ?></td>
        <td align="center"><?php echo $row["destination"]; ?></td>
        <td align="center"><?php echo $row["car_make"]; ?></td>
        <td align="center"><?php echo $row["car_model"]; ?></td>
        <td align="center"><?php echo $row["cost"]; ?></td>
        <td align="center"><?php echo $row["start_date"]; ?></td>
        <form name="form" method="post" action="">
        <td align="center"><label><input type="radio" name="radio" value="<?php echo $row["ride_id"]; ?>"></label></td>
    </tr>
<?php $count++; } ?>
</tbody>
</table>
<p align="center"><input name="submit" type="submit" value="Cancel this Ride" /><input name="update" type="submit" value="Update this Ride" /></p>
</form>
<p align="center" style="color:#FF0000;"><?php echo $status; ?></p>
</div>
</body>
</html>

