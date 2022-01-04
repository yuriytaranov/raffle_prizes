<?php

namespace app\controllers;
use app\Controller;
use app\http\Response;
use app\models\ListModel;

class ListController extends Controller {
    public function list(): Response
    {
        $model = new ListModel();
        $list = $model->list();
        app()->response->json->success($list);
        return app()->response; 
    }

    public function create(): Response
    {
        $model = new ListModel();
        $model->name = "Hello World";
        $model->insert();
        app()->response->json->success($model->array());
        return app()->response;
    }

    public function item($itemIndex): Response
    {
        $model = new ListModel();
        $model->one('id', $itemIndex);
        if(null !== $model->id) {
            app()->response->json->success($model->array());
            return app()->response;
        }
        app()->response->json->error(404, 'No item with this number');
        return app()->response;
    }
}