<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "method".
 *
 * @property integer $id
 * @property string $title
 * @property string $wmid_or_merchant
 * @property string $wallet
 */
class Method extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'method';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'wallet'], 'required'],
            [['title', 'wmid_or_merchant', 'wallet'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'wmid_or_merchant' => 'Wmid Or Merchant',
            'wallet' => 'Wallet',
        ];
    }
}
