<?php 

namespace app\index\model;

use think\Model;

class Category extends Model {
	
	public static function getCategory (){
		$result = self::where('status', 1)->select();
		return $result;
	}
}