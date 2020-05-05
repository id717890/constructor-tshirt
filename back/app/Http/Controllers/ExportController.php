<?php

namespace App\Http\Controllers;

use App\Exports\SizesExport;
use App\Imports\SizesImport;
use App\Models\Size;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;


class ExportController extends Controller
{
    public function exportCatalog(Request $request)
    {
        try {
            $sizes = Size::with('color')->with('color.model')->get();

            $data = [
                'heading' => 'Каталог товаров',
                'sizes'=>$sizes,
                'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.'
            ];

//            PDF::setOptions(['defaultFont' => 'dejavu sans']);
            $pdf = PDF::loadView('pdf.catalog', $data);
            return $pdf->download('Catalog.pdf');
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['code' => 500, 'message' => $e->getMessage()]], 400);
        }
    }

    public function importSizes(Request $request)
    {
        try {
            $result = [1];
//            $result = Excel::toArray(new SizesImport, $request->file('sizes'));
            Excel::import(new SizesImport, $request->file('sizes'));

            return response()->json('SUCCESS', 200, ['Content-Type' => 'application/vnd.ms-excel; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        }
    }


    public function exportSizes(Request $request)
    {
        try {
//            Excel::create('123', function ($excel)  {
//                $excel->sheet('Отчет', function ($sheet) {
//                    $sheetArray = [];
//                    $count_rows = 3;
//                    $count_cols = 4;
//                    $sheet->setAutoSize(true);
//
//                    $sheet->mergeCells('A1:D1');
////                    $admin = $data['user']->name;
////                    $day = date('d.m.Y',strtotime($data['day']));
////                    $sheet->cell('A1', function ($cell) use ($admin, $day) {
////                        $cell->setValue('Отчет по денежным операциям администратора '.$admin.' за '.$day);
////                    });
//
////                    //region Заголовок
////                    $title = ['Дата и время ','Танцов', 'Группа', 'Сумма платежа'];
////                    $sheetArray[] = $title;
////                    $count_rows++;
////                    //endregion
//////
////                    foreach ($data['payments'] as $pay) {
////                        $row = [];
////                        $row[] = date('d.m.Y H:i:s',strtotime($pay->created_at));
////                        $row[] = $pay->student->fio();
////                        $row[] = $pay->group->name;
////                        $row[] = intval($pay->pay);
////                        $sheetArray[] = $row;
////                        $count_rows++;
////                    }
//////                $row = [];
//////                $row[] = 'Итого';
//////                $sum = 0;
//////                foreach ($days as $day) {
//////                    $row[] = $total_days[$day];
//////                    $sum += $total_days[$day];
//////                }
//////                $row[] = $sum;
//////                $sheetArray[] = $row;
////                    $sheet->fromArray($sheetArray, null, 'A3', false, false);
//////
////                    $sheet->cells('A3' . ':' . config('constants.list_alphabet')[$count_cols] . 3, function ($cell) {
////                        $cell->setBackground('#CCCCCC');
////                    });
////
////                    $sheet->cells('A1:AF100', function ($cell) {
////                        $cell->setAlignment('center');
////                        $cell->setValignment('center');
////                    });
////                    $count_rows--;
////                    $sheet->setBorder('A3:' . config('constants.list_alphabet')[$count_cols] . $count_rows, 'thin');
////
////                    $cols = [];
////                    for ($i = 1; $i <= $count_cols; $i++) {
////                        $cols[config('constants.list_alphabet')[$i]] = 20;
////                    }
////
////                    $sheet->setWidth($cols);
//                });
//            })->download('invoices.xls');
//            return (new SizesExport)->download('invoices.xls', \Maatwebsite\Excel\Excel::XLS);
//            return response()->json(Excel::download(new SizesExport, 'report.xlsx'), 200, ['Content-Type' => 'application/vnd.ms-excel; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
//            return response(Excel::download(new SizesExport, 'report.xlsx'), 200, ['Content-Type' => 'application/vnd.ms-excel; charset=UTF-8']);
            return Excel::download(new SizesExport, 'report.xlsx', \Maatwebsite\Excel\Excel::XLS);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
        }
    }
}
