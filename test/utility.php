<?php
require_once __DIR__.'/constants.php';

if (!function_exists('entriesSorting')) {
    function checkEntriesSorting($entries = array(), $sortKey = 'updated_at', $order = 'desc') {
        $result = true;
        for($i = 0;$i < count($entries) - 1; $i++) {
            if($order === 'desc')
                $result = $result && ($entries[$i][$sortKey] >= $entries[$i+1][$sortKey]);
            else
                $result = $result && ($entries[$i][$sortKey] <= $entries[$i+1][$sortKey]);
        }
        return $result;
    }
}

if (!function_exists('assetsSorting')) {

    function checkAssetsSorting($assets = array(), $sortKey = 'updated_at', $order = 'desc') {
        $result = true;
        for($i = 0;$i < count($assets) - 1; $i++) {
            if($order === 'desc')
                $result = $result && ($assets[$i][$sortKey] >= $assets[$i+1][$sortKey]);
            else
                $result = $result && ($assets[$i][$sortKey] <= $assets[$i+1][$sortKey]);
        }
        return $result;
    }
}

if (!function_exists('sortEntries')) {
    function sortEntries($entries = array(), $sortKey = 'updated_at', $order = 'desc') {
        \Contentstack\Utility\debug(array_column($entries, $sortKey));
        usort($entries, create_function('$a, $b', '
            $a = $a["' . $sortKey . '"];
            $b = $b["' . $sortKey . '"];
    
            if ($a == $b) {
                return 0;
            }
            return ($a ' . ($order == 'desc' ? '>' : '<') .' $b) ? -1 : 1;
        '));
        \Contentstack\Utility\debug(array_column($entries, $sortKey));
    }
}

if (!function_exists('getResultEntries')) {
    function getResultEntries($contentType = '', $index = '', $skip = 0, $limit = 9999) {
        $_result = array();
        $myfile = fopen(RESULT_PATH, "r") or die("Unable to open file!");
        $results = json_decode(fread($myfile, filesize(RESULT_PATH)), true);
        // skip operation
        $_result = array_slice($_result, $skip, $limit);
        if ($index === '')
            $_result = $results['entries.'.$contentType];
        else
            $_result = $results['entries.'.$contentType][$index];
        return $_result;
    }
}
