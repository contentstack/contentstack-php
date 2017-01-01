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

$stack = Contentstack::Stack('API_KEY', 'ACCESS_TOKEN', 'ENV_NAME');

$result = $stack->ContentType('content_type_uid')->Query()->toJSON()->includeCount()->find();
\Contentstack\Utility\debug($result);

$result = $stack->ContentType('content_type_uid')->Entry('blt12345678901')->fetch();
\Contentstack\Utility\debug($result);

$result = $stack->ContentType('content_type_uid')->Query()->toJSON()->findOne();
\Contentstack\Utility\debug($result);

$result = $stack->getLastActivities();
\Contentstack\Utility\debug($result);