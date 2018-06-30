<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Advertisement extends Model
{
    public $table = "advertisements";
    public $fillable = ['content', 'arrange', 'image', 'contact_phone', 'start_publish', 'end_publish', 'created_at', 'updated_at'];
    public $primaryKey = "id";


    /**
     *
     * get available website's ads
     *
     * @param null $ads_id
     * @return $this|Model|\Illuminate\Support\Collection|null|static
     */
    public static function getAvailableAds($ads_id = null)
    {
        $advertisements = Advertisement::whereDate('start_publish', '<=', Carbon::now())
            ->whereDate('end_publish', '>=', Carbon::now())->orderBy('arrange', 'asc');
        if ($ads_id) {
            $advertisements = $advertisements->where(['id' => $ads_id])->first();
            if (!$advertisements)
                return error(trans('lang.ads_is_not_found'));
            if ($advertisements->image) {
                $advertisements['image'] = URL::to('/') . $advertisements->image;
            }
        } else {
            $advertisements = $advertisements->get()->map(function ($item) {
                if ($item->image) {
                    $item['image'] = URL::to('/') . $item->image;
                }
                return $item;
            });
        }

        return $advertisements;
    }


}
