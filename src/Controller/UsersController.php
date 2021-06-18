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


class UsersController extends AbstractController{

    public function list(int $id): Response{

        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);
        $created_at = $user->getCreatedAt();
        $updated_at = $user->getUpdatedAt();
        $activated = $user->GetIsActivated();
        $username = $user->getUsername();
        $isLogged = $user->getIsLogged();

        $userData = array(
            'username'  => $username,
            'created_at'=> $created_at,
            'updated_at'=> $updated_at,
            'is_active' => $activated,
            'is_logged' => $isLogged
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
            $isLogged = $user->getIsLogged();

            array_push(
                $usersData,
                [
                    'username'  => $username,
                    'created_at'=> $created_at,
                    'updated_at'=> $updated_at,
                    'is_active' => $activated,
                    'is_logged' => $isLogged
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
        $created_at = new \DateTime('@'.strtotime('+2 hours'));

        $user->setPassword($password);
        $user->setUsername($username);
        $user->setCreatedAt($created_at);
        $user->setIsActivated(1);
        $user->setIsLogged(0);
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
        // payload - deklaruje dlugosc sesji tokena jwt
        $payload = [
            "username" => $user->getUsername(),
            "exp"  => (new \DateTime())->modify("+15 minutes")->getTimestamp(),
        ];
        $jwt = JWT::encode($payload, $this->getParameter('jwt_secret'), 'HS256');

        if(!$user || !$password_verify){
            throw $this->createNotFoundException("Błędne dane logowania");
        }

        $user->setIsLogged(1);

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
        $updated_at = new \DateTime('@'.strtotime('+2 hours'));

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

        return new Response("Nowa nazwa użytkownia: ". $newUsername);
    }

    public function updatePassword(string $username, string $password, string $newPassword): Response{
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->findOneBy(['username' => $username]);
        $updated_at = new \DateTime('@'.strtotime('+2 hours'));
        $password = $user->getPassword();
        $verifyPassword = password_verify($newPassword, $password);

        if($verifyPassword){
            throw $this->createNotFoundException("Hasła nie mogą być takie same");
        }
        if(!$user){
            throw $this->createNotFoundException("Nie znaleziono podanego użytkownika");
        }

        $newPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $user->setPassword($newPassword);

        $entityManager->persist($user);
        $entityManager->flush();

        return new Response("Hasło zaktualizowane");
    }

    public function logout(): Response{
        return new Response("Zostałeś wylogowany");
    }

}