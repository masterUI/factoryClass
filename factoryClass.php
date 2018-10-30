<?php
	//林家豪测试
	class factory{
		private static $inse;
		private function __construct(){
			spl_autoload_register(array(__CLASS__,'autoLoad'));
		}
		public static function getInstance(){
			
			if(!isset(self::$inse))
			{
				self::$inse = new factory();
			}
			return self::$inse;
		}
		public function autoLoad($conName){
			
			$fileName ="./controls/{$conName}Class.php";
			
			if(file_exists($fileName))
			{
				require_once $fileName;
			}else
			{
				echo '获取文件失败';
			}
		}
		public function run(){
			isset($_REQUEST['a'])? $flag = $_REQUEST['a']:$flag='log';
			isset($_REQUEST['c'])? $mark = $_REQUEST['c']:$mark='login';
			$conName = "{$flag}Con";
			$conn = new $conName(); //new 的时候自动调用autoload方法
			$conn->doAction($mark);
		}
	}

?>