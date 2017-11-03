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

  $stack = Contentstack::Stack('<<API-KEY>>', '<<Access-TOKEN>>', '<<ENVIRONMENT>>');

try {

     //$result = $stack->ContentType('authors')->Query()->toJSON()->includeCount()->find();
     //$result = $stack->ContentType('authors')->Entry('')->toJSON()->fetch();
   // \Contentstack\Utility\debug($result);
    $result = $stack->Assets('')->fetch();
    //$data   = $result->get('url');
    //$result = $stack->ImageTrasform($data, array('height'=> 100, 'weight'=> 100, 'disable' => 'upscale'));
    \Contentstack\Utility\debug($result);


} catch(Exception $e) {
    echo "Message : ".$e->getMessage(); // returns message -> API -> error_message
    echo "Code : ".$e->getCode(); // returns number -> API -> error_code
    echo "Errors : ".print_r($e->getErrors()); // returns array -> API -> errors
}