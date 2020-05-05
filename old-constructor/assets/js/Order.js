// класс заказа
Order = class Order {
  // конструктор
  constructor(options) {
    this.typeName = null
    this.model = {
      name: null,
      description: null
    }
    this.color = {
      name: null,
      articul: null,
      imageFront: null,
      imageBack: null
    }
    this.sizes = {
      sizeNames: {},
      count: 0,
      total: 0
    }
    this.logotypes = {
      sizeNames: {},
      count: 0,
      total: 0
    }
    this.numbers = {
      sizeNames: {},
      count: 0,
      total: 0
    }
    this.strings = {
      sizeNames: {},
      count: 0,
      total: 0
    }
    this.drawingsTotal = 0

    return this
  }

  // МЕТОДЫ УСТАНОВКИ ЗНАЧЕНИЙ
  // установка типа одежды
  setTypeName(option) {
    this.typeName = option
  }

  // установка названия модели одежды
  setModelName(option) {
    this.model.name = option
  }

  // установка описания модели одежды
  setModelDescription(option) {
    this.model.description = option
  }

  // установка названия цвета
  setColorName(option) {
    this.color.name = option
  }

  // установка артикула
  setArticul(option) {
    this.color.articul = option
  }

  // установка изображения вида спереди
  setImageFront(option) {
    this.color.imageFront = option
  }

  // установка изображения вида сзади
  setImageBack(option) {
    this.color.imageBack = option
  }

  // установка цены нанесения надписи
  setStringPrice(option) {
    this.strings.price = option
  }

  // удаление ранее загруженных данных о цвете
  clearColor() {
    this.color = {
      name: null,
      articul: null,
      imageFront: null,
      imageBack: null
    }
  }

  // добавление размера текущей модели
  addSize(sizeName, optBarcode = null, optPrice = 0, optCountMoscowStorage = 0) {
    this.sizes.sizeNames[sizeName] = {
      price: optPrice,
      total: 0,
      countMoscowStorage: optCountMoscowStorage,
      count: 0,
      countMoscow: 0,
      countSpain: 0,
      barcode: optBarcode,
      numberSurname: []
    }

    // возвращаем объект размера
    return this.sizes.sizeNames[sizeName]
  }

  // установка количества заказа определенного размера
  setSizeCount(sizeName, optCount) {
    if (optCount == "") {
      optCount = 0
    }

    // сохраняем предыдущие значения количества и итоговой стоимости
    let oldCount = this.sizes.sizeNames[sizeName].count
    let oldTotal = this.sizes.sizeNames[sizeName].total

    // изменяем количество заказа для размера
    this.sizes.sizeNames[sizeName].count = optCount

    // если заказ больше чем есть на складе в Москве
    if (optCount > this.sizes.sizeNames[sizeName].countMoscowStorage) {
      // часть заказа из Москвы
      this.sizes.sizeNames[sizeName].countMoscow = this.sizes.sizeNames[sizeName].countMoscowStorage
      // оставшаяся часть заказа из Испании
      this.sizes.sizeNames[sizeName].countSpain = optCount - this.sizes.sizeNames[sizeName].countMoscowStorage
    } else {
      // часть заказа из Москвы
      this.sizes.sizeNames[sizeName].countMoscow = optCount
      // оставшаяся часть заказа из Испании
      this.sizes.sizeNames[sizeName].countSpain = 0
    }

    // пересчитываем итоговую стоимость моделей этого размера
    this.sizes.sizeNames[sizeName].total = this.sizes.sizeNames[sizeName].price * this.sizes.sizeNames[sizeName].count

    // если в массиве номеров-фамилий этого размера меньше объектов чем должно быть
    let extra = optCount - this.sizes.sizeNames[sizeName].numberSurname.length
    if (extra > 0) {
      // добавляем в массив numberSurname объекты для номеров и фамилий,
      // которые должны быть распечатаны на этом размере
      for (; extra > 0; extra--) {
        this.sizes.sizeNames[sizeName].numberSurname.push({
          number: null,
          surname: null
        })
      }
    } else {
      // удаляем лишние номера-фамилии начиная с конца
      this.sizes.sizeNames[sizeName].numberSurname = this.sizes.sizeNames[sizeName].numberSurname.slice(0, extra)
    }

    // отнимаем предыдущие значения от значений для всех размеров
    this.sizes.count -= oldCount
    this.sizes.total -= oldTotal
    // прибавляем пересчитанные значения
    this.sizes.count += this.sizes.sizeNames[sizeName].count
    this.sizes.total += this.sizes.sizeNames[sizeName].total
  }

  // удаление ранее загруженных размеров
  clearSizes() {
    this.sizes = {
      sizeNames: {},
      count: 0,
      total: 0
    }
  }

  // добавление логотипа
  addLogotype(sizeName, typeName, optPrice = 0, optImage) {
    // генерируем id логотипа из текущего времени
    let date = new Date();
    let id = date.getTime()

    // если логотип такого размера еще не добавили, то добавляем
    if (typeof (this.logotypes.sizeNames[sizeName]) == 'undefined') {
      this.logotypes.sizeNames[sizeName] = {}
    }
    // если логотип такого типа еще не добавили, то добавляем
    if (typeof (this.logotypes.sizeNames[sizeName][typeName]) == 'undefined') {
      this.logotypes.sizeNames[sizeName][typeName] = {
        price: optPrice,
        count: 0,
        total: 0,
        images: []
      }
    }

    // добавление изображения к текущему размеру и типу логотипов
    this.logotypes.sizeNames[sizeName][typeName].images.push({
      id: id,
      image: optImage
    })
    this.logotypes.sizeNames[sizeName][typeName].count += 1
    this.logotypes.sizeNames[sizeName][typeName].total += this.logotypes.sizeNames[sizeName][typeName].price

    // увеличиваем счетчик логотипов
    this.logotypes.count += 1
    // увеличиваем стоимость всех логотипов
    this.logotypes.total += this.logotypes.sizeNames[sizeName][typeName].price
    // увеличиваем итоговую стоимость нанесений заказа
    this.drawingsTotal += this.logotypes.sizeNames[sizeName][typeName].price

    // возвращаем id логотипа
    return id
  }

  // удаление логотипа
  removeLogotype(optId) {
    let refThis = this
    for (let sizeName in refThis.logotypes.sizeNames) {
      for (let typeName in refThis.logotypes.sizeNames[sizeName]) {
        refThis.logotypes.sizeNames[sizeName][typeName].images.forEach(function (item, i, images) {
          if (item.id == optId) {
            // удаляем изображение логотипа
            images.splice(i, 1)

            // уменьшаем счетчик логотипов этого размера и типа
            refThis.logotypes.sizeNames[sizeName][typeName].count -= 1
            // уменьшаем стоимость логотипов этого размера и типа
            refThis.logotypes.sizeNames[sizeName][typeName].total -= refThis.logotypes.sizeNames[sizeName][typeName].price

            // уменьшаем счетчик логотипов
            refThis.logotypes.count -= 1
            // уменьшаем стоимость всех логотипов
            refThis.logotypes.total -= refThis.logotypes.sizeNames[sizeName][typeName].price
            // уменьшаем итоговую стоимость нанесений заказа
            refThis.drawingsTotal -= refThis.logotypes.sizeNames[sizeName][typeName].price
          }
        })
      }
    }
  }

  // удаление ранее загруженных логотипов
  clearLogotypes() {
    this.logotypes = {
      sizeNames: {},
      count: 0,
      total: 0
    }
  }

  // добавление номера
  addNumber(sizeName, optPrice = 0, optValue, optFont, optColor = {
    name: null,
    code: null
  }) {
    // генерируем id номера из текущего времени
    let date = new Date();
    let id = date.getTime()

    // если номер такого размера еще не добавили, то добавляем
    if (typeof (this.numbers.sizeNames[sizeName]) == 'undefined') {
      this.numbers.sizeNames[sizeName] = {
        price: optPrice,
        count: 0,
        total: 0,
        values: []
      }
    }

    // добавляем номер размера sizeName
    this.numbers.sizeNames[sizeName].values.push({
      id: id,
      value: optValue,
      font: optFont,
      color: optColor
    })

    // увеличиваем счетчик номеров такого размера
    this.numbers.sizeNames[sizeName].count += 1
    // увеличиваем итоговую стоимость номеров такого размера
    this.numbers.sizeNames[sizeName].total += this.numbers.sizeNames[sizeName].price

    // увеличиваем счетчик номеров
    this.numbers.count += 1
    // увеличиваем итоговую стоимость всех номеров
    this.numbers.total += this.numbers.sizeNames[sizeName].price
    // увеличиваем итоговую стоимость нанесений заказа
    this.drawingsTotal += this.numbers.sizeNames[sizeName].price

    // возвращаем id номера
    return id
  }

  // удаление номера
  removeNumber(optId) {
    let refThis = this
    for (let sizeName in refThis.numbers.sizeNames) {
      refThis.numbers.sizeNames[sizeName].values.forEach(function (item, i, values) {
        if (item.id == optId) {
          // удаляем объект номера
          values.splice(i, 1)

          // уменьшаем счетчик номеров этого размера
          refThis.numbers.sizeNames[sizeName].count -= 1
          // уменьшаем стоимость номеров этого размера
          refThis.numbers.sizeNames[sizeName].total -= refThis.numbers.sizeNames[sizeName].price

          // уменьшаем счетчик номеров
          refThis.numbers.count -= 1
          // уменьшаем стоимость всех номеров
          refThis.numbers.total -= refThis.numbers.sizeNames[sizeName].price
          // уменьшаем итоговую стоимость нанесений заказа
          refThis.drawingsTotal -= refThis.numbers.sizeNames[sizeName].price
        }
      })
    }
  }

  // удаление ранее загруженных номеров
  clearNumbers() {
    this.numbers = {
      sizeNames: {},
      count: 0,
      total: 0
    }
  }

  // добавление надписи
  addString(sizeName, optPrice = 0, optValue, optFont, optColor = {
    name: null,
    code: null
  }) {
    // генерируем id надписи из текущего времени
    let date = new Date();
    let id = date.getTime()

    // если надпись такого размера еще не добавили, то добавляем
    if (typeof (this.strings.sizeNames[sizeName]) == 'undefined') {
      this.strings.sizeNames[sizeName] = {
        price: optPrice,
        count: 0,
        total: 0,
        values: []
      }
    }

    // добавляем надпись размера sizeName
    this.strings.sizeNames[sizeName].values.push({
      id: id,
      value: optValue,
      font: optFont,
      color: optColor
    })

    // увеличиваем счетчик надписей такого размера
    this.strings.sizeNames[sizeName].count += 1
    // увеличиваем итоговую стоимость надписей такого размера
    this.strings.sizeNames[sizeName].total += this.strings.sizeNames[sizeName].price

    // увеличиваем счетчик надписей
    this.strings.count += 1
    // увеличиваем итоговую стоимость всех надписей
    this.strings.total += this.strings.sizeNames[sizeName].price
    // увеличиваем итоговую стоимость нанесений заказа
    this.drawingsTotal += this.strings.sizeNames[sizeName].price

    // возвращаем id надписи
    return id
  }

  // удаление надписи
  removeString(optId) {
    let refThis = this
    for (let sizeName in refThis.strings.sizeNames) {
      refThis.strings.sizeNames[sizeName].values.forEach(function (item, i, values) {
        if (item.id == optId) {
          // удаляем объект надписи
          values.splice(i, 1)

          // уменьшаем счетчик надписей этого размера
          refThis.strings.sizeNames[sizeName].count -= 1
          // уменьшаем стоимость надписей этого размера
          refThis.strings.sizeNames[sizeName].total -= refThis.strings.sizeNames[sizeName].price

          // уменьшаем счетчик надписей
          refThis.strings.count -= 1
          // уменьшаем стоимость всех надписей
          refThis.strings.total -= refThis.strings.sizeNames[sizeName].price
          // уменьшаем итоговую стоимость нанесений заказа
          refThis.drawingsTotal -= refThis.strings.sizeNames[sizeName].price
        }
      })
    }
  }

  // удаление ранее загруженных надписей
  clearStrings() {
    this.strings = {
      sizeNames: {},
      count: 0,
      total: 0
    }
  }
}