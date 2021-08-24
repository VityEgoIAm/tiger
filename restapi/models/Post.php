<?php

namespace restapi\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $text
 *
 * @property User $user
 */
class Post extends \common\models\Post
{
    public function fields()
    {
        return [
            'id',
            'text',
            'author' => function () {
                return $this->user->username;
            },
        ];
    }
}
