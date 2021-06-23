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
use App\Service\AuthServices;
use App\Service\UsersServices;


class AuthController extends AbstractController
{
    /**
     * Register new user
     *
     * @Route("/register/{username}/{password}", name="register_user", methods={"POST"})
     */
    public function registerUser($username, $password, AuthServices $authServices, UsersServices $usersServices){
    
        // sprawdz dane
        $authServices->checkCredentials($username, $password);

        // pass to AuthServices
        $register = $authServices->registration($username, $password);

        return new Response($register);

    }

    /**
     * login new user
     *
     * @Route("/login/{username}/{password}", name="login_user", methods={"POST"})
     */
    public function loginUser($username, $password, AuthServices $authServices, UsersServices $usersServices){
        
        // sprawdz dane
        $authServices->checkCredentials($username, $password);

        // sprawdza zalogowanego uzytkownika
        $usersServices->checkUser($username);
   
        // pass to AuthServices
        $login = $authServices->loginUser($username, $password);
       
        return $login;

    }
    /**
     * Logout user - usuwanie sesji i ciasteczek
     *
     * @Route("/logout", name="logout", methods={"GET"})
     */
    public function logout(): Response{

        $response = new Response();

        // usuwanie sesji
        $response->headers->clearCookie('PHPSESSID');
        $response->headers->clearCookie('Authorization');

        $response->send();

        return new Response("Zostałeś wylogowany");

    }


}
