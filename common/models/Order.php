<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $phone
 * @property integer $id_product
 * @property string $address
 * @property integer $number
 * @property integer $price
 * @property integer $status
 * @property integer $total
 * @property integer $id_user
 * @property integer $id_sub
 * @property integer $created_at
 * @property integer $updated_at
 */
class Order extends \yii\db\ActiveRecord
{
    const STATUS_SUCCESS = 10; // đã nhận tiền
    const STATUS_TRANSPORT = 9; // đang chuyển đi
    const STATUS_ERROR = 8; // thất lạc
    const STATUS_RETURN = 7; // hoàn trả
    const STATUS_TP = 6; // vừa đặt hàng xong
    const STATUS_TP1 = 5; // Đặt trên FE

    public  function  getListStatus(){
        $list1 = [
            self::STATUS_SUCCESS => 'Đã nhận hàng',
            self::STATUS_TRANSPORT => 'Đang chuyển đi',
            self::STATUS_ERROR => 'Thất lạc',
            self::STATUS_RETURN => 'Trả lại',
            self::STATUS_TP => 'Vừa đặt hàng',
            self::STATUS_TP1 => 'Đặt hàng trên WEB',
        ];

        return $list1;
    }

    public function getStatusName()
    {
        $lst = self::getListStatus();
        if (array_key_exists($this->status, $lst)) {
            return $lst[$this->status];
        }
        return $this->status;
    }
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
            [['phone', 'id_product', 'id_user', 'id_sub', 'number', 'price', 'status', 'total', 'created_at', 'updated_at'], 'integer'],
            [['address'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone' => 'Số điện thoại',
            'id_product' => 'Thuốc',
            'address' => 'Địa chỉ',
            'number' => 'Số lượng',
            'price' => 'Giá',
            'status' => 'Trạng thái',
            'total' => 'Tổng tiền',
            'id_user' => 'Người lập hóa đơn',
            'id_sub' => 'Khách hàng',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày thay đổi thông tin',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function getStatus($status){
        if($status == self::STATUS_ERROR){
            return '<span class="label label-danger">' . Order::getStatusNameID($status) . '</span>';
        }
        if($status == self::STATUS_SUCCESS){
            return '<span class="label label-success">' . Order::getStatusNameID($status) . '</span>';
        }
        if($status == self::STATUS_RETURN){
            return '<span class="label label-default">' . Order::getStatusNameID($status) . '</span>';
        }
        if($status == self::STATUS_TRANSPORT){
            return '<span class="label label-warning">' . Order::getStatusNameID($status) . '</span>';
        }
        if($status == self::STATUS_TP1){
            return '<span class="label label-info">' . Order::getStatusNameID($status) . '</span>';
        }
        if($status == self::STATUS_TP){
            return '<span class="label label-primary">' . Order::getStatusNameID($status) . '</span>';
        }
    }

    public static function getStatusNameID($status)
    {
        $lst = self::getListStatus();
        if (array_key_exists($status, $lst)) {
            return $lst[$status];
        }
        return $status;
    }
}
