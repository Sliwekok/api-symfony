<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User as User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class UsersServices extends AbstractController
{

    /**
     * 
     *  Users service zarzadza uzytkownika: pokazuje, modyfikuje i usuwa dane
     * 
     */

    /**
     * pobieranie danych pojedynczego usera
     * 
     * pobieranie danych wszystkich: funkcja nizej: fetchAllData
     */
    public function fetchData($id){

        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);

        $created_at =   $user->getCreatedAt();
        $updated_at =   $user->getUpdatedAt();
        $activated =    $user->GetIsActivated();
        $username =     $user->getUsername();
        $roles =        $user->getRoles();

        $userData = array(
            'username'  => $username,
            'roles'     => $roles,
            'is_active' => $activated,
            'created_at'=> $created_at,
            'updated_at'=> $updated_at,
        );

        return new JsonResponse($userData);

    }

    /**
     * pobieranie danych wszystkich
     */
    public function fetchAllData(){

        $entityManager = $this->getDoctrine()->getManager();
        $users = $entityManager->getRepository(User::class)->findAll();

        $userData = array();

        foreach($users as $user){

            $username =     $user->getUsername();
            $roles =        $user->getRoles();
            $activated =    $user->GetIsActivated();
            $created_at =   $user->getCreatedAt();
            $updated_at =   $user->getUpdatedAt();

            array_push(
                $userData,
                [
                    'username'  => $username,
                    'roles'     => $roles,
                    'is_active' => $activated,
                    'created_at'=> $created_at,
                    'updated_at'=> $updated_at,
                ]
            );

        }

        return new JsonResponse($userData);

    }

    /**
     * aktualizacja danych uzytkownika - aktaulicja username
     */
    public function changeUsername($username, $newUsername){

        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->findOneBy(['username' => $username]);

        $user->setUsername($newUsername);

        $entityManager->persist($user);
        $entityManager->flush();

        return new Response("Zmieniłes nazwę uzytkownika na ". $newUsername);

    }

    /**
     * aktualizacja danych uzytkownika - aktaulicja password
     */
    public function changePassword($passwordNew){

        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->findOneBy(['username' => $username]);

        // sprawdzanie uzytkownika
        $this->forward('App\Controller\UsersController::checkUser', [
            'user'      => $user,
            'newName'   => $newName,
        ]);

        $passwordNew = $encoder->encodePassword($user, $passwordNew);

        $user->setPassword($passwordNew);

        $entityManager->persist($user);
        $entityManager->flush();

        return new Response("Hasło zaktualizowane");

    }

    // sprawdzanie danych uzytkownika
    public function checkUser($username, $newName = null){

        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->findOneBy(['username' => $username]);

        //sprawdzanie czy uzytkownik w parametrze 1 istnieje
        if(!$user){
            
            throw $this->createNotFoundException("Nie znaleziono podanego użytkownika");
            
        }
        
        // sprawdza zalogowanego uzytkownika
        if($token = $this->get('security.token_storage')->getToken() !== null ){
            $usernameChecker = $token->getUser()->getUsername();

            if($usernameChecker !== $user){
    
                throw $this->createNotFoundException("Nie możesz zmienić nazwy innego użytkownika");

            }

        }

        // sprawdzanie, czy nazwa jest już zajęta
        if(isset($newName)){
            
            $isNameTaken = $entityManager->getRepository(User::class)->findOneBy(['username' => $newName]);
            if($isNameTaken){
                
                throw $this->createNotFoundException("Podana nazwa użytkownika jest już zajęta");

            }

        }

    }

}
