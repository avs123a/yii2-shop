<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_items_attribute".
 *
 * @property integer $id
 * @property integer $item_id
 * @property string $attr_title
 * @property string $attr_value
 *
 * @property OrderItem $item
 */
class OrderItemsAttribute extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_items_attribute';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'attr_title', 'attr_value'], 'required'],
            [['item_id'], 'integer'],
            [['attr_title', 'attr_value'], 'string', 'max' => 50],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderItem::className(), 'targetAttribute' => ['item_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_id' => 'Item ID',
            'attr_title' => 'Attr Title',
            'attr_value' => 'Attr Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(OrderItem::className(), ['id' => 'item_id']);
    }
}
