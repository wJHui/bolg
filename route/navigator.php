<?php

use app\index\model\Category;

$category = Category::getCategory();

foreach($category as $k=>$v){
	$catdir = $v['catdir'];
	$cid = $v['id'];
	$controller = $v->model->tablename;

	Route::get($catdir, 'index/index/'.$controller.'?cid='.$cid);
}


Route::rule('index','index/Index/index');
Route::get('detail/id/:id$', 'index/index/detail');