<?php

$method = $_SERVER['REQUEST_METHOD'];

$url = (isset($_GET['q'])) ? $_GET['q'] : '';
$url = rtrim($url, '/');
$urls = explode('/', $url);
array_shift($urls);

$router = $urls[0];
$urlData = array_slice($urls, 1);

$router_path = __DIR__ . '/routers/' . $router . '.php';
if (file_exists($router_path)) {
    include_once $router_path;
    include_once __DIR__ . '/lib/Db.php';
    
    $formData = getFormData($method);
    $pdo = (new Db())->getConnect();
    
    new $router($method, $urlData, $formData, $pdo);
} else {
    header('HTTP/1.1 405 Method Not Allowed');
    header('Content-Type: application/json');
    echo json_encode([
        'error' => 'Method Not Allowed'
    ]);
}



/**
 * 
 * @param string $method
 * @return array
 */
function getFormData($method) {
    // GET, POST
    if ($method === 'GET') {
        return $_GET;
    } elseif ($method === 'POST') {
        return $_POST;
    }

    // PUT, PATCH, DELETE
    $data = [];
    $exploded = explode('&', file_get_contents('php://input'));
    foreach($exploded as $pair) {
        $item = explode('=', $pair);
        if (count($item) == 2) {
            $data[urldecode($item[0])] = urldecode($item[1]);
        }
    }

    return $data;
}
