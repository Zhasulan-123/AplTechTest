<?php

namespace app\modules\api\resources;


use app\modules\api\models\Product;

/**
 * Class ProductsResource
 *
 * @author Zhasulan Moldakulov <87028987788@mail.ru>
 * @package app\modules\api\resources
 */
class ProductsResource extends Product
{

    public function fields(){
        return [
                'id',
                'name',
                'category_name',
                'brand_name',
                'price',
                'rrp_price',
                'status'
        ];
    }

}