<?php


namespace App\Voucher\Users\Repositories;


use App\Mail\SendEmailNewUser;
use App\Models\User;
use App\Repositories\Settings\Repository\SetupRepo;
use App\Repositories\UsersHistories\UserHistory;
use Auth;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Prettus\Repository\Eloquent\BaseRepository;

class UserRepo extends BaseRepository implements IUser
{

    public function model()
    {
        return User::class;
    }

    public function listUsers($columns = array('*'), string $orderBy = 'id', string $sortBy = 'asc'): Collection
    {
        return $this->model->where('company_id', Auth::user()->company->id)->get();
    }

    public function createUser(array $data): User
    {
        $plainPassword        = _add4NumRand($data['name']);
        $data['raw_password'] = $plainPassword;
        $data["password"]     = bcrypt($plainPassword);
        $user                 = $this->model->create($data);
        $this->sendEmailNewCredentials($user);

        return $user;
    }

    public function syncRoles(User $user, array $params): void
    {
        $user->roles()->sync($params);
    }

    public function detachRoles(User $user): void
    {
        $user->roles()->detach();
    }

    public function sendEmailNewCredentials(User $user)
    {
        Mail::to($user->email)->send(new SendEmailNewUser($user));
    }
}
