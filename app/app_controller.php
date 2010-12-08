<?php

class AppController extends Controller {

	function beforeFilter() {
		Security::setHash('sha256');
	}
	
}

?>