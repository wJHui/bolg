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

class Homebase extends Base
{
	public $site_global = [];
	protected function initialize (){
		parent::initialize();

		$this->site_global['config'] = Config::getConfig()->toArray();

		$this->assign('site_global', $this->site_global);
	}
}
