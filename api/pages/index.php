<?

if(isset($_SESSION['auth']['login'])){
    require('includes/header.php');
    require($view.'.php');
    require('includes/footer.php');
    }
else{
    require('auth.php');
}

?>