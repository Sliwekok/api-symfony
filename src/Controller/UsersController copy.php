<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User as User;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Firebase\JWT\JWT;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;



class UsersController extends AbstractController{

    public function list(int $id): Response{

        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);
        $created_at = $user->getCreatedAt();
        $updated_at = $user->getUpdatedAt();
        $activated = $user->GetIsActivated();
        $username = $user->getUsername();
        $roles = $user->getRoles();

        $userData = array(
            'username'  => $username,
            'created_at'=> $created_at,
            'updated_at'=> $updated_at,
            'is_active' => $activated,
            'roles'     => $roles
        );

        $serializer = $this->container->get('serializer');
        $userData = $serializer->serialize($userData, 'json');

        return new Response($userData);
    }

    public function all(): Response{

        $entityManager = $this->getDoctrine()->getManager();
        $allUsers = $entityManager->getRepository(User::class)->findAll();
        $usersData = array();

        foreach($allUsers as $user){
            $created_at = $user->getCreatedAt();
            $updated_at = $user->getUpdatedAt();
            $activated = $user->GetIsActivated();
            $username = $user->getUsername();
            $roles = $user->getRoles();

            array_push(
                $usersData,
                [
                    'username'  => $username,
                    'created_at'=> $created_at,
                    'updated_at'=> $updated_at,
                    'is_active' => $activated,
                    'roles'     => $roles
                ]
            );
        }

        $serializer = $this->container->get('serializer');
        $usersData = $serializer->serialize($usersData, 'json');

        return new Response($usersData);
    }

    public function registerUser($username, $password, ValidatorInterface $validator, UserPasswordEncoderInterface $encoder): Response{
    
        $user = new User();
        $password = $encoder->encodePassword($user, $password);
        // dodać 2h, bo inaczej po UTC-0 zapisuje 
        $created_at = new \DateTime('@'.strtotime('+2 hours'));

        $user->setPassword($password);
        $user->setUsername($username);
        $user->setCreatedAt($created_at);
        $user->setIsActivated(1);
        $user->setRoles(['ROLE_USER']);
        
        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            throw $this->createNotFoundException($errors);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        $userId = "User ID: ". $user->getId(). "<br>Username: ". $user->getUsername();

        return new Response($userId);
    }

    public function loginUser($username, $password, UserPasswordEncoderInterface $encoder): Response{
        
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->findOneBy(['username' => $username]);
        $password_verify = $encoder->isPasswordValid($user, $password);
        $roles = $user->getRoles();
        // payload - deklaruje dlugosc sesji tokena jwt
        $payload = [
            "username"  => $user->getUsername(),
            "exp"       => (new \DateTime())->modify("+30 minutes")->getTimestamp(),
            "role"      => $roles
        ];
        $jwt = JWT::encode($payload, $this->getParameter('jwt_secret'), 'HS256');

        if(!$user || !$password_verify){
            throw $this->createNotFoundException("Błędne dane logowania");
        }

        $tokenResponse = array(
            'message' => 'success',
            'token'   => sprintf('Bearer %s', $jwt),
            // 'token'   => sprintf('Bearer %s', $jwt)
        );

        $serializer = $this->container->get('serializer');
        $token = $serializer->serialize($tokenResponse, 'json');

        return new Response($token);
    }

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

    public function updateUsername(string $username, string $newUsername): Response{
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->findOneBy(['username' => $username]);
        $newName = $entityManager->getRepository(User::class)->findOneBy(['username' => $newUsername]);
        // dodać 2h, bo inaczej po UTC-0 zapisuje 
        $updated_at = new \DateTime('@'.strtotime('+2 hours'));
        $usernameChecker = $this->get('security.token_storage')->getToken()->getUser()->getUsername();

        if($usernameChecker !== $username){
            throw $this->createNotFoundException("Nie możesz zmienić nazwy innego użytkownika");
        }
        if(!$user){
            throw $this->createNotFoundException("Nie znaleziono podanego użytkownika");
        }
        if ($newName) {
            throw $this->createNotFoundException("Podana nazwa użytkownika jest już zajęta");
        }

        $user->setUsername($newUsername);
        $user->setUpdatedAt($updated_at);

        $entityManager->persist($user);
        $entityManager->flush();

        // ustawienie od nowa jwt, aby user nie by wylogowywany po zmianie nazwy
        $roles = $user->getRoles();
        // payload - deklaruje dlugosc sesji tokena jwt
        $payload = [
            "username"  => $user->getUsername(),
            "exp"       => (new \DateTime())->modify("+30 minutes")->getTimestamp(),
            "role"      => $roles
        ];
        $jwt = JWT::encode($payload, $this->getParameter('jwt_secret'), 'HS256');


        return new Response("Nowa nazwa użytkownia: ". $newUsername);
    }

    public function updatePassword(string $username, string $passwordNew, UserPasswordEncoderInterface $encoder): Response{
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->findOneBy(['username' => $username]);
        // dodać 2h, bo inaczej po UTC-0 zapisuje 
        $updated_at = new \DateTime('@'.strtotime('+2 hours'));
        $usernameChecker = $this->get('security.token_storage')->getToken()->getUser()->getUsername();
        $hashedPassword = $encoder->encodePassword($user, $passwordNew);

        if($usernameChecker !== $username){
            throw $this->createNotFoundException("Nie możesz zmienić hasła innego użytkownika");
        }

        if(!$user){
            throw $this->createNotFoundException("Nie znaleziono podanego użytkownika");
        }

        $user->setPassword($hashedPassword);
        $user->setUpdatedAt($updated_at);

        $entityManager->persist($user);
        $entityManager->flush();

        return new Response("Hasło zaktualizowane");
    }

    public function logout(): Response{
        return new Response("Zostałeś wylogowany");
    }

}