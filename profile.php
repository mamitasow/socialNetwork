<?php
session_start();
require('filters/auth_filter.php');
require('config/database.php');
require('includes/function.php');
require('includes/constants.php');

if(!empty($_GET['id'])){
//recupere les infos du user connaissant lid grace a $_GET
$user=find_user_by_id($_GET['id']);


if(!$user){
    redirect('index.php');
} 
}else{
redirect('profile.php?id='.get_session('user_id'));
}

if (isset($_POST['update'])) {
    $errors=[];
    
    //verifions si les champs ne sont pas vides
    if (not_empty(['name','city','country','sexe','bio'])) {
        extract($_POST);

        $query= $db->prepare('UPDATE users 
        SET name=:name,city=:city,country=:country,
        sexe=:sexe,twitter=:twitter,github=:github,
        available_for_hiring=:available_for_hiring,bio=:bio 
        WHERE id=:id');
    
        $query->execute([
            'name'=> $name,
            'city'=> $city,
            'country'=> $country,
            'sexe'=> $sexe,
            'twitter'=>$twitter,
            'github'=> $github,
            'available_for_hiring'=> !empty($available_for_hiring)?'1':'0',
            'bio'=> $bio,
            'id'=> get_session('user_id'),
                    ]);
                    
                   
set_flash("Votre compte a ete mise à jour!");
redirect('profile.php?id='.get_session('user_id'));      
}else{
         save_input_data();
         $errors[]="Veuillez remplir tous les champs marques d'un (*)";  
       }
} else {
    //vider les info ddes chmps du formulaire
    clear_input_data();
}

require('views/profile.view.php');
?>