<?php
namespace backend\models;

use common\models\OrderDetail;
use common\models\Report;
use DateTime;
use Yii;
use yii\base\Model;

/**
 * Login form
 */
class FormReport extends Model
{
    public $to_date;
    public $from_date;
    public $content = null;
    public $dataProvider;

    public function rules()
    {
        return [
            [['from_date', 'to_date', 'content'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'to_date' => 'Đến Ngày',
            'from_date' => 'Từ Ngày',
        ];
    }

    public function generateReport()
    {

        if ($this->from_date == '' &&  $this->to_date == '') {
            $to_date = (new DateTime('now'))->format('Y-m-d');
            $from_date = (new DateTime('now'))->modify('-7 days')->format('Y-m-d');
        }elseif($this->from_date != '' && $this->to_date != '')
        {
            $date_to_tp = str_replace('/', '-', $this->to_date);
            $date_from_tp = str_replace('/', '-', $this->from_date);
            $to_date = date('Y-m-d',strtotime($date_to_tp));
            $from_date = date('Y-m-d',strtotime($date_from_tp));
        }else
        {
            if ($this->to_date != '') {
                $date_to_tp = str_replace('/', '-', $this->to_date);
                $to_date = date('Y-m-d',strtotime($date_to_tp));
            } else {
                $to_date = (new DateTime('now'))->format('Y-m-d');
            }

            if ($this->from_date != '') {
                $date_from_tp = str_replace('/', '-', $this->from_date);
                $from_date = date('Y-m-d',strtotime($date_from_tp));
            } else {
                $from_date = (new DateTime('now'))->format('Y-m-d');
            }
        }

        $report_daily = Report::find()
            ->andwhere('date >= :p_from_date', [':p_from_date' => $from_date])
            ->andWhere('date <= :p_to_date', [':p_to_date' => $to_date])
            ->groupBy('date');

        $this->content = $report_daily;
    }
}
