<?PHP 
 
// Database connection parameters
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'sci_dru_form';

// Create a database connection
$mysqli = new mysqli($hostname, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
date_default_timezone_set('Asia/Bangkok');
?>