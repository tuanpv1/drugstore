<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $image
 * @property string $name
 * @property string $des
 * @property string $short_des
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 */
class Post extends \yii\db\ActiveRecord
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
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['des'], 'string'],
            [['created_at', 'updated_at', 'status'], 'integer'],
            [['image', 'name','short_des'], 'string', 'max' => 255],
            [['image'], 'required', 'message' => 'Hình ảnh đại diện không được để trống','on'=>'create'],
            [[ 'name'], 'required', 'message' => 'Tên bài viết không được để trống'],
            [['short_des'], 'required', 'message' => 'Mô tả ngắn không được để trống'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image' => 'Hình ảnh đại diện',
            'name' => 'Tên bài viết',
            'des' => 'Mô tả',
            'short_des' => 'Mô tả ngắn',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày thay đổi thông tin',
            'status' => 'Trạng thái',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function getImageLink()
    {
        $pathLink = Yii::getAlias('@web') . '/' . Yii::getAlias('@image_post') . '/';
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
}
