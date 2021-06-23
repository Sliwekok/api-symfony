<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Firebase\JWT\JWT;

class JWTservice extends AbstractController
{

     // create JWT token and return it to called function
     public function createToken($username, $roles)
     {
         // payload - deklaruje dlugosc sesji tokena jwt
         $payload = [
             "username"  => $username,
             "role"      => $roles,
             "exp"       => (new \DateTime())->modify("+30 minutes")->getTimestamp()
         ];
 
         $jwt = JWT::encode($payload, $this->getParameter('jwt_secret'), 'HS256');
 
         $tokenResponse = array(
             'message' => 'success',
             'token'   => sprintf('Bearer %s', $jwt),
         );
 
         return new JsonResponse($tokenResponse);
 
     }
    
}