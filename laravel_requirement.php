<?php
/////////////////////////////////////////////////////////////////*/
//	   		   Laravel Requirments Scanner Script   	   	     */
// 	    This Script Created And Developed By PHP Anonymous    	 */
//     					Join Us 								 */
// 	    Fb Group https://fb.com/groups/anonymouses.developers	 */
//	 	YouTube Channle youtu.be/c/phpanonymous     			 */
//  	WebSite  http://phpanonymous.com 						 */
//  	Gmail   php.anonymous1@gmail.com  						 */
/////////////////////////////////////////////////////////////////*/
class Scanner {
	public $extentions = [
		'fileinfo',
		'openssl',
		'tokenizer',
		'session',
		'mbstring',
		'mcrypt',
		'PDO',
		'pdo_sqlite',
		'PDO_ODBC',
		'pdo_mysql',
		'curl',
		'sqlite3',
		'soap',
		'wddx',
		'xml',
		'calendar',
		'standard',
		'sockets',
		'pcre',
		'ctype',
		'zip',
		'zlib',
		'json',
		'iconv',
		'gd',
		'hash',
		'bz2',
		'mysqli',
		'mysqlnd',
		'libxml',
		'gettext',
		'ftp',
		'xsl',
	];
	public $title = 'Laravel Requirements Explorer V 1.0';

	public function __construct() {
		$this->header();
		$this->folder_list();
	}

	public function storge_folder() {
		if (is_dir(__DIR__ .'/storage')) {
			return glob(__DIR__ .'/storage/*');
		} elseif (is_dir('../'.__DIR__ .'/storage')) {
			return glob('../'.__DIR__ .'/storage/*');
		}
	}

	public function folder_list() {
		foreach ($this->storge_folder() as $path) {
			/*if (isset($_GET['permission'])) {
			//return var_dump($_GET['permission']);
			chmod($path, (int) $_GET['permission']);
			} else {
			}*/
			@chmod($path, 0755);
		}
	}

	public function msg($type, $number = null) {
		if ($type == 'compatible') {
			return ['You Want Upgrade The PHP Version To '.$number.' To Run the project', false];
		} elseif ($type == 'success') {
			return ['The project is compatible with the current PHP version '.$number.' ', true];
		}
	}
	public function check_version() {
		$phpversion      = phpversion();
		$laravel_version = $this->laravel_version();
		if (!empty($laravel_version)) {
			if ($laravel_version == '4.2') {
				if ($phpversion < 5.4) {
					$msg = $this->msg('compatible', 5.4);
				} else {
					$msg = $this->msg('success', $phpversion);
				}
			} elseif ($laravel_version == '5.0') {
				if ($phpversion < 5.4 and $phpversion > 7) {
					$msg = $this->msg('compatible', '5.4 OR 5.6.9');
				} else {
					$msg = $this->msg('success', $phpversion);
				}
			} elseif ($laravel_version == '5.1') {
				if (@number_format($phpversion, 1) < @number_format('5.5.9', 1)) {
					$msg = $this->msg('compatible', ' 5.5.9');
				} else {
					$msg = $this->msg('success', $phpversion);
				}
			} elseif ($laravel_version == '5.2') {
				if (@number_format($phpversion, 1) < @number_format('5.5.9', 2)) {
					$msg = $this->msg('compatible', ' 5.5.9');
				} else {
					$msg = $this->msg('success', $phpversion);
				}
			} elseif ($laravel_version == '5.3') {
				if (@number_format($phpversion, 1) < @number_format('5.6.4', 2)) {
					$msg = $this->msg('compatible', ' 5.6.4');
				} else {
					$msg = $this->msg('success', $phpversion);
				}
			} elseif ($laravel_version == '5.4') {
				if (@number_format($phpversion, 1) < @number_format('5.6.4', 2)) {
					$msg = $this->msg('compatible', ' 5.6.4');
				} else {
					$msg = $this->msg('success', $phpversion);
				}
			} elseif ($laravel_version == '5.5') {
				if (@number_format($phpversion, 1) < @number_format('7.0.0', 2)) {
					$msg = $this->msg('compatible', ' 7.0.0');
				} else {
					$msg = $this->msg('success', $phpversion);
				}
			}
		}
		return ['phpversion' => $phpversion, 'laravel_version' => $laravel_version, 'msg' => $msg];
	}
	public function laravel_version() {
		$composer = file_get_contents(__DIR__ .'/composer.json');
		$composer = json_decode($composer, true);
		return str_replace('.*', '', $composer['require']['laravel/framework']);
	}
	public function icon() {
		return '<svg xmlns="http://www.w3.org/2000/svg" width="84.1" height="57.6" viewBox="0 0 84.1 57.6"><path fill="#FB503B" d="M83.8 26.9c-.6-.6-8.3-10.3-9.6-11.9-1.4-1.6-2-1.3-2.9-1.2s-10.6 1.8-11.7 1.9c-1.1.2-1.8.6-1.1 1.6.6.9 7 9.9 8.4 12l-25.5 6.1L21.2 1.5c-.8-1.2-1-1.6-2.8-1.5C16.6.1 2.5 1.3 1.5 1.3c-1 .1-2.1.5-1.1 2.9S17.4 41 17.8 42c.4 1 1.6 2.6 4.3 2 2.8-.7 12.4-3.2 17.7-4.6 2.8 5 8.4 15.2 9.5 16.7 1.4 2 2.4 1.6 4.5 1 1.7-.5 26.2-9.3 27.3-9.8 1.1-.5 1.8-.8 1-1.9-.6-.8-7-9.5-10.4-14 2.3-.6 10.6-2.8 11.5-3.1 1-.3 1.2-.8.6-1.4zm-46.3 9.5c-.3.1-14.6 3.5-15.3 3.7-.8.2-.8.1-.8-.2-.2-.3-17-35.1-17.3-35.5-.2-.4-.2-.8 0-.8S17.6 2.4 18 2.4c.5 0 .4.1.6.4 0 0 18.7 32.3 19 32.8.4.5.2.7-.1.8zm40.2 7.5c.2.4.5.6-.3.8-.7.3-24.1 8.2-24.6 8.4-.5.2-.8.3-1.4-.6s-8.2-14-8.2-14L68.1 32c.6-.2.8-.3 1.2.3.4.7 8.2 11.3 8.4 11.6zm1.6-17.6c-.6.1-9.7 2.4-9.7 2.4l-7.5-10.2c-.2-.3-.4-.6.1-.7.5-.1 9-1.6 9.4-1.7.4-.1.7-.2 1.2.5.5.6 6.9 8.8 7.2 9.1.3.3-.1.5-.7.6z"></path></svg>';
	}
	protected function header() {
		echo '
		<!DOCTYPE html>
		<html lang="en">
		    <meta charset="utf-8">
		  	<head>
		  	<title>'.$this->title.'</title>
			<!-- Latest compiled and minified CSS -->
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
			<!-- jQuery library -->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
			<!-- Latest compiled JavaScript -->
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
			<meta name="viewport" content="width=device-width, initial-scale=1">
		  	</head>
		';
	}

	public function check($name) {
		$false = ' This Module '.$name.' Not Installed OR Disabled In Your Server';
		$true  = ' This Module '.$name.' Installed and Enabled';
		return !extension_loaded($name)?[false, $false]:[true, $true];
	}

	public function __destruct() {

	}

	public function get_permission($path) {
		return substr(sprintf('%o', fileperms($path)), -4);
	}

	public function htaccess() {
		if (file_exists(__DIR__ .'/.htaccess')) {
			return '.htaccess  file exists <i class="fa fa-check" style="color:#090"></i>';
		} elseif (file_exists('../'.__DIR__ .'/.htaccess')) {
			return '.htaccess  file exists <i class="fa fa-check" style="color:#090"></i>';
		} else {
			return '.htaccess  file is missing <i class="fa fa-times" style="color:#c33"></i>';
		}
	}

}
$scanner = new Scanner();

echo '<div class="container">
	  <div class="alert alert-info">
	   <center><h1>'.$scanner->title.' by
	     <a href="http://phpanonymous.com" target="_blank"><img src="https://yt3.ggpht.com/-Eg8zjwDbOz8/AAAAAAAAAAI/AAAAAAAAAAA/q0KyriZ7yFY/s288-c-k-no-mo-rj-c0xffffff/photo.jpg" class="img-circle" style="width:50px;height:50px;"> </a>
	   </h1></center>
	   <center><h1>Your '.$scanner->icon().' <span style="color:#e74430">Laravel</span> Version '.$scanner->laravel_version().'</h1></center>
	   <span>
	    <small class="label label-danger">Follow Us</small>
	    <a href="https://www.facebook.com/groups/anonymouses.developers" target="_blank"><i class=" fa-2x fa fa-facebook"></i></a> .
	    <a href="https://www.youtube.com/c/phpanonymous" target="_blank"><i class=" fa-2x fa fa-youtube"></i></a> .
	    <a href="http://phpanonymous.com" target="_blank" ><i class=" fa-2x fa fa-globe"></i></a> .
	    <a href="mailto:php.anonymous1@gmail.com" ><i class=" fa-2x fa fa-envelope"></i></a>
	   </span>
	  </div>
	  <ol>';
$version = $scanner->check_version();
$class2  = $version['msg'][1] === true?'alert-info':'alert-danger';
echo '<li>
  <div class="col-md-8">
  	  <div class="alert '.$class2.'">
	  <center><h1>Compatibility PHP with Laravel </h1></center>
	  <h1>Your  <img src="http://php.net/images/logos/php-logo.svg"  class="img-circlee" style="width:50px;height:50px;" />  Version '.$version['phpversion'].'
	   </h1>

	  <h1>Your  '.$scanner->icon().'  Version '.$scanner->laravel_version().'</h1>

	  <hr />

	  '.@$version['msg'][0].'
	  </div>
	  </div>
  <div class="col-md-4">
  <div class="alert alert-info">
   <ol>
   ';
echo '<li>'.$scanner->htaccess().'</li>';
foreach ($scanner->storge_folder() as $path) {
	$permission       = $scanner->get_permission($path);
	$class_permission = $permission == '0755'?'<i class="fa fa-check" style="color:#090"></i>':'<i class="fa fa-times" style="color:#c33"></i>';
	echo '<li><h4>storage'.@explode('storage', $path)[1].'<br> <b>Permission Status '.$permission.' '.$class_permission.'</b></h4></li>';
}

/*
$perm_get = isset($_GET['permission'])?$_GET['permission']:'';
<form method="get">
<input type="text" name="permission" placeholder="Set Permission Folders" value="'.$perm_get.'" class="form-control" style="width:70%" />
<br>
<input type="submit"  value="Set" class="btn btn-success" style="display:inline;" />
</form>
 */
echo '
   </ol>

  </div>
  </div>
  <div class="clearfix"></div>
	</li>';

foreach ($scanner->extentions as $extentions) {
	$check = $scanner->check($extentions);
	$class = $check[0] === true?'alert-success':'alert-danger';
	//'.$check[0] === true?'':''.'
	//(bool) $check[0] === false?$success:$danger.'
	echo '<li>
	  <div class="alert '.$class.'">
	  <h1>'.$extentions.' </h1>

	   '.$check[1].'
	  </div>
	</li>';
}

echo '</ol>
	  </div>
	 ';
?>

