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
include_once "../lib/index.php";



$stack = Contentstack::Stack('<<API_KEY>>', '<<Access_Token>>', '<<Environment>>');
try {
   /* $result = $stack->ContentType('authors')->Query()->toJSON()->includeCount()->find();
    \Contentstack\Utility\debug($result);*/

    /*$result = $stack->ContentType('authors')->Query()->toJSON()->includeCount()->find();
    \Contentstack\Utility\debug($result);*/

    //$result = $stack->ContentType('authors')->Entry('blte58928ca56939985')->get->fetch();
   // \Contentstack\Utility\debug($result);

      //$result1 = $stack->Assets()->QueryAssets()->toJSON()->includeCount()->includeRelativeUrl()->descending('created_at')->find();
      //$result1 = $stack->Asset('blt097c07eac301a3e3')->fetch();
    /*$result = $stack->Asset('blt6ad28f3942494947')->fetch();
      \Contentstack\Utility\geturl($result);*/
    /*\Contentstack\Utility\debug($result1->set('update_value', "hello"));*/
    // \Contentstack\Utility\debug($result1->getLocale());
      //\Contentstack\Utility\debug($result1);
    //$data   = $result->geturl();
   // \Contentstack\Utility\debug(gettype($result1));
    //print_r(array_values($result));
   /* $result = $stack->ContentType('event_list')->Query()->toJSON()->language('en-us')->find();
    \Contentstack\Utility\debug($result);*/

    /* $result = $stack->ContentType('event_list')->Query()->toJSON()->skip(32)->find();
    \Contentstack\Utility\debug($result);*/

     /*$result = $stack->ContentType('event_list')->Query()->toJSON()->assets()->includeCount()->find();
     \Contentstack\Utility\debug($result[0]);*/
        
        /*foreach($array as $key => $value)
        {
          echo $key." has the value". $value;
        }
*/
    /*echo 'This variable is not an object, it is a/an ' . gettype($result);*/ 


/*
    $result = $stack->getLastActivities();
    \Contentstack\Utility\debug($result);*/


} catch(Exception $e) {
    echo "Message : ".$e->getMessage(); // returns message -> API -> error_message
    echo "Code : ".$e->getCode(); // returns number -> API -> error_code
    echo "Errors : ".print_r($e->getErrors()); // returns array -> API -> errors
}