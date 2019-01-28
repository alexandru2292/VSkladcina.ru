<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = ['user_id', 'category_id', 'subcategory_id', 'type_id', 'name', 'title', 'subtitle','big_img',
                            'youtube_link', 'min_img',  'min_count', 'price_contribution','commission_contribution',
                            'sended_protection','purchase_after', 'full_form',  'date_collection','delivery_term',
                            'delivery',  'content', 'status', 'published', 'type',
                            'tags', 'type_contribution', 'price', 'count_peoples', 'star','created_at', 'updated_at'];


    protected $guarded = ['id', 'user_id', 'category_id', 'subcategory_id', 'type_id', 'name', 'title', 'subtitle','big_img',
                            'youtube_link', 'min_img',  'min_count', 'price_contribution','commission_contribution',
                           'sended_protection','purchase_after', 'full_form',  'date_collection','delivery_term',
                          'delivery',  'content', 'status','published', 'type',
                          'tags', 'type_contribution', 'price', 'count_peoples', 'star','created_at', 'updated_at'];
    public function hasType()
    {
        return $this->hasOne('App\Type', 'id', 'type_id');
    }
}
