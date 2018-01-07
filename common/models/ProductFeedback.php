<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_feedback".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $id_user
 * @property string $comment
 *
 * @property Product $product
 */
class ProductFeedback extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_feedback';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'id_user'], 'required'],
            [['product_id'], 'integer'],
            [['id_user'], 'string', 'max' => 11],
            [['comment'], 'string', 'max' => 255],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'id_user' => 'User',
            'comment' => 'Comment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
