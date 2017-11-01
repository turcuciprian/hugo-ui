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
$app->get('/getAJson', function ($request, $response) {
   try {
       $result = null;
       $names = array('Ioana Chichernea', 'Turcu Ciprian','Steve Jobs','Elon Musk','Dalai Lama');
       $responseArr = array('status' => 'true', 'names' => $names);

       if ($result) {
           return $response->withJson($responseArr, 200);
       } else {
           return $response->withJson(array('users' => $names), 422);
       }
   } catch (\Exception $ex) {
       return $response->withJson(array('error' => $ex->getMessage()), 422);
   }
});

$app->post('/postSomething', function ($request, $response) {
   try {
       $result = null;
       $values = array(
         ':name' => $request->getParam('name')
         ':age' => $request->getParam('age')
      );

       $responseArr = array('status' => 'true', 'userName' => $values[':name'], 'userAge' => $values[':age']);

       if ($result) {
           return $response->withJson($responseArr, 200);
       } else {
           return $response->withJson(array('status' => $responseArr), 422);
       }
   } catch (\Exception $ex) {
       return $response->withJson(array('error' => $ex->getMessage()), 422);
   }
});
