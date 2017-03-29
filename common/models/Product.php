<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;

/**
 * This is the model class for table "Product".
 *
 * @property integer $id
 * @property string $image
 * @property string $name
 * @property string $des
 * @property string $short_des
 * @property integer $price
 * @property integer $sale
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Product extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 10; // hien
    const STATUS_BLOCK = 1; //an
    public  function  getListStatus(){
        $list1 = [
            self::STATUS_ACTIVE => 'Hoạt động',
            self::STATUS_BLOCK => 'Ẩn',
        ];

        return $list1;
    }

    public static function formatNumber($number)
    {
        return (new \yii\i18n\Formatter())->asInteger($number);
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
        return 'product';
    }
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['des','short_des'], 'string'],
            [['price', 'sale', 'status', 'created_at', 'updated_at'], 'integer'],
            [['image', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image' => 'Hình ảnh',
            'name' => 'Tên Thuốc',
            'des' => 'Mô tả',
            'short_des' => 'Mô tả ngắn',
            'price' => 'Giá',
            'sale' => 'Giảm giá',
            'status' => 'Trạng thái',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày thay đổi thông tin',
        ];
    }

    public function getImageLink()
    {
        $pathLink = Yii::getAlias('@web') . '/' . Yii::getAlias('@image_product') . '/';
        $filename = null;

        if ($this->image) {
            $filename = $this->image;

        }
        if ($filename == null) {
            $pathLink = Yii::getAlias("@web/img/");
            $filename = 'bg_df.png';
        }

        return Url::to($pathLink . $filename, true);
    }
    public static function getImageLinkStatic($image)
    {
        $pathLink = Yii::getAlias('@web') . '/' . Yii::getAlias('@image_product') . '/';
        $filename = null;

        if ($image) {
            $filename =$image;

        }
        if ($filename == null) {
            $pathLink = Yii::getAlias("@web/img/");
            $filename = 'bg_df.png';
        }

        return Url::to($pathLink . $filename, true);
    }

    public function substr($str, $length, $minword = 3)
    {
        $sub = '';
        $len = 0;
        foreach (explode(' ', $str) as $word) {
            $part = (($sub != '') ? ' ' : '') . $word;
            $sub .= $part;
            $len += strlen($part);
            if (strlen($word) > $minword && strlen($sub) >= $length) {
                break;
            }
        }
        return $sub . (($len < strlen($str)) ? '...' : '');
    }
}
