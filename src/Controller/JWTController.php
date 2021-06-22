<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Firebase\JWT\JWT;

class JWTController extends AbstractController
{

    // create JWT token and return it to called function
    public function createToken($username, $roles): Response
    {
        $roles = $user->getRoles();
        // payload - deklaruje dlugosc sesji tokena jwt
        $payload = [
            "username"  => $user->getUsername(),
            "role"      => $roles,
            "exp"       => (new \DateTime())->modify("+30 minutes")->getTimestamp()
        ];
        $jwt = JWT::encode($payload, $this->getParameter('jwt_secret'), 'HS256');

        return $jwt;
  
    }
}
