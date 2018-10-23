<?php
$dbname = 'test_db';
$host = '127.0.0.1';
$username = 'root';
$pwd = 'qwerty';

// phpinfo();
//echo "test<br />";
//
try {
 $dbh = new PDO('mysql:host=$host;dbname=$dbname', $username, $pwd);
 $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 echo "success.";
} catch (PDOException $e) {
 printf("Error: %s", $e->getMessage());
}

//
// include 'TestClass.php';
//
// $nm = "finch";
// $test = new TestClass();
// $test->setName($nm);
// $test->testName();
