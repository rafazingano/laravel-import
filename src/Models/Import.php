<?php

namespace ConfrariaWeb\Import\Models;

use ConfrariaWeb\Historic\Traits\HistoricTrait;
use Illuminate\Database\Eloquent\Model;

class Import extends Model
{

    use HistoricTrait;

    protected $fillable = ['type_id', 'user_id', 'name', 'file', 'settings'];
    protected $casts = ['settings' => 'collection'];

    public function type()
    {
        return $this->belongsTo('ConfrariaWeb\Import\Models\ImportType', 'type_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
