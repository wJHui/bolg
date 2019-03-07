<?php 

namespace app\index\model;
use think\Model;

class Article extends Model {

	public function articleData (){

		return $this->hasOne('article_data', 'did');
	}
}