<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Employee;

class UserReport implements FromCollection, WithHeadings, WithMapping,
							WithCustomStartCell,
				            ShouldAutoSize,
				            WithStyles,
				            WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Employee::orderByDesc('created_at')->get();
    }

    public function map($employee): array
    {
        return [
            $employee->name ?? '',
            $employee->dob ?? '',
            $employee->email ?? '',
            $employee->mobile ?? '',
            $employee->salary ?? '',
            $employee->address ?? '',
        ];
    }
    public function headings(): array
    {
        return [
            'Name',
            'Date of Birth',
            'Email',
            'Mobile',
            'Salary',
            'Address'

        ];
    }
    public function startCell(): string
    {
        return 'A1';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true], 'name' =>  'Calibri'],

           ];
    }

   	public function title() :string 
    {
        return  'employees';
        
    }
}
