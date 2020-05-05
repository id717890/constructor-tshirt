<?php
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$name   = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);
$data   = $_GET['data'] ?? null;
$db     = @json_decode(file_get_contents('../db.json'), true);

// если не загрузилась БД
if (!$db)
{
  echo 'Не доступна БД.';
  exit;
}

switch ($action)
{
  case 'get':
    switch ($name)
    {
      case 'types':
        $types = @array_keys($db['Типы']);
        echo json_encode($types, JSON_UNESCAPED_UNICODE);
        break;
      case 'logos':
        $logos = @array_values($db['Логотипы']);
        echo json_encode($logos, JSON_UNESCAPED_UNICODE);
        break;
      case 'drawings':
        $drawings = $db['drawings'];
        echo json_encode($drawings, JSON_UNESCAPED_UNICODE);
        break;
      case 'colorsCode':
        $colorsCode = $db['Цвета'];
        echo json_encode($colorsCode, JSON_UNESCAPED_UNICODE);
        break;
      case 'sizesTooltip':
        $sizesTooltip = $db['ПодсказкиКРазмерам'];
        echo json_encode($sizesTooltip, JSON_UNESCAPED_UNICODE);
        break;
      case 'fonts':
        $fonts = $db['Шрифты'];
        echo json_encode($fonts, JSON_UNESCAPED_UNICODE);
        break;
      case 'models':
        $modelsOut = [];
        $models    = @array_values($db['Типы'])[$data['ntype']];
        foreach ($models as $modelName => $model)
        {
          array_push($modelsOut, ["Название" => $modelName, "Изображение" => current($model['Цвета'])['Вид спереди'], "colors" => []]);
        }
        echo json_encode($modelsOut, JSON_UNESCAPED_UNICODE);
        break;
      case 'colors':
        $colorsOut = [];
        $model     = @array_values(array_values($db['Типы'])[$data['ntype']])[$data['nmodel']];
        foreach ($model['Цвета'] as $colorName => $color)
      {
          array_push($colorsOut, ["Название" => $colorName, "Изображение" => $color['Вид спереди'], "Артикул" => $color['Артикул']]);
        }
        echo json_encode($colorsOut, JSON_UNESCAPED_UNICODE);
        break;
      case 'model':
        $modelName = @array_keys(array_values($db['Типы'])[$data['ntype']])[$data['nmodel']];
        $model     = @array_values(array_values($db['Типы'])[$data['ntype']])[$data['nmodel']];
        $color     = @array_values($model['Цвета'])[$data['ncolor']];

        $data = [
          "Название"          => $modelName,
          "Описание"          => $model['Описание'],
          "Тип"               => $model["Тип"],
          "Размеры"           => $model['Размеры'],
          "ВидСпереди"        => $color['Вид спереди'],
          "drawings"          => $db["drawings"],
          "СкидкаЗаНанесения" => $db["Скидка за нанесения"],
          "Скидка"            => $db["Скидка"],
          "Цвета"             => $db["Цвета"],
          "Шрифты"            => $db["Шрифты"],
        ];

        if (isset($color['Вид сзади']))
      {
          $data["ВидСзади"] = $color['Вид сзади'];
        }

        foreach (array_keys($db["Логотипы"]) as $drawingName)
      {
          $data["Логотипы"][$drawingName] = $db["Логотипы"][$drawingName]["Изображение"];
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        break;
      default:
        break;
    }
  default:
    break;
}
