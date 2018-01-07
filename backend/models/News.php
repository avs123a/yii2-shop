<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $newsID
 * @property string $news_title
 * @property string $news_text
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['news_title', 'news_text'], 'required'],
            [['news_title'], 'string', 'max' => 30],
            [['news_text'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'newsID' => 'News ID',
            'news_title' => 'News Title',
            'news_text' => 'News Text',
        ];
    }
}
