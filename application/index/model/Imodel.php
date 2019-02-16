<?php 

namespace app\index\model;
use think\Model;

class Imodel extends Model {
	protected $table = 'yzn_model';
	
	public function category (){

		return $this->hasMany('Category', 'modelid');
	}
}	