<?php
require '../vendor/autoload.php';
$app=new \Slim\App();

$app->get('/',function($request,$response,$args){
    $host="localhost";
       $db="fifa";
       $dsn= "mysql:host=$host;dbname=$db";
       $conn=new mysqli();
       $conn=new mysqli($host,"root","",$db);
       if($conn->connect_error){
         die("Connection failed: " . $conn->connect_error);
         echo "failed";
       }
     //  echo $username."  ".$pwd;
     //  echo $conn;
       $query="SELECT * FROM `TABLE 1` ";



       try{
        $f_array=array();
        // $result=$conn->query($query);
         //$res_array=mysqli_fetch_assoc($result);
        // $response->write("Hello APIs");
        $result=$conn->query($query);
       // return $response->withJson($result);
        if ($result->num_rows > 0) {
            //$response->getBody()->write(print_r($result , true));
            while($row = $result->fetch_assoc()) {
              array_push($f_array,$row);
            }
        }
        return $response->withJson($f_array);

       
        }  
        catch(Exception $e){
            echo "error is".$e;
        }
});
$app->run();
?>