<?php
// on déclare l'espace de nom
namespace App\Controllers;

// on utilise la class
use App\Models\User;

class LoginController {
    // Déclaration e la fonction index()
    public function index(){
        var_dump('tottoootto');
        if(isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])){

            $email = $_POST['email'];
            $password = $_POST['password'];
            $title = "Login";
            $userObj = new User();

            $user = $userObj->login($email);
            var_dump($user);
           
            //var_Utils::dump($user['password']);
        
            $errors = []; // création d'un tableau de réception d'erreurs
        
            if (!$user['email']){ // on vérifie si l'email n'existe pas dans la bdd
                $errors[] = "Le compte $email n'existe pas. Veuillez <a href=\"?page=contact\">vous inscrire</a> svp.";
            }

            if (is_array($user) && !password_verify($password, $user['password'])){
                $errors[] = "Le mot-de-passe semble incorrect.";
            }
        
            if (empty($errors)){
                unset($user['password']);
                $_SESSION['user'] = $user;
                if (!in_array("ROLE_ADMIN", json_decode($_SESSION['user']['roles']))){
                    header("Location: ?page=home");
                    exit();
                } else{
                    header("Location: ?page=home");
                }
            }
        }
        $template = './views/template_login.phtml';
        $this->render($template);
    
    }

    public function render($templatePath, $data){
        // Ouvrir la mémoire tampon du serveur
        // https://www.php.net/manual/en/function.ob-start.php
        ob_start();
        // Inclure le fichier de template
        include $templatePath;
        // On charge la mémoire tampon dans le template
        // https://www.php.net/manual/en/function.ob-get-clean.php
        $template = ob_get_clean();
        // Afficher le template avec les data entrées en param.Xrations et qui le chemin de "$template"
        include './views/base.phtml';
    }


}

?>