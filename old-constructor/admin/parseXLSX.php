<?php
$pathXLSX = __DIR__ . '/Stock.xlsx';
$zip      = new ZipArchive;
$res      = $zip->open($pathXLSX);

if ($res === true)
{
    // излекаем содержимое архива XLSX
    $zip->extractTo(__DIR__ . '/XLSXExtract');
    $zip->close();

    $xml              = simplexml_load_file(__DIR__ . '/XLSXExtract/xl/sharedStrings.xml');
    $sharedStringsArr = array();
    foreach ($xml->children() as $item)
    {
        $sharedStringsArr[] = (string) $item->t;
    }

    $handle = @opendir(__DIR__ . '/XLSXExtract/xl/worksheets');
    $out    = array();
    while ($file = @readdir($handle))
    {
        //проходим по всем файлам из директории /xl/worksheets/
        if ($file != "." && $file != ".." && $file != '_rels')
        {
            $xml = simplexml_load_file(__DIR__ . '/XLSXExtract/xl/worksheets/' . $file);
            //по каждой строке
            $row = 0;
            foreach ($xml->sheetData->row as $item)
            {
                //echo '<b>Строка №'.($row+1).'</b><br>';
                $out[$file][$row] = array();
                //по каждой ячейке строки
                $cell = 0;
                foreach ($item as $child)
                {
                    //echo 'Ячейка №'.($cell+1).'<br>';
                    $attr                    = $child->attributes();
                    $value                   = isset($child->v) ? (string) $child->v : false;
                    $out[$file][$row][$cell] = isset($attr['t']) && ($attr['t'] == 's') ? $sharedStringsArr[$value] : $value;
                    $cell++;
                }
                $row++;
            }
        }
    }

    // номер столбца с штрихкодом товара
    $colBarcode = 0;
    // номер столбца с ценой товара
    $colPrice = 0;
    // номера столбцов с остатками на складе
    $stocks = [];

    // переопределяем номера столбцов, если они изменились
    foreach ($out['sheet1.xml'][4] as $key => $value)
    {
        switch ($value)
        {
            case 'Штрихкод':
                $colBarcode = $key;
                break;
            case 'Цена':
                $colPrice = $key;
                break;
        }
    }

    foreach ($out['sheet1.xml'][5] as $key => $value)
    {
        if ($value == 'Остаток на складе')
        {
            array_push($stocks, $key);
        }
    }

    // массив данных о товарах
    // 0 - артикул
    // 1 - цена
    // 2 - остатки на складе
    $data = [];

    // пробегаемся по каждой строке товара
    foreach (array_slice($out['sheet1.xml'], 9) as $key => $row)
    {
        // определяем остатки на складе
        $stock = 0;
        foreach ($stocks as $colStock)
        {
            if (!empty(($row[$colStock])))
            {
                $stock = $row[$colStock];
            }
        }
        if ((!empty($row[$colPrice])) && !empty($row[$colPrice]))
        {
            // добавляем в массив данных о товарах
            array_push($data, [$row[$colBarcode], $row[$colPrice], $stock]);
        }
    }
}
else
{
    echo 'Ошибка открытия файла '.$pathXLSX.':' . $res;
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
<link crossorigin='anonymous' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css' integrity='sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB' rel='stylesheet'/>
  </head>
  <body>
        <?php
echo '<table class="table table-hover col-8 mx-auto"><tbody><caption>Данные о товарах из файла</caption><tr><th>Штрихкод</th><th>Цена</th><th>Осталось на складе</th></tr>';
foreach ($data as $key => $product)
{
    echo '<tr><td>' . $product[0] . '</td><td>' . $product[1] . '</td><td>' . $product[2] . '</td></tr>';
}
echo '<tbody></table>';
?>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script crossorigin='anonymous' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'></script>
<script crossorigin='anonymous' integrity='sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T' src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js'></script>
  </body>
</html>