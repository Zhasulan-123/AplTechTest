<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property int $id
 * @property string $name
 * @property string $category_name
 * @property string $brand_name
 * @property int $price
 * @property int $rrp_price
 * @property int $status
 */
class Product extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
        ];
    }

}