<?php
session_start();
// $_SESSION=[];
// var_dump($_SESSION);
//  die();
require('filters/guest_filter.php');
require('config/database.php');
require('includes/function.php');
require('includes/constants.php'); ?>


<?php
if (isset($_POST['login'])) {
    //verifions si les champs ne sont pas vides
    if (not_empty(['identifiant','password'])) {
        extract($_POST);

        $query= $db->prepare("SELECT id FROM users WHERE 
        (pseudo=:identifiant OR email=:identifiant) AND
         password=:password AND active=1");
    
        $query->execute([
            'identifiant'=> $identifiant,
            'password'=> sha1($password)
                    ]);

        $userHasBeenFound=$query->rowCount();
        
        if ($userHasBeenFound)  {
            //pour recuperer les informations du users une fois connecte il le redirige a profile 
            
            $user=$query->fetch(PDO::FETCH_OBJ);
            //trouver le bon user
            $_SESSION['user_id']=$user->id; 
            $_SESSION['pseudo']=$user->pseudo;
           redirect('profile.php?id='.$user->id);

        } else {
            set_flash('identifiant ou le mot de passe ne marche pas!', 'danger');
            save_input_data(); 
        }
    }
} else {
    //vider les info ddes chmps du formulaire
    clear_input_data();
}
 ?>
<?php
require('views/login.view.php');?>