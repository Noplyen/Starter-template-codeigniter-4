<?php

namespace App\Services\FileService\Interface;

use App\Helpers\UuidGenerator;
use CodeIgniter\HTTP\Files\UploadedFile;

class FileNameGenerator
{
    public static function generate(UploadedFile $fileImage=null,
                                    string $extension=null)
    {
        if(!empty($extension)){
            return UuidGenerator::generateUUID(18) . $extension ;
        }else{
            return UuidGenerator::generateUUID(18) . "." . $fileImage->getClientExtension();
        }
    }
}