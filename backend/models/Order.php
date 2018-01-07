<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $surname
 * @property string $name
 * @property string $country
 * @property string $region
 * @property string $city
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property string $paysystem
 * @property string $wallet
 * @property string $notes
 * @property string $status
 *
 * @property OrderItem[] $orderItems
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'integer'],
            [['surname', 'name', 'country', 'region', 'city', 'address', 'zip_code'], 'required'],
            [['address', 'notes'], 'string'],
			[['customer_type'], 'string', 'max' => 6],
			[['zip_code'], 'string', 'max' => 10],
            [['surname', 'name', 'country', 'region', 'paysystem', 'wallet'], 'string', 'max' => 30],
            [['city'], 'string', 'max' => 39],
            [['phone', 'email', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'surname' => 'Surname',
            'name' => 'Name',
            'country' => 'Country',
            'region' => 'Region',
            'city' => 'City',
            'address' => 'Address',
            'phone' => 'Phone',
            'email' => 'Email',
            'paysystem' => 'Paysystem',
            'wallet' => 'Wallet',
            'notes' => 'Notes',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['order_id' => 'id']);
    }
}
