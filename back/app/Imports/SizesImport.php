<?php

namespace App\Imports;

use App\Models\Size;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class SizesImport implements ToCollection
{
//    public function model(array $row)
//    {
//        return new Size([
//            'id'     => $row[0],
//            'test'    => $row[1]
//        ]);
//    }

    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            if ($row[4] !== null && $row[4] !== '') {
                $id = $row[0];
                $find = Size::find($id);
                if (isset($find)) {
                    $find->price = intval($row[4]);
                    $find->save();
                }
            }
            if ($row[5] !== null && $row[5] !== '') {
                $id = $row[0];
                $find = Size::find($id);
                if (isset($find)) {
                    $find->count = intval($row[5]);
                    $find->save();
                }
            }
        }
        return $collection;
    }
}
