<?php 

namespace app\index\model;
use think\Model;

class Coder extends Model {

	public function coderData (){

		return $this->hasOne('coder_data', 'did');
	}
}