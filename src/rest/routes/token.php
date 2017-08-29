<?php
use \Firebase\JWT\JWT;

function createToken($id){
$key = "mara are mere2";
$token = array(
    "iss" => "http://example.org",
    "aud" => "http://example.com",
    "id" => $id,
    "iat" => 1356999524,
    "nbf" => 1357000000
);

/**
 * IMPORTANT:
 * You must specify supported algorithms for your application. See
 * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
 * for a list of spec-compliant algorithms.
 */

$jwt = JWT::encode($token, $key);
  return $jwt;
}

function validateToken($token){
  $key = "mara are mere2";
  try{
    $decoded = JWT::decode($token, $key, array('HS256'));
      return true;
  } catch (Exception $e) {
    return false;
  }
}
