<?php
// on déclare l'espace de nom
namespace App\Controllers;

// on utilise la class
use App\Models\User;

class ContactController {
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
            $db_hash = $user['password']; // on récupère le mot de passe dans la bdd
            //var_Utils::dump($user['password']);
        
            $errors = []; // création d'un tableau de réception d'erreurs
        
            if (!$user['email']){ // on vérifie si l'email n'existe pas dans la bdd
                $errors[] = "Soit l'email, soit le mot de passe ne sont pas corrects";
            }
        
            if (empty($errors)){ // si le tableau d'erreurs est vide on peut continuer le process
        
                // on vérifie si $user est un tableau et que le mot de passe correspond
                if (is_array($user)){
                    //var_Utils::dump($user);
                    $db_hash = $user['password'];
                    if (password_verify($password, $db_hash)){
                        //echo "good password";
                        unset($user['password']); // j'enlève le mot de passe 
                        $_SESSION['user'] = $user;
                        header("Location:?page=home"); // redirection vers la page home si la connexion à réussi
                    }
                    else {
                        //echo "invalid password";
                        $errors[] = "Soit l'email, soit le mot de passe ne sont pas corrects";
                    }
                }
            }
        }
        $template = './views/template_login.phtml';
        $this->render($template,[]);
    
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