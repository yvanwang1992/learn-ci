<?php

function &load_class($class, $directory = 'core') {

	// 定义存储这些重要类实例全局变量的静态数组　
	static $_classes = array();

	// 当加载需要的类实例时，如果不是第一次加载，那么 $_classes 数组中肯定存放了需要的实例，直接返回即可
	if (isset($_classes[$class])) {
		return $_classes[$class];
	}

	// 在我们的框架中，每个类实例都有前缀CI_
	$name = 'CI_'.$class;

	if (file_exists($directory.'/'.$class.'.php')) {
		require($class.'.php');
	} else {
		exit('Unable to locate the class');
	}

	//跟踪我们加载过的类
	is_loaded($class);

	$_classes[$class] = new $name();
	return $_classes[$class];

}

function is_loaded($class = '') {
	static $_is_loaded = array();

	if ($class != '') {
		$_is_loaded[strtolower($class)] = $class;
	}

	return $_is_loaded;
}

// 简单模拟一些常用的函数，以免出错
function config_item($item) {

	static $_config_item = array('subclass_prefix' => 'MY_');

	return $_config_item[$item];

}

function show_error($message, $status_code = 500, $heading = 'An Error Was Encountered') {
	exit;
}

function show_404($page = '', $log_error = TRUE) {
	exit;
}

function log_message($level = 'error', $message, $php_error = FALSE) {
	return;
}