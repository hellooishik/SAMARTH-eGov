<?php

namespace app\models;

use yii\db\ActiveRecord;

class Post extends ActiveRecord
{
    
    public function rules()
    {
        
        return [
            [['Title', 'categories', 'details', 'price', 'supplier'], 'required']
        ];
    }
}
