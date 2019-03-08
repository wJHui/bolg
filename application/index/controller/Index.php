<?php
namespace app\index\controller;

use app\common\controller\Homebase;
use app\index\model\Article;
use app\index\model\Category;
use app\index\model\Tags;
use app\index\model\Series;
use app\index\model\Coder;
use think\facade\Env;


class Index extends Homebase
{
	public function initialize (){
        parent::initialize();

		if($this->request->has('cid')){
			/* 封面页分类 */
			$cid = $this->request->param('cid/d');
			$this->category = Category::get($cid)->toArray();   
		}

		// 公共模板路径
		$this->tpl = ROOT_PATH.'public/templates/default/cms/';
	}

	/*
	 *	首页
	 */
    public function index(){
      
        $result = [];
		$article = Article::withJoin('articleData', 'LEFT')->select()->toArray();
        
        foreach($article as $k=>$v){

            $preg = "/(<p[^>]*>\s*?<br\/>\s*?<\/p>\s?){3}.+/";
            $article[$k]['article_data']['content'] = preg_replace($preg, '', $v['article_data']['content']);

        }

        $result['article'] = $article;
        
        $this->assign('result', $result);	
    	return $this->fetch();
    }

    /*
	 * 新闻详情
    */
    public function articleDetail (){

       	if(!$this->request->has('id')){
            return $this->fetch(Env::get('app_path') . 'index/view/404.html');
        }

        $id = $this->request->param('id/d');
        
        $detail = Article::hasWhere('articleData')->get($id);
		$category = Category::get($detail['catid'])->toArray();

        $setting = unserialize($category['setting']);
       
        $preg = '/(<p[^>]*>\s*?<br\/>\s*?<\/p>\s?){3}/';
        $content = preg_replace($preg, '<p><br/></p>', $detail->articleData->content);

    
        $this->assign(array(
            'detail' => $detail,
            'content' => $content,
            'category' =>  $category
        ));
            
		return $this->fetch($this->tpl.$setting['show_template']);
    }

    
    /*
	 * 系列模型
    */
    public function series (){

    	$setting = unserialize($this->category['setting']);
    	$list = Tags::where('catid', $this->category['relationid'])->select()->toArray();

    	$this->assign([
    		'list' => $list
    	]);
    	
		return $this->fetch($this->tpl.$setting['category_template']);
    }

    /* 系列列表页 */
    function seriesList(){
        //$setting = unserialize($this->category['setting']);
        $id = $this->request->param('id');
        $tag = Tags::get($id);
        
        $result = Series::where('relation', $tag->title)->select()->toArray();
        
        $this->assign('result', $result);
        return $this->fetch($this->tpl.$setting['list_template']);
    }

    /* 代码详情页 */
    function seriesDetail(){

        if(!$this->request->has('id')){
            return $this->fetch(Env::get('app_path') . 'index/view/404.html');
        }

        $id = $this->request->param('id/d');
        
        $detail = Series::hasWhere('seriesData')->get($id);
        $category = Category::get($detail['catid'])->toArray();

        $setting = unserialize($category['setting']);
       
        //$preg = '/(<p[^>]*>\s*?<br\/>\s*?<\/p>\s?){3}/';
        $content = $detail->seriesData->markdown;

    
        $this->assign(array(
            'detail' => $detail,
            'content' => $content,
            'category' =>  $category
        ));
            
        return $this->fetch($this->tpl.$setting['show_template']);
    }


    /*
	 * 编程模型
    */
    public function coder (){

    	$setting = unserialize($this->category['setting']);

    	return $this->fetch($this->tpl.$setting['category_template']);
    }

    /* 编程详情页 */
    function coderDetail(){
        if(!$this->request->has('id')){
            return $this->fetch(Env::get('app_path') . 'index/view/404.html');
        }

        $id = $this->request->param('id/d');
        
        $detail = Coder::hasWhere('coderData')->get($id);
		$category = Category::get($detail['catid'])->toArray();

        $setting = unserialize($category['setting']);
       
        $preg = '/(<p[^>]*>\s*?<br\/>\s*?<\/p>\s?){3}/';
        $content = preg_replace($preg, '<p><br/></p>', $detail->articleData->content);

    
        $this->assign(array(
            'detail' => $detail,
            'content' => $content,
            'category' =>  $category
        ));
            
		return $this->fetch($this->tpl.$setting['show_template']);
    }
  
}
