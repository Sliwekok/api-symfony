<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User as User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class UsersServices extends AbstractController
{

    private $validator;
    private $encoder;

    public function __construct(ValidatorInterface $validator, UserPasswordEncoderInterface $encoder){
        $this->validator = $validator;
        $this->encoder = $encoder;
    }

    /**
     * Rejestracja użytkownika 
     */
    public function registration($username, $password){

        $entityManager = $this->getDoctrine()->getManager();
        
        $user = new User();

        $password = $this->encoder->encodePassword($user, $password);
        $created_at = new \DateTime('@'.strtotime('+2 hours'));
        $isNameTaken = $entityManager->getRepository(User::class)->findOneBy(['username' => $username]);

        if($isNameTaken){

            throw $this->createNotFoundException("Użytkownik o podanej nazwie już istnieje");

        }

        $user->setPassword($password);
        $user->setUsername($username);
        $user->setCreatedAt($created_at);
        $user->setIsActivated(1);
        $user->setRoles(['ROLE_USER']);

        $errors = $this->validator->validate($user);

        if (count($errors) > 0) {

            throw $this->createNotFoundException($errors);

        }


        $entityManager = $this->getDoctrine()->getManager();
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

        $password_verify = $encoder->isPasswordValid($user, $password);
        $roles = $user->getRoles();

        $createJWToken = $this->forward('App\Controller\JWTController::createToken', [
            'username' => $username,
            'roles'    => $roles,
        ]);

        // wypisz token
        $tokenResponse = array(
            'message' => 'success',
            'token'   => sprintf('Bearer %s', $createJWToken),
        );

        $serializer = $this->container->get('serializer');
        $token = $serializer->serialize($tokenResponse, 'json');


    }

}
