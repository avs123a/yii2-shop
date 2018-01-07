<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_attribute_value".
 *
 * @property integer $id
 * @property integer $attr_id
 * @property string $value
 *
 * @property OrderItemAttribute[] $orderItemAttributes
 * @property OrderItemAttribute[] $orderItemAttributes0
 * @property ProductAttributes $attr
 */
class ProductAttributeValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_attribute_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attr_id'], 'required'],
            [['attr_id','quantity_percent'], 'integer'],
			[['price_coef'], 'double'],
            [['value'], 'string', 'max' => 50],
            [['attr_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductAttributes::className(), 'targetAttribute' => ['attr_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'attr_id' => 'Attribute ID',
            'value' => 'Value',
			'price_coef' => 'Coefficient of Price',
			'quantity_percent' => '% of quantity',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItemAttributes()
    {
        return $this->hasMany(OrderItemAttribute::className(), ['attribute_id' => 'attr_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItemAttributes0()
    {
        return $this->hasMany(OrderItemAttribute::className(), ['attr_value_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttr()
    {
        return $this->hasOne(ProductAttributes::className(), ['id' => 'attr_id']);
    }
}
