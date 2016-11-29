<?php

namespace backend\models;

use common\models\Subcriber;
use Yii;

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
class FormSub extends Subcriber
{
    public $number;
    public $id_product;
    public function rules()
    {
        return [
            ['phone','required','message'=>'Số điện thoại không được bỏ trống'],
            [['phone', 'status', 'created_at', 'updated_at','id_product', 'number'], 'integer','message'=>'Vui lòng nhập kiểu số'],
            [['state', 'note_admin'], 'string'],
            [['name', 'address'], 'string', 'max' => 255],
        ];
    }

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
            'id_product' => 'Sản phẩm',
            'number' => 'Số lượng',
            'created_at' => 'Ngày tham gia',
            'updated_at' => 'Ngày thay đổi thông tin',
        ];
    }
}