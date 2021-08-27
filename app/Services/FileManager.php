<?php

namespace Atlas\Services;

use Atlas\Controllers\FileManagerController;
use Atlas\Controllers\ServiceController;
use Atlas\Controllers\AtlasLog;

class FileManager extends ServiceController
{
    /**
     * @see ServiceController abstract class
     */

    public function __construct($restful, $action, $params)
    {
        $this->controller = new FileManagerController();
        $this->controller->params = $params;
        $this->controller->request = $restful->request();
        $this->restful = $restful;
        $this->action = $action;
    }
    
    public function run()
    {
        if(!method_exists($this->controller, $this->action)) {
            $this->restful->response(json_encode(['error' => 'Error: Missing Action']), 503);
        }

        $this->controller->{$this->action}();
        AtlasLog::saveLog($this);
        $this->restful->response(json_encode($this->controller->returnData), $this->controller->returnCode);
    }
    
}
