<?php

namespace App\Http\Controllers;

use App\Imports\StudentsImport;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function index(): View
    {
        return view('welcome', [
            'students' => User::paginate(10)
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'students' => [
                'required', 'mimes:xlsx,xls,csv'
            ]
        ]);

        Excel::import(new StudentsImport, $request->file('students'));

        return to_route('students.index')->with('success', 'Successfully Imported Students');
    }
}
