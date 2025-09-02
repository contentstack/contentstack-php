<?php
namespace Contentstack\Error;

/**
 * Class ErrorMessages
 * Contains all error messages used across the SDK
 * 
 * @category PHP
 * @package  Contentstack
 * @author   Contentstack <support@contentstack.com>
 * @license  https://github.com/contentstack/contentstack-php/blob/master/LICENSE.txt MIT Licence
 * @link     https://www.contentstack.com/docs/platforms/php/
 */
class ErrorMessages
{
    // BaseQuery.php error messages
    const FIELD_UIDS_ARRAY = 'Field UIDs must be an array. Convert the value to an array and try again.';
    const TAGS_ARRAY = 'Tags must be an array. Convert the value to an array and try again.';
    const VALUE_ARRAY = 'Value must be an array. Convert the value to an array and try again.';
    const INVALID_QUERY = 'Invalid query. Update the query and try again.';

    // helper.php error messages
    const INVALID_STRING_INPUT = 'Invalid input for "%s". Use a string value and try again.';
    const INVALID_INCLUDE_REFERENCES = 'Invalid input for includeReferences. Use an array and try again.';
    const INVALID_INPUT_TYPE = 'Invalid input. Use a string or an array and try again.';
    const INVALID_REGEX_KEY_VALUE = 'Invalid input for regex. Use a string for the key and a valid regular expression for the value.';
    const INVALID_REGEX_OPTIONS = 'Invalid regex options. Provide valid options and try again.';
    const INVALID_REGEX_ARGS = 'Invalid input for regex. Provide 2 or 3 arguments and try again.';
    const INVALID_TAGS_INPUT = 'Invalid input for tags. Use a valid array of tags and try again.';
    const INVALID_KEY_VALUE = 'Invalid input for "%s". Use a string for the key and a valid value, then try again.';
    const INVALID_QUERY_INPUT = 'Invalid input for "%s". Provide at least one query and try again.';
    const INVALID_QUERY_OBJECTS = 'Invalid input. Query objects are expected as arguments. Update the input and try again.';
    const INVALID_KEY_ARRAY_VALUE = 'Invalid input for "%s". Use a string for the key and an array for the value, then try again.';
    const INVALID_NUMERIC_INPUT = 'Invalid input for "%s". Use a numeric value and try again.';
    const INVALID_FIELD_INPUT = 'Invalid input for "%s". Use a valid field from the entry and try again.';
    const INVALID_FIELD_UID = 'Invalid input for "%s". Use a valid string field UID and try again.';

    /**
     * Format error message with function name
     *
     * @param string $message The message template containing %s placeholder
     * @param string $functionName The function name to insert
     * 
     * @return string Formatted error message
     */
    public static function formatMessage($message, $functionName = '')
    {
        return sprintf($message, $functionName);
    }
}
