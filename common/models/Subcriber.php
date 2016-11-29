<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "subcriber".
 *
 * @property integer $id
 * @property integer $phone
 * @property string $name
 * @property integer $status
 * @property string $state
 * @property string $note_admin
 * @property string $address
 * @property integer $created_at
 * @property integer $updated_at
 */
class Subcriber extends \yii\db\ActiveRecord
{
    const STATUS_NOTCALL = 10; // chưa gọi
    const STATUS_ORDER = 9; // đã đặt hàng
    const STATUS_NOTORDER = 8; // không đặt hàng
    const STATUS_RECALL = 7; // gọi lại sau

    public  function  getListStatus(){
        $list1 = [
            self::STATUS_NOTCALL => 'Chưa gọi',
            self::STATUS_ORDER => 'Đặt hàng',
            self::STATUS_NOTORDER => 'Không đặt hàng',
            self::STATUS_RECALL => 'Gọi lại sau',
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
        return 'subcriber';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['phone','required','message'=>'Số điện thoại không được bỏ trống'],
            [['phone', 'status', 'created_at', 'updated_at'], 'integer'],
            [['state', 'note_admin'], 'string'],
            [['name', 'address'], 'string', 'max' => 255],
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
            'name' => 'Họ tên',
            'status' => 'Trạng thái',
            'state' => 'Tình trạng',
            'note_admin' => 'Ghi chú',
            'address' => 'Địa chỉ',
            'created_at' => 'Ngày tham gia',
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
        if($status == self::STATUS_NOTCALL){
            return '<span class="label label-danger">' . Subcriber::getStatusNameID($status) . '</span>';
        }
        if($status == self::STATUS_ORDER){
            return '<span class="label label-success">' . Subcriber::getStatusNameID($status) . '</span>';
        }
        if($status == self::STATUS_NOTORDER){
            return '<span class="label label-default">' . Subcriber::getStatusNameID($status) . '</span>';
        }
        if($status == self::STATUS_RECALL){
            return '<span class="label label-warning">' . Subcriber::getStatusNameID($status) . '</span>';
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

    public function getPriceTotal($number,$id_product){
        $pro = Product::findOne($id_product);
        $price = $pro->price;
        $total = $price*$number;
        return $total;
    }
}
