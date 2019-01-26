<?php 

namespace app\index\model;

use think\Model;

class Config extends Model {
	public static function getConfig(){

		$result = self::field('name, title, value, status')->select();
		return $result;
	}
}