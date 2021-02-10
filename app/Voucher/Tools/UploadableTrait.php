<?php


namespace App\Voucher\Tools;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait UploadableTrait
{
    public function handleUploadedImage(UploadedFile $file,$folder = 'general', $disk = 'public')
    {
        $name = Str::random(15) . $file->getClientOriginalName();
        $filePath = "$folder/" . $name;
        Storage::disk('s3')->put($filePath, file_get_contents($file),$disk);

        return  Storage::disk('s3')->url($filePath);
    }
}
