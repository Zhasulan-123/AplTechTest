<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\Product;

class ProductsController extends Controller
{

    public function actionIndex()
    {
        $response = Product::find()->orderBy(['id' => SORT_ASC])->all();
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $response;
    }

    public function actionBrand($name)
    {
        $minProductDb = Product::find()
            ->where(['brand_name' => $name])
            ->orderBy(['price' => SORT_ASC])
            ->limit(1)
            ->one();

        $maxProductDb = Product::find()
            ->where(['brand_name' => $name])
            ->orderBy(['price' => SORT_DESC])
            ->limit(1)
            ->one();

        $response = [
            ['min' => ['id' => $minProductDb->id, 'price' => $minProductDb->price]],
            ['max' => ['id' => $maxProductDb->id, 'price' => $maxProductDb->price]],
        ];

        Yii::$app->response->format = Response::FORMAT_JSON;
        return $response;
    }
}