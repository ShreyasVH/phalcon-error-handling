<?php

use app\exceptions\MyException;
use Phalcon\Mvc\Micro\Collection;
use app\responses\Response;

$books = new Collection();
$books->setHandler('app\controllers\BookController', true);

$books->get('/v1/books/{id:[0-9]+}', 'getAction');
$books->get('/v1/books', 'getAllAction');
$books->post('/v1/books', 'createAction');
$books->put('/v1/books/{id:[0-9]+}', 'updateAction');
$books->delete('/v1/books/{id:[0-9]+}', 'deleteAction');

$application->mount($books);

$application->after(function() use($application) {
    $application->response->setContentType('application/json', 'UTF-8');
    $output_content = json_encode(Response::withData($application->getReturnedValue()), JSON_UNESCAPED_SLASHES);

    $application->response->setContent($output_content);
    $application->response->send();
});

$application->notFound(function () use ($application) {
    $application->response->setStatusCode(404, 'Not Found');
    $application->response->sendHeaders();

    $message = 'Action Not Found';
    $application->response->setContent($message);
    $application->response->send();
});

$application->error(function(Throwable $ex) use($application) {
    $description = 'Internal Server Error';
    $http_status_code = 500;
    if($ex instanceof MyException)
    {
        $my_exception = $ex;
        $description = $my_exception->description;
        $http_status_code = $my_exception->http_status_code;
    }
    else
    {
        var_dump($ex);die;
    }


    $response = Response::withError($description);

    $application->response->setContentType('application/json', 'UTF-8');
    $output_content = json_encode($response, JSON_UNESCAPED_SLASHES);
    $application->response->setContent($output_content);
    $application->response->setStatusCode($http_status_code);
    $application->response->send();
    exit;
});