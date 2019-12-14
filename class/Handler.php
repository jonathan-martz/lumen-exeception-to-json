<?php
namespace MkaaaaaaaY\LumenExecptionToJson;

use \Illuminate\Http\Request;
use \Exception;
use App\Http\Controllers\Controller;

class Handler extends Controller{

    public function toJson(Request $request, $e){
        $message = 'Unknown Exeception: '.get_class($e);

        if(get_class($e) == 'Illuminate\Validation\ValidationException'){
            $message = $e->getMessage();
            $this->addResult('validation',$e->errors());
        }
        else{
            $message = 'Unknown Exeception: '.$e->getMessage();
        }

        $this->addMessage('exception',$message);

        if($request->cookie('debug') === 'true'){
            $this->addMessage('file',$e->getFile());
            $this->addMessage('line',$e->getLine());
        }

        return $this->getResponse();
    }
}
