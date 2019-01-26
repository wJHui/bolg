<?php 

namespace app\index\controller;
use app\common\controller\Homebase;

class Index extends Homebase
{
	public function error (){

		$this->assign('d', 'dddd');
		return $this->fetch('404.html');
	}
}