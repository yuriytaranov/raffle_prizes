<?php 
require "../bootstrap.php";

$response = app("WebApp")->handle();

echo $response->send();