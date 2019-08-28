
<?php
session_start();
//activation du compte de lutilisateur qui vient de se connecter
require('filters/guest_filter.php');
require('config/database.php');
require('includes/function.php');
//on verifie  si ce user p existe on niveau du lien et on niveau de la base
if(!empty($_GET['p']) && is_already_in_use('pseudo',$_GET['p'],'users') && !empty($_GET['token'])){
$pseudo=$_GET['p'];
$token=$_GET['token']; 

$query=$db->prepare('SELECT email,password FROM users where pseudo=?');
$query->execute([$pseudo]);

$token_verif=sha1($pseudo.$data->email.$data->password);

if($token==$token_verif){
    $query=$db->prepare("UPDATE users set active =1 where pseudo=?");
    $query->execute([$pseudo]);
    set_flash('Votre compte est activé','success');
    redirect('login.php');
}else{
    set_flash('Parametre Invalide','danger');
    redirect('index.php');
}

$data=$query->fetch(PDO::FETCH_OBJ0);
die($data->password);
}else{
    redirect('index.php'); 
}
