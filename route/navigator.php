<?php

use app\index\model\Category;

$category = Category::getCategory();

foreach($category as $k=>$v){
	$catdir = $v['catdir'];
	$cid = $v['id'];
	//$controller = $v->model->tablename;
	
	Route::get($catdir, 'index/index/'.$catdir.'?cid='.$cid);
	Route::get($catdir.'_list/:id', 'index/index/'.$catdir.'List');
	Route::get($catdir.'_detail/:id', 'index/index/'.$catdir.'Detail');
}


Route::rule('index','index/Index/index');
