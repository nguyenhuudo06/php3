<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

trait StorageImageTrait
{
    public function upload($request, $fieldName)
    {
        // Kiểm tra xem request có chứa file không
        if ($request->hasFile($fieldName)) {
            // Lấy file từ request
            $file = $request->file($fieldName);
            $fileNameOrigin = $file->getClientOriginalName();

            // Tạo tên file mới (ngẫu nhiên) và lấy phần mở rộng
            $fileName = time() . Str::random(20) . '.' . $file->getClientOriginalExtension();

            // Lưu file vào thư mục public/uploads
            $filePath = $file->storeAs('public/uploads', $fileName);

            $dataUploadTrait = [
                'file_name' => $fileNameOrigin,
                'file_path' => Storage::url($filePath)
            ];
            return $dataUploadTrait;
        }

        return null;
    }

    public function storageTraitUpload($request, $fieldName, $folderName)
    {
        // Kiểm tra xem request có chứa tệp được gửi lên không
        if ($request->hasFile($fieldName)) {
            // Lấy thông tin về tệp
            $file = $request->$fieldName;
            // Lấy tên gốc của tệp
            $fileNameOrigin = $file->getClientOriginalName();
            // Tạo tên ngẫu nhiên cho tệp mới . đuôi file
            $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalExtension();
            // Lưu trữ tệp lên hệ thống tệp và lấy đường dẫn của tệp đã lưu
            $filePath = $request->file($fieldName)->storeAs('public/' . $folderName . '/' . auth()->id(), $fileNameHash);
            // Tạo một mảng chứa thông tin về tệp đã lưu và trả về nó
            $dataUploadTrait = [
                'file_name' => $fileNameOrigin,
                'file_path' => Storage::url($filePath)
            ];
            // Nếu không có tệp được gửi, trả về null
            return $dataUploadTrait;
        }
        return null;
    }

    public function storageTraitUploadMutiple($file, $folderName)
    {
        $fileNameOrigin = $file->getClientOriginalName();
        $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('public/' . $folderName . '/' . auth()->id(), $fileNameHash);
        $dataUploadTrait = [
            'file_name' => $fileNameOrigin,
            'file_path' => Storage::url($filePath)
        ];
        return $dataUploadTrait;
    }
}
