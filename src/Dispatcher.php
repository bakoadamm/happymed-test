<?php

namespace Src;

use Jenssegers\Blade\Blade;
use Src\Database\Database;
use Src\Database\IDatabase;

class Dispatcher {

    /**
     * @var Router
     */
    private $router;

    /**
     * @var Database
     */
    private $dbh;

    private $blade;

    public function __construct(
            Router $router,
            IDatabase $dbh,
            Blade $blade
    ) {
        $this->router = $router;
        $this->dbh = $dbh;
        $this->blade = $blade;
    }

    public function handle(Request $request) {

        $handler = $this->router->match($request);

        $params = $handler[1] ?? null;

        if ( ! $handler) {
            header("HTTP/1.1 404 Not Found");
            $this->notFound();
            die('not found');
        }

        if( ! is_array($handler[0])) {
            $handler[0]($params, $request);
        } else {
            $controller = $handler[0][0];
            $method = $handler[0][1];

            $ctrl = new $controller($this->dbh, $this->blade);

            $cleanedParams = [];
            foreach($params as $key => $param) {
                if(gettype($key) == 'string') {
                    $cleanedParams[$key] = $param;
                }
            }
            $request->paramBag = $cleanedParams;

            try {
                $ctrl->$method($request, $cleanedParams);
            } catch(\Exception $e) {
                die($e->getMessage());
            }
        }

    }

    private function notFound() {
        echo '404';
    }
}
