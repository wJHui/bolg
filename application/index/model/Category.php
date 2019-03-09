<?php 

namespace app\index\model;

use think\Model;

class Category extends Model {
	
	public function model()
    {
        return $this->belongsTo('Imodel', 'modelid');
    }

	public static function getCategory (){
		$result = self::where('status', 1)->order('listorder', 'asc')->select();
		return $result;
	}
}