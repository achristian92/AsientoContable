<?php


namespace App\AsientoContable\Concepts;


use App\AsientoContable\Files\File;
use App\AsientoContable\Payrolls\Payroll;
use Illuminate\Database\Eloquent\Model;

class Concept extends Model
{
    protected $table = 'concepts';

    protected $guarded = ['id'];

    public function file(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(File::class);
    }

}
