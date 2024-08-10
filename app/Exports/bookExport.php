<?php

namespace App\Exports;

use App\Models\book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class bookExport implements FromCollection, WithHeadings, WithMapping, WithTitle, WithEvents, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return book::all();
    }

   
    public function headings(): array
    {
        return [
            'Judul Buku',
            'Kategori Buku',
            'Jumlah Buku',
            'File Buku',
            'Cover Buku',
            'Deskripsi Buku',
        ];
    }

    public function map($book): array
    {
        return [
            $book->judul,
            $book->kategori->category_name,
            $book->jumlah,
            $book->file_buku,
            $book->cover_buku,
            $book->deskripsi,
        ];
    }

    public function title(): string
    {
        return 'Data Buku';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $cellRange = 'A1:H1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFFF00');
            },
        ];
    }



}
