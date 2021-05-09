<?php

namespace App\Imports;

use App\Models\User;
use Throwable;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImport implements ToModel,WithHeadingRow,SkipsOnError
{
    use importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'name' => $row['name'],
            'email' => $row['email'],
            'password' => Hash::make ($row['password']),
        ]);
    }

    public function onError(Throwable $error){

    }
}
