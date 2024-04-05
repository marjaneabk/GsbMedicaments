<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicament extends Model
{
    protected $table = 'medicament';
    protected $primaryKey = 'id_medicament';
    public $timestamps = false;

    public function contraindicated_drugs()
    {
        return $this->belongsToMany(Medicament::class, 'interagir', 'id_medicament', 'med_id_medicament');
    }

}
