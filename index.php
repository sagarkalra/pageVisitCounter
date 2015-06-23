<?php

/**
 *  A Simple Page Visits Counter
 *
 *  It counts uniques visits on a page of a website. 
 *  It can be scaled to track page visits for the entire website 
 *  assuming we have a unique name defined for every page.
 *
 */

session_start();
$pageName = 'home';
if(!isset($_SESSION['visited']) || $_SESSION['visited'] !== 1) {
    $_SESSION['visited'] = 1;
    $increment = "insert into page_views values('', '$pageName', 1, now(), now()) on duplicate key update counter = counter + 1, updated_at = now();";
    run($increment);
}

$countQuery = "select counter from page_views where page_name = '$pageName'";
$pageViews = run($countQuery);
$visits = $pageViews['counter']; //to display on page

function run($sql) {

    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
    if(! $conn )
    {
      die('Could not connect: ' . mysql_error());
    }

    mysql_select_db('website');
    $retval = mysql_query( $sql, $conn );
    $return = mysql_fetch_array($retval);
    if(! $retval )
    {
      die('Could not get data: ' . mysql_error());
    }
    mysql_close($conn);

    return $return;
}
?>

<!doctype html>
<html>
<head>
    <title>Page Visits</title>
</head>
<body>
    <h1>Welcome to My Random page</h1>
    <h2>Total Visits: <?php echo $visits; ?></h2>
</body>
</html>