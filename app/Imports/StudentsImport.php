<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $existingStudent = User::query()
            ->where(
                [
                    ['name', $row['name']],
                    ['class', $row['class']],
                    ['level', $row['level']],
                    ['parent_contact', $row['parent_contact']],
                ]
            )->first();

        if ($existingStudent) {
            return null;
        }

        return new User([
            'name' => $row['name'],
            'class' => $row['class'],
            'level' => $row['level'],
            'parent_contact' => $row['parent_contact'],
        ]);
    }
}
