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



$stack = Contentstack::Stack('<<API_KEY>>', '<<Access_Token>>', '<<Environment>>');
try {
    /*$result = $stack->ContentType('authors')->Query()->toJSON()->includeCount()->find();
    \Contentstack\Utility\debug($result);*/


} catch(Exception $e) {
    echo "Message : ".$e->getMessage(); // returns message -> API -> error_message
    echo "Code : ".$e->getCode(); // returns number -> API -> error_code
    echo "Errors : ".print_r($e->getErrors()); // returns array -> API -> errors
}