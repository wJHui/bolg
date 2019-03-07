<?php
namespace app\index\controller;

use app\common\controller\Homebase;
use app\index\model\Article;
use app\index\model\Category;
use app\index\model\Tags;
use app\index\model\Series;
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

    public function index(){
      
        $result = [];

		$article = Article::withJoin('articleData', 'LEFT')->select()->toArray();
        
        foreach($article as $k=>$v){
            $preg = "/(<p[^>]*>\s*?<br\/>\s*?<\/p>\s?){3}.+/";
            //var_dump($article[$k]);
            $article[$k]['article_data']['content'] = preg_replace($preg, '', $v['article_data']['content']);

        }

        $result['article'] = $article;
        
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
    	//$cid = $this->request->param('cid/d');
    	//var_dump($cid);
    	$list = Tags::where('catid', $this->category['relationid'])->select()->toArray();

    	$this->assign([
    		'list' => $list
    	]);
    	
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


    /* 系列列表页 */
    function list(){
        //$setting = unserialize($this->category['setting']);
        $id = $this->request->param('id');
        $tag = Tags::get($id);
        
        $result = Series::where('relation', $tag->title)->select()->toArray();
        
        $this->assign('result', $result);
        return $this->fetch();
    }

    /*
     * 详情
    */
    public function lists_detail(){

        if(!$this->request->has('id')){
            return $this->fetch(Env::get('app_path') . 'index/view/404.html');
        }

        $id = $this->request->param('id/d');
        $result = [];

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

    /* 代码详情页 */
    function code(){
        $setting = unserialize($this->category['setting']);

        return $this->fetch($this->tpl.$setting['show_template']);
    }

}
