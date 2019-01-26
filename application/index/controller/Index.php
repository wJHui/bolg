<?php
namespace app\index\controller;

use app\common\controller\Homebase;
use app\index\model\Article;
use think\facade\Env;


class Index extends Homebase
{
    public function index()
    {
      
        $jia = [];

		$jia['article'] = Article::withJoin('articleAata', 'LEFT')->select()->toArray();

    	$this->assign('jia', $jia);	
    
      	return $this->fetch();
    }

    public function detail (){
    	if(!$this->request->has('id')){
            return $this->fetch(Env::get('app_path') . 'index/view/404.html');
    	}

    	$id = $this->request->param('id/d');
    	$jia = [];

    	$detail = Article::hasWhere('articleAata')->find();
        $jia['detail'] = $detail;
    	

    	$this->assign('jia', $jia);
        return $this->fetch();
    }

}
