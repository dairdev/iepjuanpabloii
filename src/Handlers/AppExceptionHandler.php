<?php
namespace App\Handlers;

class AppExceptionHandler implements \Illuminate\Contracts\Debug\ExceptionHandler {

	public function report(Exception $e){
		throw $e;
	}

	public function render($request, Exception $e){
		throw $e;
	}

	public function renderForConsole($output, Exception $e){
		throw $e;
	}

}
