<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "report".
 *
 * @property integer $id
 * @property string $date
 * @property integer $total
 * @property integer $number
 * @property integer $number_success
 * @property integer $number_error
 * @property integer $number_tranport
 * @property integer $number_return
 * @property integer $number_ordered
 * @property integer $number_ordered1
 * @property integer $total_success
 * @property integer $total_error
 * @property integer $total_tranport
 * @property integer $total_return
 * @property integer $total_ordered
 * @property integer $total_ordered1
 */
class Report extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'report';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['total', 'number', 'number_success', 'number_error', 'number_tranport', 'number_return', 'number_ordered','number_ordered1', 'total_success', 'total_error', 'total_tranport', 'total_return', 'total_ordered', 'total_ordered1'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'total' => 'Tổng',
            'number' => 'SL',
            'number_success' => 'SL Hoàn thành',
            'number_error' => 'SL Thất lạc',
            'number_tranport' => 'SL Chuyển đi',
            'number_return' => 'SL Trả về',
            'number_ordered' => 'SL Đặt ',
            'number_ordered1' => 'SL Đặt FE',
            'total_success' => 'Tổng Hoàn thành',
            'total_error' => 'Tổng Thất lạc',
            'total_tranport' => 'Tổng Chuyển đi',
            'total_return' => 'Tổng trả về',
            'total_ordered' => 'Tổng đặt',
            'total_ordered1' => 'Tổng đặt FE',
        ];
    }
}
