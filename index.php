<?php
/*Servidor json*/
$path = explode('/', $_GET['path']);
$contents = file_get_contents('arquivo.json');

$json = json_decode($contents, true);

$method = $_SERVER['REQUEST_METHOD'];

header('Content-type: application/json');

$body = file_get_contents('php://input');

/*Requisicao de dados via get */
if($method === 'GET')
{
    if($json[$path[0]])
    {
        echo json_encode($json[$path[0]]);
    }
    else
    {
        echo '[]';
    }
}

/*Insercao de dados via post */
if($method === 'POST')
{ 
    // se for inserir o dado insere via jsonBody
    $jsonBody = json_decode($body, true);
    $jsonBody['id'] = time();

    // se nao existir cria o dado
    if(!$json[$path[0]])
    {
        $json[$path[0]] = [];
    }
    
    //inseri um dado novo e salva
    $json[$path[0]] [] = $jsonBody;
    echo json_encode($jsonBody);
    file_put_contents('arquivo.json',json_encode($json));
    
    
}
?>

