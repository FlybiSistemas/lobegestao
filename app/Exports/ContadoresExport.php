<?php

namespace App\Exports;

use App\Models\Contador;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Excel;

class ContadoresExport implements FromCollection, WithHeadings
{
    use Exportable;
    private $writerType = Excel::CSV;

    public function collection()
    {
        return Contador::select('nome', 'usuario', 'senha')->get();
    }

    public function headings(): array
    {
        return [
            'Nome',
            'Usuario',
            'Senha'
        ];
    }
}
