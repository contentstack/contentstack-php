<html>
    <head>
        <title>Contentstack PHP SDK</title>
    </head>
    <body>
        <h1>Welcome to Contentstack PHP SDK</h1>
    </body>
</html>
<?php
ini_set('display_errors', 'On');
use Contentstack\Contentstack;
include_once "../src/index.php";
include_once "../src/contentstackregion.php";
   $stack = Contentstack::Stack('', '', '', '');
try {
    // \Contentstack\Utility\debug($stack);
      //  $result = $stack->getContentTypes('{"include_snippet_schema": "false"}'); 
      // $result = $stack->ContentType('first_ct')->Query()->toJSON()->find(); 
     // $result = $stack->ContentType('a')->Fetch();
     // $result = $stack->ContentType('a')->Query()->includeSchema()->toJSON()->find();
      // $result = $stack->ContentType('ctwithallfields')->Query()->addParam('include_dimensions', true)->toJSON()->find();
     //  $result = $stack->ContentType('a')->Entry('blta07130f8b344b260')->includeContentType()->toJSON()->fetch();
      // $result = $stack->Assets()->Query()->addParam('key', 'true')->toJSON()->find();
        //$result = $stack->Assets('blt9b5825dd804a9067')->addParam('include_dimension', 'true')->fetch();
      // \Contentstack\Utility\debug(($result));

} catch(Exception $e) {
    echo "Message : ".$e->getMessage(); // returns message -> API -> error_message
    echo "Code : ".$e->getCode(); // returns number -> API -> error_code
    echo "Errors : ".print_r($e->getErrors()); // returns array -> API -> errors
}
