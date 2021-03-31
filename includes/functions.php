<?php 
function redirectTo($newLocation){
    header("Location:".$newLocation);
    exit;
    
}
function checkUsernameExistence($userName)
{
    global $connectingDB;
    $sql = "SELECT username FROM users WHERE username = :userName";
    $stmt = $connectingDB->prepare($sql);
    $stmt->bind_param('s', $userName);
    $stmt->execute();
    $result = $stmt->store_result();
    if ($result == 1) {
        return true;
    } else {
        return false;
    }
}
function loginAttempt($username, $password)
{
    //query to check username and password in the database
    global $connectingDB;
    $sql = "SELECT * FROM users WHERE username=:username AND password=:password LIMIT 1";
    $stmt = $connectingDB->prepare($sql);
    $stmt->bind_param('ss', $username, $password);
    //$stmt->bind_param(':Password');
    $stmt->execute();
    $result = $stmt->store_result();
    if ($result == 1) {
        return $foundAccount = $stmt->fetch();
    } else {
        return null;
    }
}
function confirmLogin()
{
    if (isset($_SESSION['userID'])) {
        return true;
    } else {
        $_SESSION['errorMessage'] = "Login Required!!";
        redirectTo("login.php");
    }
}

?>