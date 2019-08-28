<?php
//ceci permet a un user de ne pas datteindre la page profile  sil n'est pas connecte cad si son id et son pseudo existe pas dans la base
if(!isset($_SESSION['user_id'])&& !isset($_SESSION['pseudo'])){
    header('Location:login.php');
    exit();
}else{

}
?>