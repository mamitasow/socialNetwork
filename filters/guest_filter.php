<?php
//ceci permet que  au visiteur dacceder au page ou il est inclut cad dire que si tu es deja connecte tu peux plus acceder au page ou cest inclut
if(isset($_SESSION['user_id'])&& isset($_SESSION['pseudo'])){
    header('Location:index.php');
    exit();
}else{

}
?>