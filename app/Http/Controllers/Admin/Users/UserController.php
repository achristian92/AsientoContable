<?php


namespace App\Http\Controllers\Admin\Users;


use App\AsientoContable\Customers\Repositories\ICustomer;
use App\AsientoContable\Users\Repositories\IUser;
use App\Http\Controllers\Controller;
use App\Imports\UserImport;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    private $userRepo;
    private $customerRepo;

    public function __construct(IUser $IUser,ICustomer $ICustomer)
    {
        $this->userRepo = $IUser;
        $this->customerRepo = $ICustomer;
    }

    public function index()
    {
        $users = $this->userRepo->listUsers();
        return view('admin.users.index',compact('users'));
    }

    public function create()
    {
        return view('admin.users.create',[
            'model' => new User(),
            'customers' => $this->customerRepo->listCustomersActivated(),
            'roles'     => Role::all(),
        ]);
    }

    public function edit(User $user)
    {
        return view('admin.users.edit',[
            'model' => $this->userRepo->findUserById($user->id),
            'RolesIDS' => $user->roles()->pluck('id')->toArray(),
            'customers' => $this->customerRepo->listCustomersActivated(),
            'roles'     => Role::all()
        ]);
    }

    public function import(Request $request)
    {
        Excel::import(new UserImport(), $request->file('file_upload'));
        return redirect()
            ->route('admin.users.index')
            ->with('message','Información cargada');
    }

}
