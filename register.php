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
if(isset($_POST['register'])){
    //verifions si les champs ne sont pas vides
    if(not_empty(['name','pseudo','email','password','password_confirm'])){
        //le tableau qui contient l'ensemble des erreurs
        $errors=[];
        extract($_POST);
        //verifier que le pseudo a au moins 3caracteres
        if(mb_strlen($pseudo)<3){
            $errors[]="Pseudo trop court! (Minimum 3 caracteres)";
        }
        //verifier que le user a mis un bon email coté backend
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $errors[]="Adresse email invalide";
        }
        //verifier si le mot de passe contient plus de six caractere et verifier que les deux mot de passe sont conforme
        if(mb_strlen($password)<6){
            $errors[]="Mot de passe trop faible! (Minimum 6 caracteres)";
        }else{
            if($password!=$password_confirm){ 
                $errors[]="Les deux mots de passe ne sont pas conforme!";
            }
            
        }if(is_already_in_use('pseudo',$pseudo,'users')){
            $errors[]=" Ce pseudo existe deja"; 
        } 
        if (is_already_in_use('email', $email, 'users')) {
            $errors[]=" Ce email existe deja";
        }
           
        //si le tableau ne contient pas d'erreur
        if(count($errors)==0){
            //envoi d'un mail d'activation
            $destinataire=$email;
            $subject=WEBSITE_NAME." - ACTIVATION DE COMPTE"; 
            $password=sha1($password);  
            $token=sha1($pseudo.$email.$password);
//garder les informations en memoire tampon tout ce qui est apres obj_start ne sera pas directement afficher
            ob_start();
            //ceci ne sera pas afficher directement il est en memoire tampon
            require('templates/emails/activation.tmpl.php');
            //ceci permettra de recuperer les info dans activation.tlmp(le contenu du mail) par inclusion
            $content=ob_get_clean(); 
            $headers='MIME-Version: 1.0' . "\r\n";
            $headers.='Content-type:text/html; charset=iso-8859-1' . "\r\n";

            //l'envoi du mail
            mail($destinataire,$subject,$content,$headers);

            //informer la le destinataire de verifier sa boite de reception
            //set_flash sert a afficher le message une seul fois dans toute les page qu'on voudra en ytilisant les sessions
           set_flash("mail d'activation envoye!", 'success');
           $query=$db->prepare('INSERT  INTO users (name,pseudo,email,password) 
           values (:name,:pseudo,:email,:password)');
$query->execute([
'name'=>$name,
'pseudo'=>$pseudo,
'email'=>$email,
'password'=>$password
]);
                                header('Location:index.php');
           exit();
        }else{
            /*sil ya des erreurs maintient 
            les infos quil a mis en session*/
            save_input_data();
        }
    }else{
        $errors[]="veuillez remplir tous les champs";
        save_input_data();
    }
}else{
    //vider les info ddes chmps du formulaire
    clear_input_data(); 
}
 ?>
 <?php 
require('views/register.view.php');?>