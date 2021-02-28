<?php


namespace App\Http\Controllers\Front\Users;


use App\AsientoContable\Users\Repositories\IUser;
use App\AsientoContable\Users\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    private $userRepo;

    public function __construct(IUser $IUser)
    {
        $this->userRepo = $IUser;
    }

    public function store(UserRequest $request)
    {
        $user = $this->userRepo->createUser($request->all());

        if ($request->has('roles') && !empty($request->roles))
            $this->userRepo->syncRoles($user, $request->input('roles'));
        else
            $this->userRepo->assignDefaultRole($user);

        if ($request->has('all_customers')) {
            if ($request->has('customers_ids'))
                $this->userRepo->syncCustomers($user, $request->input('customers_ids'));
            else
                $this->userRepo->detachCustomers($user);
        }

        return response()->json(['msg' => 'Registro creado'],201);
    }

    public function update(UserRequest $request,User $user)
    {
        $this->userRepo->updateUser($request->all(),$user->id);

        if ($request->has('roles'))
            $this->userRepo->syncRoles($user, $request->input('roles'));
        else
            $this->userRepo->detachRoles($user);

        if ($request->has('all_customers')) {
            if ($request->has('customers_ids'))
                $this->userRepo->syncCustomers($user, $request->input('customers_ids'));
            else
                $this->userRepo->detachCustomers($user);
        }

        return response()->json(['msg' => 'Registro actualizado']);

    }
}
