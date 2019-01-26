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

    	}

    	$id = $this->request->param('id/d');
    	$row = [];

    	$row['detail'] = Article::get($id);

    	$this->assign('row', $row);
    	$this->fetch();
    }

}
