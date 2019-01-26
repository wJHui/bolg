<?php
namespace app\index\controller;

use app\common\controller\Homebase;
use app\index\model\Article;



class Index extends Homebase
{
    public function index()
    {
      
        $row = [];
		$row['article'] = Article::withJoin('articleAata', 'LEFT')->select()->toArray();

    	$this->assign('row', $row);	
    
      	return $this->fetch();
    }

    public function detail (){
    	if(!$this->request->has('id')){
    		var_dump('none');
    	}

    	$id = $this->request->param('id/d');
    	$row = [];

    	$row['detail'] = Article::hasWhere('articleAata')->where('id', $id)->select();

    	var_dump($row['detail']->articleAata->content);

    	$this->assign('row', $row);
    	$this->fetch();
    }

}
