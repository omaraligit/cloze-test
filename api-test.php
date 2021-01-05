<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 1/4/2021
 * Time: 9:10 PM
 */

include "database.php";
$_POST = json_decode(file_get_contents("php://input"),true);

if (isset($_POST["test_text"])){
    // set response header as json as the respons is a api json data
    header('Content-Type: application/json');
    // getting the data from request
    $test_text = $_POST["test_text"];
    $missing_words = json_encode($_POST["missing_words"]);
    $test_words_count = $_POST["test_words_count"];
    $date_start = $_POST["date_start"];
    $date_end = $_POST["date_end"];
    // saving the data to the database
    $res = newTest($test_text,$missing_words,$date_start,$date_end,$test_words_count);
    // returning the response
    if ($res == false){
        header("HTTP/1.1 404 Not Found");
        echo json_encode([
            "error"=>"somthing went wrong please try again"
        ]);
    }else{
        echo json_encode([
            "id"=>$res,
            "test_text" =>$test_text,
            "missing_words" =>json_decode($missing_words),
            "test_words_count" =>$test_words_count,
            "date_start" =>$date_start,
            "date_end" =>$date_end,
        ]);
    }
}

// --------------------
// getting saved tests to show on admin page
// --------------------

if (isset($_POST["getTests"])){
    // set response header as json as the respons is a api json data
    header('Content-Type: application/json');
    // getting the data from database
    $tests = getAllTests();
    echo json_encode($tests);
}

// --------------------
// deleting a test
// --------------------

if (isset($_POST["deleteTest"])){
    // set response header as json as the respons is a api json data
    header('Content-Type: application/json');
    // deliting the test from db
    $res = deleteTest($_POST["deleteTest"]);
    echo json_encode($res);
}
die();
exit();

?>

