<?php
	namespace MkaaaaaaaY\LumenExecptionToJson;

	use \Illuminate\Http\Request;
	use \Exeception;

	class Handler{

		public function toJson(Request $request, Exeception $e){
			// Todo: move to own module
			$message = 'Unknown Exeception: '.get_class($e);

			if(get_class($e) == 'Symfony\Component\HttpKernel\Exception\NotFoundHttpException'){
				$message = 'Route not Found.';
			}
			else{
				$message = 'Unknown Exeception: '.get_class($e);
			}

			return response()->json([
				'status' => 'exeception',
				'message' => $message
			]);
		}
	}