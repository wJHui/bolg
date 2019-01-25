<?php 

namespace app\index\model;
use think\Model;

class Article extends Model {

	public function articleAata (){

		return $this->hasOne('article_data', 'did');
	}
}