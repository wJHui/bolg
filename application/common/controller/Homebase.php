<?php
// +----------------------------------------------------------------------
// | Yzncms [ 御宅男工作室 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2018 http://yzncms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 御宅男 <530765310@qq.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 前台控制模块
// +----------------------------------------------------------------------
namespace app\common\controller;


use app\index\model\Config;
use app\index\model\Category;
use app\index\model\Imodel;
use think\facade\Route;
class Homebase extends Base
{
	public $site_global = [];
	protected function initialize (){
		parent::initialize();

		$this->site_global['config'] = Config::getConfig();

		$category = Category::getCategory();
		$category_array = $category->toarray();
		foreach($category as $k=>$v){
			$category[$k]->model = $v->model;
		}

		$this->site_global['category'] = $category->toArray();

		$this->assign('site_global', $this->site_global);
	}
}
