<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User as User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\UsersServices;

class UsersController extends AbstractController{

    /**
     * pokaz dane 1 uzytkownika
     * 
     * @Route("/api/users/show/{id}", name="show_user", methods={"GET"})
     */
    public function show(int $id, UsersServices $usersServices): Response{

        // pass to UsersServices
        $showUser = $usersServices->fetchData($id);

        return $showUser;

    }

    /**
     * pokaz dane wszystkich uzytkownikow
     * 
     * @Route("/api/users/list", name="list_all_users", methods={"GET"})
     */
    public function list(UsersServices $usersServices): Response{

        // pass to UsersServices
        $showUser = $usersServices->fetchAllData();

        return $showUser;
    }

    /**
     * usuwanie uzytkownika
     * 
     * @Route("/api/users/delete/{id}", name="delete_user", methods={"POST"})
     */
    public function deleteUser(int $id): Response{
        
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);
        
        if (!$user){

            throw $this->createNotFoundException("Użytkownik o id: ".$id." nie istnieje");
            
        }

        $entityManager->remove($user);
        $entityManager->flush();

        return new Response("Użytkownik usunięty");

    }

    /**
     * update username
     * 
     * @Route("/api/users/update/username/{username}/{newUsername}", name="update_username", methods={"POST"})
     */
    public function updateUsername(string $username, string $newUsername, UsersServices $usersServices, AuthServices $authServices){

        // walidacja danych
        // mimo nazwy pola 'password' to i tak sprawdza poprawnosc stringa
        $authServices->checkCredentials($username, $newUsername);

        // sprawdza zalogowanego uzytkownika
        $checkUser = $usersServices->checkUser($username);

        $changeUsername = $usersServices->changeUsername($username, $newUsername);

        return $changeUsername;
        
    }

    /**
     * update password
     * 
     * @Route("/api/users/update/password/{username}/{passwordNew}", name="update_password", methods={"POST"})
     */
    public function updatePassword(string $username, string $passwordNew, UserPasswordEncoderInterface $encoder, UsersServices $usersServices){

        // walidacja danych
        $authServices->checkCredentials($username, $newUsername);

        // sprawdza zalogowanego uzytkownika
        $checkUser = $usersServices->checkUser($username);

        $changePassword = $usersServices->changePassword($passwordNew);
        
        return $changePassword;

    }



}