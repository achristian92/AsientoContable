<?php


namespace App\AsientoContable\Concepts;


use App\AsientoContable\Files\File;
use Illuminate\Database\Eloquent\Model;

class Concept extends Model
{
    protected $table = 'concepts';

    CONST CODE = 'Cod. Trab.';
    CONST FULL_NAME = 'Apellidos y Nombres';

    CONST COSTCENTER = 'Centro Costo';
    CONST COSTNAME = 'C. Costo';

    CONST CODAREA = 'Cod. Area';
    CONST NAMEAREA = 'Area Trab.';

    CONST CODCARGO = 'Cód. Cargo';
    CONST NAMECARGO = 'Cargo';

    CONST DATE_ENTRY = 'Fec. Ing.';
    CONST DATE_TERMINATION = 'Fecha Cese';

    CONST NRO_DOC = 'Doc. Identidad';

    CONST PENSION_SHORT = 'Fondo de Pensiones';
    CONST CURRENCY = 'Moneda';

    CONST BASIC = 'Basico';
    CONST DAYFERIADO = 'D.Feriado';
    CONST WORKED_DAYS = 'Dias Trabajados';
    CONST TDSUB = 'Total de Dias Subsidiados';
    CONST TDNOTSUB = 'Total Dias No Subsidiados';

    CONST HOURS_EXT25  = 'H.E. 25 %'; //DEBE
    CONST WORKED_HOURS = 'Horas Trabajadas';
    CONST HOURS_EXT35  = 'H.E. 35 %'; //DEBE

    CONST MEDICAL_REST  = 'Dias Desc. Medico';
    CONST DAYSLV  = 'Dias Feriados Lun-Vie';

    CONST HE100 = 'H.E. 100 %';

    CONST WORKED_NOT_DAYS = 'Dias Falta';

    CONST BASEIMPONIBLE = 'Base Imponible';

    CONST LCGH = 'Dias Lic. con Goce';
    CONST LSINGH = 'Dias Lic. sin Goce';
    CONST DAYSSUBEMF = 'Dias Subs. Enfermedad';
    CONST DAYSSUBMAT = 'Dias Subs. Maternidad';
    CONST VACATION_DAYS = 'Dias Vacaciones';
    CONST VACATION_DAYS_VENC = 'Dias Vac. Vendidas';

    CONST BASIC_SALARY = 'Remuneración Basica'; //DEBE
    CONST OVERDUE_VACATION  = 'Vacaciones Vendidas';
    CONST WITH_FAMILY  = 'Asignación Familiar'; //DEBE
    CONST INGHE25  = 'Ingreso H.E. 25%';
    CONST INGHE35  = 'Ingreso H.E. 35%';
    CONST INGFERIADO  = 'Ingr. Feriados';
    CONST INGSUBENF  = 'Subs. Enfermedad';
    CONST INGSUBMAT  = 'Subs. Maternidad';
    CONST INGHE100  = 'Ingreso H.E. 100%';
    CONST INGMOV  = 'Movilidad';
    CONST EXTRA_BONUS  = 'Bonif.Extraor.LEY 30334';
    CONST INGCOMI  = 'Comisiones';
    CONST VACATION_PAY  = 'Remuneración Vacacional';
    CONST CTS          = 'Remuneración CTS';
    CONST TRUNCATED_VACATION  = 'Vacaciones Truncas';
    CONST TRUNCATED_GRATUITIES = 'Gratificaciones Truncas';
    CONST INGLCH = 'Lic. con Goce de Haber';
    CONST BONUS  = 'Bonificación';
    CONST INGREINA  = 'Reintegro Inafecto';
    CONST INGBONPROD  = 'Bono de Productividad';
    CONST INGOTRAFC  = 'Otros Ingresos Afect.';
    CONST AFFECTIVE_REFUND  = 'Reintegro Afecto';
    CONST TOTAL_INCOME  = 'TOTAL INGRESOS';

    //HABER
    CONST AFP_CONTRIBUTION = 'AFP. Aportación Obligator';
    CONST AFP_SURE_PRIME = 'AFP. Seguro de Vida';
    CONST AFP_COMISSION  = 'AFP. Comisión sobre la RA';
    CONST INASIS  = 'Inasistencia';
    CONST ADPAGO  = 'Adel. Pago';
    CONST PRESTAMOS  = 'Prestamos';
    CONST FIFTH_CATEGORY = 'Renta de 5ta. Categoria';
    CONST EGREADLVAC = 'Adel. Vacaciones';
    CONST EGREADQUIN = "<Adelanto de Quincena>";

    CONST TOTAL_DISCOUNT = 'TOTAL EGRESOS';

    CONST HEALTH = 'EsSalud';
    CONST TOTAL_CONTRIBUTION  = 'TOTAL APORT.';
    CONST NETO  = 'NETO';

    CONST HELTHPASIVO = 'EsSalud(P)';

    CONST ONP = 'O.N.P.';
    CONST COSTCENTER2 = '';
    //HABER

    protected $guarded = ['id'];

    public function file(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(File::class);
    }

}
