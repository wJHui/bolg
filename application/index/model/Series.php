<?php 

namespace app\index\model;

use think\Model;

class Series extends Model {
	public function seriesData (){

		return $this->hasOne('series_data', 'did');
	}
}