<?php

namespace Models\Redis;

use \Redis;
use Carbon\Carbon;

class Ranks
{

    const PREFIX = 'rank:';

    protected $redis = null;


    public function __construct(Redis $redis)
    {
        $this->redis = $redis;
    }


    public function addScores($member, $scores)
    {
        $key = self::PREFIX . date('Ymd');
        return $this->redis->zIncrBy($key, $scores, $member);
    }


    protected function getOneDayRankings($date, $start, $stop)
    {
        $key = self::PREFIX . $date;
        return $this->redis->zRevRange($key, $start, $stop, true);
    }


    protected function getMultiDaysRankings($dates, $outKey, $start, $stop)
    {
        $keys = array_map(function ($date) {
            return self::PREFIX . $date;
        }, $dates);

        $weights = array_fill(0, count($keys), 1);
        $this->redis->zUnion($outKey, $keys, $weights);
        return $this->redis->zRevRange($outKey, $start, $stop, true);
    }


    public function getYesterdayTop10()
    {
        $date = Carbon::now()->subDays(1)->format('Ymd');
        return $this->getOneDayRankings($date, 0, 9);
    }


    public static function getCurrentMonthDates()
    {
        $dt = Carbon::now();
        $days = $dt->daysInMonth;

        $dates = array();
        for ($day = 1; $day <= $days; $day++) {
            $dt->day = $day;
            $dates[] = $dt->format('Ymd');
        }
        return $dates;
    }


    public function getCurrentMonthTop10()
    {
        $dates = self::getCurrentMonthDates();
        return $this->getMultiDaysRankings($dates, 'rank:current_month', 0, 9);
    }

}