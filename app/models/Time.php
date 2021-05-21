<?php
namespace Time\Models;
use Phalcon\Mvc\Model;

class Time extends Model
{
    public function initialize()
    {
        $this->setSource('tracker');
        $this->belongsTo('user_id', __NAMESPACE__ . '\Users', 'id', [
            'alias' => 'user',
            'reusable' => true
        ]);
    }


    public static function changeFormatTime($sum)
    {
        // Total
        if ($sum <= 0) {
            return '00: 00';
        } else {
            return sprintf("%02d", floor($sum / 60)) . ':' . sprintf("%02d", str_pad(($sum % 60), 2, "0", STR_PAD_LEFT)) . "";
        }
    }
    public static function allDayInMonth(){
        $dates = [];
        for($i = 1; $i <=  date('t'); $i++)
        {
            // add the date to the dates array
            $dates[] = date('Y') . "-" . date('m') . "-" . str_pad($i, 2, '0', STR_PAD_LEFT);
        }
        return $dates;
    }
}
