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

    CONST DATE_ENTRY = 'Fecha Ingreso';
    CONST DATE_TERMINATION = 'Fecha cese';

    CONST PENSION_SHORT = 'Fondo de Pensiones';
    CONST AFP_CONTRIBUTION = 'AFP Aportación';
    CONST AFP_SURE_PRIME = 'AFP Prima Seguro';
    CONST AFP_COMISSION  = 'AFP Comisión RA';
    CONST ONP = 'ONP';

    CONST TOTAL_INCOME = 'Total Ingresos';
    CONST TOTAL_DISCOUNT = 'Total Egresos';
    CONST TOTAL_CONTRIBUTION  = 'Total Aportes';

    //DEBE
    CONST BASIC_SALARY = 'Remuneración Basica';
    CONST WITH_FAMILY  = 'Asignación Familiar';
    CONST HOURS_EXT25  = 'Ingreso H.E. 25%';
    CONST HOURS_EXT35  = 'Ingreso H.E. 35%';
    CONST TRUNCATED_GRATUITIES = 'Gratificaciones Truncas';
    CONST EXTRA_BONUS  = 'Bonif.Extraor.LEY 30334';
    CONST CTS          = 'Remuneración CTS';
    CONST TRUNCATED_VACATION  = 'Vacaciones Truncas';
    CONST OVERDUE_VACATION  = 'Vacaciones Vendidas';
    CONST VACATION_PAY  = 'Remuneración Vacacional';
    CONST BONUS  = 'Bonificación';
    CONST WORK_CONDITION  = 'Condicion de Trabajo';
    CONST MEDICAL_REST  = 'Descanso Medico';
    CONST AFFECTIVE_REFUND  = 'Reintegro Afecto';
    CONST HEALTH = 'EsSalud';
    //HABER
    CONST FIFTH_CATEGORY = 'Renta de 5ta. Categoría';
    CONST NET = 'Sueldo';

    protected $guarded = ['id'];

    public function file(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(File::class);
    }

}
