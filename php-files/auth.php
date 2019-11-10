<?php 

session_start();

if (!isset($_SESSION["user_id"])) {
    $_SESSION["not_logged_in"] = true;
    header("Location: login.php");
}

if (isset($_SESSION["group_id"])) {
    
    function hasPermission($name) {
        global $dbConnection;
        $name = trim($name);

        $query = mysqli_query($dbConnection,
                            "SELECT access_allowed
                             FROM permissions
                             WHERE permissions.name = '" . $name . "'
                             AND group_id = " . $_SESSION["group_id"]);
        return mysqli_fetch_assoc($query)["access_allowed"] ?? false;
    }

}

?>