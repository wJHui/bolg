<?php
namespace app\index\controller;

use app\common\controller\Homebase;
class Index extends Homebase
{
    public function index()
    {
      return $this->fetch();
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}
