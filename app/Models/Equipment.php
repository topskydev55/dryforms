<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    /**
     * @var string
     */
    protected $table = 'equipments';

    /**
     * @var array
     */
    protected $fillable = [
        'model_id', 'category_id', 'status_id', 'team_id', 'serial', 'location', 'company_id'
    ];

    protected $visible = [
        'model_id',
        'category_id',
        'status_id',
        'team_id',
        'serial',
        'location',
        'company_id',

        'model',
        'status',
        'category',
        'team',
        'company'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function model()
    {
        return $this->belongsTo(EquipmentModel::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
