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
   $stack = Contentstack::Stack('<API_KEY>', '<ACCESS_TOKEN>', '<ENVIRONMENT>', 'REGION');
try {
    // \Contentstack\Utility\debug($stack);
       //$result = $stack->ContentType('test')->Query()->IncludeReferenceContentTypeUID()->toJSON()->find(); 
       //$result = $stack->ContentType('ctwithallfields')->Query()->includeCount()->toJSON()->find(); 

      //$result = $stack->ContentType('ctwithallfields')->Query()->addParam('include_dimension', 'true')->toJSON()->find();
     // $result = $stack->ContentType('ctwithallfields')->Query()->addParam('include_dimensions', true)->toJSON()->find();
       //$result = $stack->ContentType('ctwithallfields')->Entry('blt8d1ab7600ba4c2b4')->addParam('include_dimensions', true)->toJSON()->fetch();
      // $result = $stack->Assets()->Query()->addParam('***', 'true')->toJSON()->find();
        //$result = $stack->Assets('blt9b5825dd804a9067')->addParam('include_dimension', 'true')->fetch();
    //   \Contentstack\Utility\debug(($result[0]));

} catch(Exception $e) {
    echo "Message : ".$e->getMessage(); // returns message -> API -> error_message
    echo "Code : ".$e->getCode(); // returns number -> API -> error_code
    echo "Errors : ".print_r($e->getErrors()); // returns array -> API -> errors
}
