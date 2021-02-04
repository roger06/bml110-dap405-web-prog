<?php
require_once('login/config.php');
require_once('login/functions.php');
session_start();

if ( isset( $_SESSION['user_id'] ) ) {
    $user_id = $_SESSION['user_id'];
    $user = in_array_r($user_id, $users);
}

if ( empty( $user ) ) {
    session_destroy();
    
    include('login/login.php');
} else {
    include('home.php');
}
?>
</body>
</html>