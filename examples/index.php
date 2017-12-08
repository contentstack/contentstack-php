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
   $stack = Contentstack::Stack('<API-KEY>', '<ACCESS-TOKEN>', '<ENVIRONMENT>');
try {
       //$result = $stack->ContentType('ctwithallfields')->Query()->addParam('include_dimensions', 'true')->toJSON()->find(); 
      //$result = $stack->ContentType('ctwithallfields')->Query()->addParam('include_dimension', 'true')->toJSON()->find();
      //$result = $stack->ContentType('ctwithallfields')->Query()->includeCount('include_dimensions', true)->toJSON()->find();
       //$result = $stack->ContentType('ctwithallfields')->Entry('blt8d1ab7600ba4c2b4')->addParam('include_dimensions', true)->toJSON()->fetch();
        //$result = $stack->Assets('blt9b5825dd804a9067')->addParam('include_dimension', 'true')->toJSON()->fetch();
    // \Contentstack\Utility\debug(($result));
} catch(Exception $e) {
    echo "Message : ".$e->getMessage(); // returns message -> API -> error_message
    echo "Code : ".$e->getCode(); // returns number -> API -> error_code
    echo "Errors : ".print_r($e->getErrors()); // returns array -> API -> errors
}
