<?php


namespace App\Http\Controllers\Front\Employees;


use App\AsientoContable\Collaborators\Repositories\ICollaborator;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    private $employeeRepo;

    public function __construct(ICollaborator $ICollaborator)
    {
        $this->employeeRepo = $ICollaborator;
    }

    public function __invoke(int $customer)
    {
        return response()->json([
            'employees' => $this->employeeRepo->listCollaborators(['id','full_name']),
        ]);
    }
}
