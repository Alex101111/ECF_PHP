<?php

namespace App\Controller;

use App\Dao\UserDao;

class SigninController
{
    /**
     * Action d'authentification d'un utilisateur (alias connexion)
     */
    public function index()
    {
        if (isset($_SESSION['user'])) {
            header('Location: /');
            die;
        }

        $args = [
            'email' => [
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '#^[\w_.-]+@[a-z]+\.[a-z]{2,}$#iu']
            ],
            'pwd' => []
        ];
        $user_post = filter_input_array(INPUT_POST, $args);

        if (isset($user_post['email']) && isset($user_post['pwd'])) {
            if (empty($user_post['email'])) {
                $error_messages['danger'][] = "Email requis";
            }

            if (empty($user_post['pwd'])) {
                $error_messages['danger'][] = "Mot de passe requis";
            }

            if (!isset($error_messages)) {
                try {
                    $userDao = new UserDao();
                    $user = $userDao->getByEmail($user_post['email']);
                } catch (PDOException $e) {
                    echo $e->getMessage();
                    die;
                }

                if (!empty($user) && $user->verifyPwd($user_post['pwd'])) {
                    $user->erasePwd();
                    session_regenerate_id();
                    $_SESSION['user'] = $user;
                    $_SESSION['id_user'] = $user->getIdUser();
                    header('Location: /');
                    die;
                } else {
                    $error_messages['danger'][] = 'Email ou mot de passe incorrect';
                }
            }
        }

        require_once implode(DIRECTORY_SEPARATOR, [VIEW, 'sign', 'signin.html.php']);
    }
}