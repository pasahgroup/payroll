<?php
namespace App\Exports;

use App\Model\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployeeExport implements FromCollection
{
    public function collection()
    {
        return Employee::all();
    }
}
