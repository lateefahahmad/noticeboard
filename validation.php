<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "noticeboard";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if(!$connection) {
    die("Connection failed".$mysqli_connect_error);
}

// Things to notice:
// This script holds the validation functions that double-check our user data is valid
// These are the email and DOB validation left as a lab exercise

// if the data is valid return an empty string, if the data is invalid return a help message



// if the data is valid return an empty string, if the data is invalid return a help message
function validateEmail($email)
{
    // Remove all illegal characters from email
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    // Check to see if the email address conforms to the expected format
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // data was valid, return an empty string:
                return "";
    }

    else {
        return "Email address is not valid ";
    }

}

// function to sanitise (clean) user data:
function sanitise($str, $connection)
{

/* get_magic_quotes_gpc REMOVED from PHP 8 onwards
    if (get_magic_quotes_gpc())
    {
        // just in case server is running an old version of PHP with "magic quotes" running:
        $str = stripslashes($str);
    }
*/
    
    // escape any dangerous characters, e.g. quotes:
    $str = mysqli_real_escape_string($connection, $str);
    // ensure any html code is safe by converting reserved characters to entities:
    $str = htmlentities($str);
    // return the cleaned string:
    return $str;
}

// if the data is valid return an empty string, if the data is invalid return a help message
function validateString($username, $minlength, $maxlength)
{
    if (strlen($username)<$minlength)
    {
        // wasn't a valid length, return a help message:
        return "Minimum length: " . $minlength;
    }
    elseif (strlen($username)>$maxlength)
    {
        // wasn't a valid length, return a help message:
        return "Maximum length: " . $maxlength;
    }
    // data was valid, return an empty string:
    return "";
}

// if the data is valid return an empty string, if the data is invalid return a help message
function validateInt($phone, $min, $max)
{
    // see PHP manual for more info on the options: http://php.net/manual/en/function.filter-var.php
    $phone = array("options" => array("min_range"=>$min,"max_range"=>$max));

    if (!filter_var($phone, FILTER_VALIDATE_INT, $options))
    {
        // wasn't a valid integer, return a help message:
        return "Not a valid number (must be whole and in the range: " . $min . " to " . $max . ")";
    }
    // data was valid, return an empty string:
    return "";
}

?>