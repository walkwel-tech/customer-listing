<?php

// Required functions
function __autoload($class_name)
{
    $class_name = strtolower($class_name);
    $path       = LIB_PATH . DS . "{$class_name}.php";
    if (file_exists($path)) {
        require_once $path;
    } else {
        die("The file {$class_name}.php could not be found.");
    }
}

function redirectTo($location = null)
{
    if ($location != null) {
        if (empty($location)) {
            $location = "index.php";
        }
        if (!headers_sent()) {
            header("Location: {$location}");
        }
        exit;
    }
}

// HTML Functions
function includeLayoutTemplate($template = "")
{
    include SITE_ROOT . DS . 'layouts' . DS . $template;
}

function stripZerosFromDate($marked_string = "")
{
    // remove marked zeros
    $no_zeros = str_replace("*0", "", $marked_string);

    // remove remaining marks
    $cleaned_string = str_replace("*", "", $no_zeros);

    return $cleaned_string;
}

function getAllTables()
{
    global $database;
    $result_set      = $database->query("show tables");
    $database_tables = [];
    while ($table_detail = mysqli_fetch_array($result_set)) {
        $database_tables[$table_detail[0]] = getTableDetails($table_detail[0]);
    }

    return $database_tables;
}

function getTableDetails($table_name)
{
    global $database;
    $table_result = $database->query("show columns from {$table_name}");
    while ($col = mysqli_fetch_assoc($table_result)) {
        $column[$col["Field"]] = $col["Type"];
    }

    return $column;
}


function getRandomString($length = 8, $multiCaps = true, $includeNumbers = false)
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    if ($multiCaps) {
        $characters = $characters . 'abcdefghijklmnopqrstuvwxyz';
    }

    if($includeNumbers) {
        $characters = '0123456789' . $characters;
    }

    $string = '';

    for ($i = 0; $i < $length; $i++) {
        $string .= $characters[mt_rand(0, strlen($characters) - 1)];
    }

    return $string;
}


function pageQuery($page)
{
    $limit = (isset($_GET['limit'])) ? $_GET['limit'] : 10;

    $query = "limit={$limit}";
    $query .= "&page={$page}";

    return '?' . $query;
}
