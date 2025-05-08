<?php
namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtService {
    private $key;
    private $algorithm = 'HS256';
    public function __construct() {
        //there SHOULD be jwt_secret
        $this->key = env('JWT_SECRET', 'whocares');
    }
    public function generateAccessToken($userId, $userRole) {
        return JWT::encode([
            'sub' => $userId,
            'role' => $userRole,
            'exp' => time() + 900  // 15 minutes
        ], $this->key, $this->algorithm);
    }
    public function generateRefreshToken($userId) {
        return JWT::encode([
            'sub' => $userId,
            'exp' => time() + 1209600  // 14 days
        ], $this->key, $this->algorithm);
    }
    public function decode($token)
    {
        return JWT::decode($token, new Key($this->key, $this->algorithm));
    }
}