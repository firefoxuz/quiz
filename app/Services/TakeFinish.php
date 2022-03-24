<?php

namespace App\Services;

use App\Models\Take;
use Carbon\Carbon;

class TakeFinish
{
    public function __invoke()
    {
        $takes = $this->getUnfinishedTakes();
        $count = 0;
        foreach ($takes as $take) {
            if ($this->isExpired($take)) {
                $this->finish($take);
                $count++;
            }
        }
        return $count;
    }

    private function getUnfinishedTakes()
    {
        return Take::query()->where('status', 1)->get();
    }

    private function isExpired(Take $take)
    {
        return Carbon::createFromTimeString( $take->ends_at)->isPast();
    }

    private function finish(Take $take)
    {
        $take->status = 2;
        $take->save();
    }
}
