import { fabric } from 'fabric'
import store from './store'

// класс Холста
export default class Canvas {
  // конструктор
  constructor(tagId) {
    // холст
    this.ctx = new fabric.Canvas(tagId)
    // изображения
    this.images = {}
    // тексты
    this.texts = {}
    // обработка выбора объекта
    this.ctx.on('selection:created', function(options) {
      if (options.target) {
        // appData.showButtonDeleteDrawing = true
        store.dispatch('toggleDeleteBtn', true)
        console.log('Выделен объект')
      }
    })
    // обработка снятия фокуса с объекта
    this.ctx.on('selection:cleared', function(options) {
      // appData.showButtonDeleteDrawing = false
      store.dispatch('toggleDeleteBtn', false)
      console.log('Снято выделение с объекта')
    })
  }

  // получение ссылки на изображение
  getImageUrl() {
    var dataURL = this.ctx.toDataURL({
      format: 'png',
      multiplier: 2
    })
    return dataURL
  }

  // добавление изображения в список
  // название изображения, URL изображения, функция установки настроек
  addImage(
    imageName,
    imageUrl,
    setFunction,
    context = null,
    callback = function() {}
  ) {
    // сохраняем текущий контекст this
    var that = this
    fabric.Image.fromURL(
      imageUrl,
      function(img) {
        try {
          setFunction(img, context)
        } finally {
          // устанавливаем текущее изображение активным объектом FabricJS
          that.ctx.setActiveObject(img)
          // if (imageName === 'front' || imageName === 'back') {
          //   console.log('backward')
          //   console.log(img)
          //   console.log(that.ctx.getActiveObjects())

          //   that.ctx.sendToBack(img)
          //   // img.sendBackwards()
          //   // img.sendToBack()
          // }
          // сохраняем объект изображения в наш список
          that.images[imageName] = that.ctx.getActiveObject()
          // снимаем выделение активного объекта
          that.ctx.discardActiveObject()
          // добавляем изображение на холст
          that.ctx.add(that.images[imageName])
          callback(that.images[imageName])
        }
      },
      {
        crossOrigin: ''
      }
    )
    console.log('Добавлено изображение ' + imageName)
  }

  // удаление изображения
  removeImage(imageName) {
    console.log(imageName)
    if (this.images[imageName] != undefined) {
      this.ctx.remove(this.images[imageName])
      delete this.images[imageName]
      console.log('Изображение ' + imageName + '  удалено')
    } else {
      console.log('Не удалось найти изображение ' + imageName)
    }
  }

  // добавление текста
  addText(textName, text, options, callback = function() {}) {
    // сохраняем текущий контекст
    var that = this
    // сохраняем объект текста в список
    that.texts[textName] = new fabric.Text(text, options)
    // скрываем элементы управления нанесением
    that.texts[textName].setControlVisible('ml', false)
    that.texts[textName].setControlVisible('mr', false)
    that.texts[textName].setControlVisible('mt', false)
    that.texts[textName].setControlVisible('mb', false)
    that.texts[textName].setControlVisible('mtr', false)
    // добавляем текст на холст
    that.ctx.add(that.texts[textName])
    callback(that.texts[textName])
    console.log('Добавлен текст ' + textName)
  }

  // удаление текста
  removeText(textName) {
    if (this.texts[textName] != undefined) {
      this.ctx.remove(this.texts[textName])
      delete this.texts[textName]
      console.log('Текст ' + textName + ' удален')
    } else {
      console.log('Не удалось найти текст ' + textName)
    }
  }

  // обновление цвета текста
  updateTextColor(textName, numberColorCode) {
    if (this.texts[textName] != undefined) {
      this.texts[textName].set({
        fill: numberColorCode
      })
      this.ctx.renderAll()
      console.log('Цвет текста ' + textName + ' изменен')
    } else {
      console.log('Не удалось найти текст ' + textName)
    }
  }
}
