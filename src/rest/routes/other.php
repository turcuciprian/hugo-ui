<?php

function genID($i)
{
    $a = ['a', 'b', 'c', 'd', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'z'];
    $primul = mt_rand(0, (count($a) - 1));
    $b = strtoupper($a[$primul]);
    $final = '';
    $w = mt_rand(0, $i);
    for ($r = 0; $r < $i; ++$r) {
        if ($w == $r) {
            $final .= $b;
        } else {
            $final .= mt_rand(0, 9);
        }
    }

    return $final;
}

$app->get('/generateTaskID', function ($request, $response) {
   try {
       $result = null;
       $result = genID(6);

       if ($result) {
           return $response->withJson(array('status' => 'true', 'ID' => $result), 200);
       } else {
           return $response->withJson(array('status' => 'Users Not Found'), 422);
       }
   } catch (\Exception $ex) {
       return $response->withJson(array('error' => $ex->getMessage()), 422);
   }

});
