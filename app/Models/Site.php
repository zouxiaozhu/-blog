<?php

namespace App\Models;

class Site extends Base
{
    public function oauthUser()
    {
        return $this->belongsTo(OauthUser::class);
    }

    public function setUrlAttribute($value)
    {
        // 如果没有http 则补上http
        if (strpos($value, 'http') === false) {
            $value = 'http://'.$value;
        }
        // 删除右侧的/
        $value = rtrim($value, '/');
        $this->attributes['url'] = strtolower($value);
    }
}
