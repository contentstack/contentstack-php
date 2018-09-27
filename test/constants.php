<?php

define('ENV', 'TEST_LOCAL');
define('RESULT_PATH', __DIR__.'/result.json');

// For Auth into CS during tests
define('EMAIL_ID', "Your Email");
define('PASSWORD', "Your CS Password");

// how many entries we want to create
define('ENTRY_COUNT', 10);
define('REF_ENTRY_COUNT', 2);
define('LIMIT_ENTRY_COUNT', 10);

// fpr query test params
define('CT_REF', 'reference');
define('CT_ContentType', 'ctwithallfields');
