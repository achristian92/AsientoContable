<?php


namespace App\Http\Controllers\Admin\Collaborators;


use App\AsientoContable\Collaborators\Collaborator;
use App\AsientoContable\Collaborators\Repositories\ICollaborator;
use App\AsientoContable\Files\File;
use App\AsientoContable\Tools\FileExcelRequest;
use App\AsientoContable\Tools\UploadableTrait;
use App\Exports\EmployeeExport;
use App\Exports\TemplateEmployee;
use App\Http\Controllers\Controller;
use App\Imports\EmployeeImport;
use App\Models\History;
use Maatwebsite\Excel\Facades\Excel;

class CollaboratorController extends Controller
{
    use UploadableTrait;

    private $employeeRepo;

    public function __construct(ICollaborator $ICollaborator)
    {
        $this->employeeRepo = $ICollaborator;
    }

    public function index()
    {
        $collaborators = $this->employeeRepo->listCollaborators();
        return view('customers.collaborators.matriz.index',[
            'collaborators' => $collaborators
        ]);
    }

    public function show(int $customer_id, int $collaborator_id)
    {

        $collaborator = Collaborator::find($collaborator_id);

        $concepts_id = $collaborator->concepts->pluck('file_id')->unique();

        $files = File::with('createdby')->whereIn('id',$concepts_id)->get();

        return view('customers.collaborators.matriz.show', [
            'collaborator' => $collaborator,
            'files' => $files
        ]);
    }

    public function destroy(int $customer_id, int $collaborator_id)
    {
        $collaborator = Collaborator::find($collaborator_id);

        if ($collaborator->concepts()->exists())
            return redirect()->route('admin.customers.collaborators.index',$customer_id)->with('error','No se puede eliminar porque tiene planillas registradas(Ver detalle).');


        $collaborator->delete();

        return redirect()->route('admin.customers.collaborators.index',$customer_id)
            ->with('message','Colaborador eliminado');

    }

    public function template(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $headers = ['NOMBRES COMPLETO','CÓDIGO','TIPO DOC','NRO DOC','FECHA INGRESO','CUSPP','AUTOGENERADO','SIT ESPECIAL'];
        return Excel::download(new TemplateEmployee($headers), 'COLABORADORES-PLANTILLA.xlsx');
    }

    public function import(FileExcelRequest $request,int $customer)
    {
        Excel::import(new EmployeeImport($customer), $request->file('file_upload'));

        $url = $this->handleUploadedDocument($request->file('file_upload'),'import');
        history(History::IMPORT_TYPE,"Importó colaboradores",$url);

        return redirect()
            ->route('admin.customers.collaborators.index',$customer)
            ->with('message','Información cargada');
    }

    public function export(int $customer)
    {
        $data = $this->employeeRepo->exportEmployees($customer);
        $url = $this->handleDocumentS3(new EmployeeExport($data),'LISTA-COLABORADORES.xlsx');
        history(History::EXPORT_TYPE,"Exporto colaboradores",$url);

        return Excel::download(new EmployeeExport($data), 'LISTA-COLABORADORES.xlsx');
    }
}
