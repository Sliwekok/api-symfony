<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Firebase\JWT\JWT;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class JWTController extends AbstractController
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
