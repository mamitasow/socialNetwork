<?php
//remplacer not empty par cette fonction qui prend en parametre un tableau et qui verifie si les champs ne sont pas vide
if (!function_exists('not_empty')) {
    function not_empty($fields=[])
    {
        if (count($fields)!=0) {
            foreach ($fields as $field) {
                if (empty($_POST[$field])|| trim($_POST[$field])=="") {
                    return false;
                }
            }
            //les champs sont vides
            return true; 
        }
    }
}
//gerer les si le user met une balise html dans un input quil le convertit en html et vice versa 
if (!function_exists('e')) {
    function e($string)
    {
         if($string){
             return htmlspecialchars($string);
            // return htmlentities($string,ENT_QUOTES,'UTF-8',false);
         }
    }
}
//get a session value by key
if (!function_exists('get_session')) {
    function get_session($key)
    {
        if ($key) {
            return !empty($_SESSION[$key])
        ?e($_SESSION[$key])
        :null;
        }
    }
}
// Check if an user is connected
if(!function_exists('is_logged_in')){
    function is_logged_in(){
        return isset($_SESSION['user_id']) || isset($_SESSION['pseudo']);
    }
}
//Get avatar url 
if (!function_exists('get_avatar_url')) {
    function get_avatar_url($email)
    {
        return "http://gravatar.com/avatar/".md5(strtolower(trim(e($email))));
    }
}

// pour recuperer les information du user
if (!function_exists('find_user_by_id')) {
    function find_user_by_id($id)
    {
        global $db;
        $query=$db->prepare('SELECT name,pseudo,email,city,country,twitter,github,sexe,available_for_hiring,bio FROM users WHERE id=?');
        $query->execute([$id]);

        $data=$query->fetch(PDO::FETCH_OBJ);
        $query->closeCursor();

        return $data;
    }
    //chercher si des information existe deja dans la base
    if (!function_exists('is_already_in_use')) {
        function is_already_in_use($field, $value, $table)
        {
            global $db;
            $query=$db->prepare("SELECT id FROM $table WHERE $field=?");
            $query->execute([$value]);

            //le nombre de resultat obtenu par la requete
            $count=$query->rowCount();
            //apres avoir fait une requete de selection fermer le cursor
            $query->closeCursor();
            return $count;
        }
    }

    if (!function_exists('set_flash')) {
        function set_flash($message, $type='info')
        {
            $_SESSION['notification']['message']=$message;
            $_SESSION['notification']['type']=$type;
        }
    }

    //fonction pour gerer les redirections
    if (!function_exists('redirect')) {
        function redirect($page)
        {
            header('Location:'.$page);
            exit();
        }
    }
    //permet de sauvegarder les information du user qui sinscrit en session(fonction pour gerer le maintient des donnees dans le formulaire inscription pour ne recrire a chaque fois )
    if (!function_exists('save_input_data')) {
        function save_input_data()
        {
            foreach ($_POST as $key   => $value) {
                if (strpos($key, 'password')=== false) {
                    $_SESSION['input'][$key]=$value;
                }
            }
        }
    }
    //recupere les information et le remettre dans les champs
    if (!function_exists('get_input')) {
        function get_input($key)
        {
            return !empty($_SESSION['input'][$key])
     ?e($_SESSION['input'][$key])
     :null;
        }
    }

    if (!function_exists('clear_input_data')) {
        function clear_input_data()
        {
            if (isset($_SESSION['input'])) {
                $_SESSION['input']=[];
            }
        }
    }
    //fonction pour gerer etat actif des page cad si on est sur une page le lien de cette page est active sur le menu
    if (!function_exists('set_active')) {
        function set_active($path, $class='active')
        {
            //il prend le path surlequel on est grace a la variable superglobals $_SERVER le met dans un tableau par explode et recupere le dernier element par arraypop qui le nom de la page
            $page=array_pop(explode('/', $_SERVER['SCRIPT_NAME']));
            if ($page==$path.'.php') {
                return $class;
            } else {
                return"";
            }
        }
    }
} 