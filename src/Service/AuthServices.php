<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User as User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Firebase\JWT\JWT;

class AuthServices extends AbstractController
{

    private $encoder;
    private $JWTservice;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, JWTservice $JWTservice){
        $this->passwordEncoder = $passwordEncoder;
        $this->JWTservice = $JWTservice;
    }

    /**
     * Rejestracja użytkownika 
     */
    public function registration($username, $password){

        $entityManager = $this->getDoctrine()->getManager();
        $user = new User();

        $password = $this->passwordEncoder->encodePassword($user, $password);
        $isNameTaken = $entityManager->getRepository(User::class)->findOneBy(['username' => $username]);

        if($isNameTaken){
            throw $this->createNotFoundException("Nazwa jest już zajęta");
        }

        $user->setPassword($password);
        $user->setUsername($username);
        $user->setIsActivated(1);
        $user->setRoles(['ROLE_USER']);

        $entityManager->persist($user);
        $entityManager->flush();

        return ("Nazwa użytkownika: ". $user->getUsername(). "<br>ID: ". $user->getId());

    }

    /**
     * logowanie użytkownika 
     */
    public function loginUser($username, $password){

        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->findOneBy(['username' => $username]);

        $password_verify = $this->passwordEncoder->isPasswordValid($user, $password);

        if(!$user){
            throw $this->createNotFoundException("Zła nazwa użytkownika");
        }

        if(!$password_verify){
            throw $this->createNotFoundException("Złe haslo");
        }

        $roles = $user->getRoles();

        $createJWToken = $this->JWTservice->createToken($username, $roles);

        return $createJWToken;

    }



    
    public function checkCredentials($username, $password){

        if( strlen($username) == 0 || strlen($password) == 0 ){

            throw $this->createNotFoundException("Pola nie mogą być puste");

        }

        if( strlen($username) < 5  || strlen($password) < 5 ){

            throw $this->createNotFoundException("Mininalna długość danych to: 6");

        }

    }
    
}