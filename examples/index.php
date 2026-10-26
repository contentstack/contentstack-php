<html>
    <head>
        <title>Contentstack PHP SDK</title>
    </head>
    <body>
        <h1>Welcome to Contentstack PHP SDK</h1>
    </body>
</html>
<?php
ini_set('display_errors', 'Off');
require_once __DIR__ . '/../src/contentstack.php';

use Contentstack\Contentstack;
use Contentstack\Support\Utility;

   $stack = Contentstack::Stack('', '', '');
try {
    // \Contentstack\Utility\debug($stack);
      //  $result = $stack->getContentTypes('{"include_snippet_schema": "false"}'); 
      // $result = $stack->ContentType('first_ct')->Query()->toJSON()->find(); 
     // $result = $stack->ContentType('a')->Fetch();
     // $result = $stack->ContentType('a')->Query()->includeSchema()->toJSON()->find();
      // $result = $stack->ContentType('ctwithallfields')->Query()->addParam('include_dimensions', true)->toJSON()->find();
     //  $result = $stack->ContentType('a')->Entry('blta07130f8b344b260')->includeContentType()->toJSON()->fetch();
      $result = $stack->Assets()->Query()->includeFallback()->toJSON()->find();
        //$result = $stack->Assets('blt9b5825dd804a9067')->addParam('include_dimension', 'true')->fetch();
      Utility::debug(($result));

} catch(Exception $e) {
    // Log the details server-side; never echo them to the client.
    error_log("Message : ".$e->getMessage()); // returns message -> API -> error_message
    error_log("Code : ".$e->getCode()); // returns number -> API -> error_code
    error_log("Errors : ".print_r($e->getErrors(), true)); // returns array -> API -> errors
    echo "The request failed. See the server log for details.";
}
