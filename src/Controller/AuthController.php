<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User as User;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\UsersServices;


class AuthController extends AbstractController
{
    /**
     * Register new user
     *
     * @Route("/register/{username}/{password}", name="register_user", methods={"POST"})
     */
    public function registerUser($username, $password, UsersServices $usersServices): Response{
    
        $this->forward('App\Controller\AuthController::checkCredentials', [
            'username' => $username,
            'password' => $password
        ]);

        // pass to UsersServices
        $register = $usersServices->registration($username, $password);
        
        return new Response($register);

    }

    /**
     * login new user
     *
     * @Route("/login/{username}/{password}", name="login_user", methods={"POST"})
     */
    public function loginUser($username, $password): Response{
        
        $this->forward('App\Controller\AuthController::checkCredentials', [
            'username' => $username,
            'password' => $password
        ]);
       
        return new Response($token);

    }
    /**
     * Logout user - logika w pliku security
     *
     * @Route("/logout", name="logout", methods={"POST"})
     */
    public function logout(): Response{

        return new Response("Zostałeś wylogowany");

    }

    public function isLogged(): Response{



    }

    public function checkCredentials($username, $password){

        if( strlen($username) == 0 || strlen($password) == 0 ){

            throw $this->createNotFoundException("Pola nie mogą być puste");

        }

        return true;

    }

}
