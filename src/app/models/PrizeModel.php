<?php

namespace app\models;

class PrizeModel extends \app\Model {
    public $table = 'prizes';
    public $kind = [
        0 => 'money',
        1 => 'prize',
        2 => 'score',
    ];

    public function getRandom() {
        
    }
}