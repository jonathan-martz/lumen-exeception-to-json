<?php

namespace MkaaaaaaaY\LumenExecptionToJson;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class Handler
 * @package MkaaaaaaaY\LumenExecptionToJson
 */
class Handler extends Controller
{

    /**
     * @param Request $request
     * @param $e
     * @return mixed
     */
    public function toJson(Request $request, $e)
    {
        $message = 'Unknown Exeception: ' . get_class($e);

        if(get_class($e) == 'Illuminate\Validation\ValidationException') {
            $message = $e->getMessage();
            $this->addResult('validation', $e->errors());
        }
        else {
            $message = 'Unknown Exeception: ' . $e->getMessage();
        }

        $this->addMessage('exception', $message);

        /**
         * @todo add debug cookie fix
         */
        if($request->cookie('debug') === 'true') {
            $this->addMessage('file', $e->getFile());
            $this->addMessage('line', $e->getLine());
        }

        return $this->getResponse();
    }
}
