<?php
namespace app\index\controller;

use app\common\controller\Homebase;
use app\index\model\Article;
use app\index\model\Category;
use think\facade\Env;


class Index extends Homebase
{
	public function initialize (){
        parent::initialize();

		if($this->request->has('cid')){
			$cid = $this->request->param('cid/d');
			$this->category = Category::get($cid)->toArray();
		}

		// 公共模板路径
		$this->tpl = ROOT_PATH.'public/templates/default/cms/';
	}

    public function index()
    {
      
        $result = [];

		$result['article'] = Article::withJoin('articleAata', 'LEFT')->select()->toArray();

        $this->assign('result', $result);	
    
      	return $this->fetch();
    }

    
    /*
	 * 文章模型
    */
    public function article (){
    	$setting = unserialize($this->category['setting']);
    	

    	return $this->fetch($this->tpl.$setting['category_template']);
    }


    /*
	 * 系列模型
    */
    public function series (){
    	$setting = unserialize($this->category['setting']);
    	

    	return $this->fetch($this->tpl.$setting['category_template']);
    }

    /*
	 * 编程模型
    */
    public function coder (){
    	$setting = unserialize($this->category['setting']);
    	

    	return $this->fetch($this->tpl.$setting['category_template']);
    }

    /*
	 * 详情
    */
    public function detail (){
        
        if(!$this->request->has('id')){
            return $this->fetch(Env::get('app_path') . 'index/view/404.html');
        }

        $id = $this->request->param('id/d');
        $result = [];

        $detail = Article::hasWhere('articleAata')->find();

        $result['detail'] = $detail;
            
        $this->assign('result', $result);
            return $this->fetch();
        }

    }
