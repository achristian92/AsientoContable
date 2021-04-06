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

    public function __invoke(int $customer, int $file)
    {
        return response()->json([
            'employees' => $this->employeeRepo->listEmployeeWithOutCostCenter($file,['id','full_name']),
        ]);
    }
}
