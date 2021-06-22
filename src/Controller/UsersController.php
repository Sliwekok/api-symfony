<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User as User;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController{

    /**
     * show data about 1 user
     * 
     * @Route("/api/users/show/{id}", name="show_user", methods={"POST"})
     */
    public function show(int $id): Response{

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

        $serializer = $this->container->get('serializer');
        $userData = $serializer->serialize($userData, 'json');

        return new Response($userData);

    }

    /**
     * list all users
     * 
     * @Route("/api/users/list", name="list_all_users", methods={"POST"})
     */
    public function list(): Response{

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
                    'roles'     => $roles,
                    'is_active' => $activated,
                    'created_at'=> $created_at,
                    'updated_at'=> $updated_at,
                ]
            );

        }

        $serializer = $this->container->get('serializer');
        $usersData = $serializer->serialize($usersData, 'json');

        return new Response($usersData);
    }

    /**
     * delete user
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
    public function updateUsername(string $username, string $newUsername): Response{

        $entityManager = $this->getDoctrine()->getManager();
        
        // dodać 2h, bo inaczej po UTC-0 zapisuje 
        $updated_at = new \DateTime('@'.strtotime('+2 hours'));
        
        $user = $entityManager->getRepository(User::class)->findOneBy(['username' => $username]);
        $newName = $entityManager->getRepository(User::class)->findOneBy(['username' => $newUsername]);
        $usernameChecker = $this->get('security.token_storage')->getToken()->getUser()->getUsername();

        if($usernameChecker !== $username){

            throw $this->createNotFoundException("Nie możesz zmienić nazwy innego użytkownika");

        }
        if(!$user){
            
            throw $this->createNotFoundException("Nie znaleziono podanego użytkownika");
            
        }
        if($newName) {

            throw $this->createNotFoundException("Podana nazwa użytkownika jest już zajęta");

        }

        $user->setUsername($newUsername);
        $user->setUpdatedAt($updated_at);

        $entityManager->persist($user);
        $entityManager->flush();

        $createJWToken = $this->forward('App\Controller\JWTController::createToken', [
            'username' => $username,
            'roles'    => $roles,
        ]);

        return new Response("Zmiana nazwy użytkownika się powiodła. Zaloguj się ponownie");

    }

    /**
     * update password
     * 
     * @Route("/api/users/update/password/{username}/{passwordNew}", name="update_username", methods={"POST"})
     */
    public function updatePassword(string $username, string $passwordNew, UserPasswordEncoderInterface $encoder): Response{

        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->findOneBy(['username' => $username]);

        if(!$user){

            throw $this->createNotFoundException("Nie znaleziono podanego użytkownika");

        }

        // dodać 2h, bo inaczej po UTC-0 zapisuje 
        $updated_at = new \DateTime('@'.strtotime('+2 hours'));
        $passwordNew = $encoder->encodePassword($user, $passwordNew);
        
        $usernameChecker = $this->get('security.token_storage')->getToken()->getUser()->getUsername();

        if($usernameChecker !== $username){

            throw $this->createNotFoundException("Nie możesz zmienić nazwy innego użytkownika");

        }


        $user->setPassword($passwordNew);
        $user->setUpdatedAt($updated_at);

        $entityManager->persist($user);
        $entityManager->flush();

        return new Response("Hasło zaktualizowane");

    }

}