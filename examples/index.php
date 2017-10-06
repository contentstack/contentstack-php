<html>
    <head>
        <title>Built.io Contentstack PHP SDK</title>
    </head>
    <body>
        <h1>Welcome to Contentstack PHP SDK</h1>
    </body>
</html>
<?php
ini_set('display_errors', 'On');

use Contentstack\Contentstack;
include_once "../src/index.php";



$stack = Contentstack::Stack('blt6fe3ebcc41393d87', 'blt1e73caa94ad25d4b', 'mobile');
try {

    //$result = $stack->ContentType('authors')->Query()->toJSON()->includeCount()->find();
    // $result = $stack->ContentType('authors')->Entry('blte58928ca56939985')->fetch();
   // \Contentstack\Utility\debug($result);

     //$result = $stack->Asset('blt20a90a9d5b9c6802')->toJSON()->fetch();
   // \Contentstack\Utility\debug($result->getTitle());


} catch(Exception $e) {
    echo "Message : ".$e->getMessage(); // returns message -> API -> error_message
    echo "Code : ".$e->getCode(); // returns number -> API -> error_code
    echo "Errors : ".print_r($e->getErrors()); // returns array -> API -> errors
}