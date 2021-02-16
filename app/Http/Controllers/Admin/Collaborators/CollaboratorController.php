<?php


namespace App\Http\Controllers\Admin\Collaborators;


use App\AsientoContable\Collaborators\Repositories\ICollaborator;
use App\Http\Controllers\Controller;

class CollaboratorController extends Controller
{
    private $collaboratorRepo;

    public function __construct(ICollaborator $ICollaborator)
    {
        $this->collaboratorRepo = $ICollaborator;
    }

    public function index()
    {
        $collaborators = $this->collaboratorRepo->listCollaborators();
        return view('customers.collaborators.matriz.index',[
            'collaborators' => $collaborators
        ]);
    }
}
