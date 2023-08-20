<?php

namespace app\modules\api\controllers;

use Yii;
use app\modules\api\resources\ProductsResource;

/**
 * Class ProductsController
 *
 * @author Zhasulan Moldakulov <87028987788@mail.ru>
 * @package app\modules\api\controllers
 */
class ProductsController extends AuthController
{
    public $modelClass = ProductsResource::class;

	public function actions(){
		
		$actions = parent::actions();
		
		unset($actions['delete']);
		
		return $actions;
		
	}
}