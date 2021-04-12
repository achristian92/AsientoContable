<?php


namespace App\AsientoContable\Tools;


use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

trait UploadableTrait
{
    public function handleUploadedImage(UploadedFile $file,$folder = 'general', $disk = 'public')
    {
        $name = Carbon::now()->format('H-i-s').'-'.$file->getClientOriginalName();
        $filePath = "$folder/" . $name;
        Storage::disk('s3')->put($filePath, file_get_contents($file),$disk);

        return  Storage::disk('s3')->url($filePath);
    }

    public function handleUploadedDocument(UploadedFile $file,$folder = 'documents', $disk = 'public')
    {
        $name = Carbon::now()->format('H-i-s').'-'.$file->getClientOriginalName();
        $filePath = "$folder/" . $name;
        Storage::disk('s3')->put($filePath, file_get_contents($file),$disk);

        return  Storage::disk('s3')->url($filePath);
    }

    public function handleDocumentS3($file,string $filename,$folder = 'documents/', $visibility = 'public')
    {
        Excel::store($file, $folder.$filename,'s3',null,[
            'visibility' => $visibility,
        ]);
        return  Storage::disk('s3')->url($folder.$filename);

    }

}
