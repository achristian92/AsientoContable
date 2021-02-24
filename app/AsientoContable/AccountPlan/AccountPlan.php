<?php


namespace App\AsientoContable\AccountPlan;


use Illuminate\Database\Eloquent\Model;

class AccountPlan extends Model
{
    protected $table = 'account_plan';

    protected $guarded = ['id'];

    const TYPE_ROOT = 'root';
    const TYPE_SUBACCOUNT = 'subAccount';
    const TYPE_ACCOUNT = 'account';


    public function parent()
    {
        return $this->belongsTo(AccountPlan::class,'parent_id','code');
    }

    public function children()
    {
        return $this->hasMany(AccountPlan::class,'parent_id','code');
    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }

    public function parents()
    {
        return $this->belongsTo(self::class,'parent_id','code')->with('parent');
    }

}
