<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
include "config/config.php";

// result per page
$result_per_page=10;

// find out the number of results stored in database
$query="SELECT * FROM users";
$result=mysqli_query($conn,$query);
$number_of_results=mysqli_num_rows($result);

// determine number of total pages available
$number_of_pages=ceil($number_of_results/$result_per_page);


// determine which page number visitor is currently called
if(isset($_GET['page']))
{
    $page=$_GET['page'];
}

else{
    $page=1;
    
}


// determine the sql limit starting number for the result on the display page
$this_page_first_result=($page-1)*$result_per_page;

// retrieve selected results from database and them on page
$query1="SELECT * FROM `users` LIMIT"." ".$this_page_first_result.",".$result_per_page;

$result1=mysqli_query($conn,$query1);


while($row=mysqli_fetch_array($result1))
{
    echo $row['id'].' '.$row['username'].' '.$row['email'].'<br>';
}


// display the link to the pages
for($page=1; $page<=$number_of_pages; $page++)
{
    echo '<a href="index.php?page='.$page.'">'.$page.'</a>';
}
?>
</body>
</html>