<?php


namespace App\AsientoContable\Concepts;


use App\AsientoContable\Files\File;
use Illuminate\Database\Eloquent\Model;

class Concept extends Model
{
    protected $table = 'concepts';

    CONST CODE = 'Código';
    CONST FULL_NAME = 'Trabajador';
    CONST NRO_DOC = 'Nro Identidad';
    CONST AREA = 'Area';
    CONST POSITION = 'Cargo';

    CONST COSTCENTER = 'Centro Costo';
    CONST COSTCENTER2 = 'Centro Costo2';

    CONST WORKED_DAYS = 'Días trab';
    CONST WORKED_NOT_DAYS = 'Días no trab';
    CONST LCGH = 'Días L.C.G.H';
    CONST VACATION_DAYS = 'Días Vac';
    CONST WORKED_HOURS = 'Horas trab';
    CONST HOURS_EXT25 = 'Hs. Ext. 25%';
    CONST HOURS_EXT35 = 'Hs. Ext. 35%';

    CONST DATE_ENTRY = 'Fecha Ingreso';
    CONST DATE_TERMINATION = 'Fecha cese';
    CONST WITH_FAMILY = 'Asignación Familiar';
    CONST BASIC_SALARY = 'Remuneración basica';

    CONST PENSION_SHORT = 'Pension';
    CONST AFP_CONTRIBUTION = 'AFP Aportación';
    CONST AFP_SURE_PRIME = 'AFP Prima Seguro';
    CONST AFP_COMISSION  = 'AFP Comisión RA';
    CONST ONP = 'ONP';

    CONST TOTAL_INCOME = 'Total Ingresos';
    CONST TOTAL_DISCOUNT = 'Total Egresos';
    CONST TOTAL_CONTRIBUTION  = 'Total Aportes';


    CONST HEALTH = 'EsSalud';

    CONST FIFTH_CATEGORY = '5ta. Categoria';
    CONST NET = 'Neto';

    protected $guarded = ['id'];

    public function file(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(File::class);
    }

}
