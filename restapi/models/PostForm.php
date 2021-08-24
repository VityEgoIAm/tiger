<?php

namespace restapi\models;

use Yii;
use yii\base\Model;
use restapi\models\Post;

/**
 * Post form
 */
class PostForm extends Model
{
    public $accessToken;
    public $text;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['accessToken', 'text'], 'required'],
        ];
    }

    public function savePost()
    {
        $user = $this->getUser();
        if ($user && $this->validate()) {
            $model = new Post();

            $model->text = $this->text;
            $model->user_id = $user->id;
            
            if($model->save()) {
                return true;
            }        
        }
        
        return false;
    }

    /**
     * Finds user by [[accessToken]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findIdentityByAccessToken($this->accessToken);
        }

        return $this->_user;
    }
}
