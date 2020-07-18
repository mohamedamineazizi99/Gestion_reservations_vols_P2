<?php
	
	// hitach radi ndiro lih incloud fi ga3 les fichier
	session_start();

	require_once './bootstrap.php';

	spl_autoload_register('autoload');

	// $class_name : name dyal lclass li randiro liha includ
	function autoload($class_name){
		// $array : kandeclariw fih name dyal les class li fihom les class 
		$array_paths = array(
			'database/',
			'app/classes/',
			'models/',
			'controllers/'
		);

		// kanbedlo / li dernaha lfo9 fi $array_paths bi \\ li katfra9hom bi anti slash w katbedel app/classes katraj3o app \classes \Redirect
		// bi kholasa bedel slash li hiya / bi onti slach li hiya \
		$parts = explode('\\',$class_name);
		// array_pop() : kat recuperer akhir 3onsor li howa smiya dyal la class wkanhotoha fi variable name
		$name = array_pop($parts);

		// $array_paths fih les chamain dyal les class
		foreach ($array_paths as $path) {
			// sprintf kan3toha had $path wkandiro lih la concatination bi .php wkan3toha $name
			// ratakhod $path w radi t3awed lina %s bi smia dyal la class li kayna fi $name wtjma3 dakchi
			$file = sprintf($path.'%s.php',$name);
			// rir bach ntaker bili had $file rah vraiment kayen ficier bach mandirch includ lchi class makaynach
			if (is_file($file)) {
				include_once $file;
			}
		}


	}

?>