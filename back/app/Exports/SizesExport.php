<?php

namespace App\Exports;

use App\Models\Size;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SizesExport implements WithHeadings, FromCollection, ShouldAutoSize
,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */




//    public function map($invoice): array
//    {
//        return [
//            ['asdasds']
//        ];
//    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Модель',
            'Цвет',
            'Размер',
            'Цена',
            'Кол-во',
        ];
    }

    /**
     * @return Collection
     */
    public function collection()
    {
        return Size::with('color')->with('color.model')->get();
    }

    public function map($invoice): array
    {
        return [
            $invoice->id,
            $invoice->color->model->name,
            $invoice->color->name,
            $invoice->size
        ];
    }



}
