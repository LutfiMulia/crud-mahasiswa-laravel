<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MahasiswaExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        return Mahasiswa::orderBy('nama', 'asc')->get();
    }

    public function headings(): array
    {
        return ['NO', 'NAMA', 'NIM', 'EMAIL'];
    }

    public function map($mahasiswa): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            ucwords($mahasiswa->nama),
            strtoupper($mahasiswa->nim),
            strtolower($mahasiswa->email),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Bold untuk header
        $sheet->getStyle('A1:D1')->getFont()->setBold(true);

        // Biar teks di tengah
        $sheet->getStyle('A1:D' . $sheet->getHighestRow())->getAlignment()->setHorizontal('center');

        // Biar kolom rapat (auto fit udah dibantu ShouldAutoSize juga)
        foreach (range('A', 'D') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        return [];
    }
}
