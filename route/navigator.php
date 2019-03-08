<?php

use app\index\model\Category;

$category = Category::getCategory();

foreach($category as $k=>$v){
	$catdir = $v['catdir'];
	$cid = $v['id'];
	$controller = $v->model->tablename;

	Route::get($catdir, 'index/index/'.$controller.'?cid='.$cid);
	Route::get($catdir.'_detail/id/:id$', 'index/index/'.$catdir.'_detail');
	Route::get($catdir.'_list/id/:id$', 'index/index/'.$catdir.'_list');
}


Route::rule('index','index/Index/index');

