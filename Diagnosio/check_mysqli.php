<?php
// Check if MySQLi extension is enabled
if (function_exists('mysqli_connect')) {
    echo "MySQLi extension is enabled.";
} else {
    echo "MySQLi extension is not enabled.";
}
?>