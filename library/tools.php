<?php
	class tools
	{
		public function url()
		{
			if($_SERVER['REQUEST_URI'] == '/without_laravel/')
				return 'index';

			$string = str_replace('//', '/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
			$aUrl = explode('/', trim($string, ' /'));
			
			if (strpos($aUrl[1], '.php') !== false)
				return 'index';

			return $aUrl[1];
		}
	}
?>