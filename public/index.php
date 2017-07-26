<?php

use App\Resources\AbstractHttpException;

try {
  // Loading Configs
  $config = require(__DIR__ . '/../app/config/config.php');

  // Autoloading classes
  require __DIR__ . '/../app/config/loader.php';

  // Initializing DI container
  /** @var \Phalcon\DI\FactoryDefault $di */
  $di = require __DIR__ . '/../app/config/di.php';

  // Initializing application
  $app = new \Phalcon\Mvc\Micro();

  // Setting DI container
  $app->setDI($di);

  // Setting up routing
  require __DIR__ . '/../app/config/routes.php';

  // Making the correct answer after executing
  $app->after(
    function () use ($app) {
      // Getting the return value of method
      $return = $app->getReturnedValue();
      
      if(is_object($return)){
        $app->response->setStatusCode(200, "OK");
        // Transforming model to arrays to JSON
        $app->response->setContent(
                json_encode($return->toArray())
                );
      } elseif(is_array($return)){
        $app->response->setStatusCode(200, "OK");
        // Transforming array to arrays to JSON
        $app->response->setContent(json_encode($return));
      } elseif (!strlen($return)) {
        // Successful response without any content
        $app->response->setStatusCode('204', 'No Content');
      } else {
        // Unexpected response
        throw new Exception('Bad Response');
      }

      // Sending response to the client
      $app->response->send();
    }
);
  // Processing request
  $app->handle();
} catch (AbstractHttpException $e) {
  $response = $app->response;
  $response->setStatusCode($e->getCode(), $e->getMessage());
  $response->setJsonContent($e->getAppError());
  $response->send();
} catch (\Phalcon\Http\Request\Exception $e) {
  $app->response->setStatusCode(400, 'Bad request')
                ->setJsonContent([
                  AbstractHttpException::KEY_CODE    => 400,
                  AbstractHttpException::KEY_MESSAGE => 'Bad request'
                ])
                ->send();
} catch (\Exception $e) {
    
    $message = $config->application->env == "PROD" ? 
             'Some error occurred on the server.' : $e->getMessage();
    
    // Standard error format
    $result = [
      AbstractHttpException::KEY_CODE    => 500,
      AbstractHttpException::KEY_MESSAGE => $message
    ];

    // Sending error response
    $app->response->setStatusCode(500, 'Internal Server Error')
                  ->setJsonContent($result)
                  ->send();
}
