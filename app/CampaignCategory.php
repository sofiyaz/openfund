<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CampaignCategory
 * @package App
 */
class CampaignCategory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'campaign_categories';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug', 'label', 'description',
    ];

    /**
     * @param $query
     * @param $slug
     * @return mixed
     */
    public function scopeBySlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }
    
    public function scopeGetCategories()
    {
        return $query->select('*');
    }
}
