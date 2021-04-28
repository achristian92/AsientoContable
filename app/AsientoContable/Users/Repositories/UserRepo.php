<?php


namespace App\AsientoContable\Users\Repositories;


use App\Mail\SendEmailNewUser;
use App\Models\History;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Prettus\Repository\Eloquent\BaseRepository;

class UserRepo extends BaseRepository implements IUser
{

    public function model()
    {
        return User::class;
    }
    public function findUserById(int $id): User
    {
        return $this->model::with('customers')->findOrFail($id);
    }

    public function listUsers($columns = array('*'), string $orderBy = 'name', string $sortBy = 'asc'): Collection
    {
        return $this->model::with('customers','roles')->orderBy($orderBy,$sortBy)->get();
    }

    public function createUser(array $data): User
    {
        $plainPassword        = _add4NumRand($data['name']);
        $data['raw_password'] = $plainPassword;
        $data["password"]     = bcrypt($plainPassword);
        $data["notified"]     = true;
        $user                 = $this->model->create($data);
        $this->sendEmailNewCredentials($user);
        history(History::CREATED_TYPE,"Creó el usuario $user->full_name");

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
        if ($user->email && Setting::first()->send_credentials)
            Mail::to($user->email)->send(new SendEmailNewUser($user));
    }


    public function updateUser(array $data, int $id): bool
    {
        $user = $this->findUserById($id);
        history(History::UPDATED_TYPE,"Actualizó el usuario $user->full_name");
        return $user->update($data);
    }

    public function assignDefaultRole(User $user): User
    {
        return $user->assignRole('Usuario');
    }
    public function syncCustomers(User $user, array $params): void
    {
        $user->customers()->sync($params);
    }

    public function detachCustomers(User $user): void
    {
        $user->customers()->detach();
    }
}
