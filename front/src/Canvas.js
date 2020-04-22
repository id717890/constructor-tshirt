import { fabric } from 'fabric'
import store from './store'

fabric.Object.prototype.objectCaching = false

fabric.TextCurved = fabric.util.createClass(fabric.Object, {
  type: 'textcurved',
  diameter: 250,
  kerning: 0,
  text: '',
  flipped: false,
  fill: '#000',
  fontFamily: 'Times New Roman',
  fontSize: 24, // in px
  fontWeight: 'normal',
  fontStyle: '', // "normal", "italic" or "oblique".
  cacheProperties: fabric.Object.prototype.cacheProperties.concat(
    'diameter',
    'kerning',
    'flipped',
    'fill',
    'fontFamily',
    'fontSize',
    'fontWeight',
    'fontStyle',
    'strokeStyle',
    'strokeWidth'
  ),
  strokeStyle: null,
  strokeWidth: 0,

  initialize: function(text, options) {
    options || (options = {})
    this.text = text

    this.callSuper('initialize', options)
    this.set('lockUniScaling', false)

    // Draw curved text here initially too, while we need to know the width and height.
    var canvas = this.getCircularText()
    this._trimCanvas(canvas)
    this.set('width', canvas.width)
    this.set('height', canvas.height)
  },

  _getFontDeclaration: function() {
    return [
      // node-canvas needs "weight style", while browsers need "style weight"
      fabric.isLikelyNode ? this.fontWeight : this.fontStyle,
      fabric.isLikelyNode ? this.fontStyle : this.fontWeight,
      this.fontSize + 'px',
      fabric.isLikelyNode ? '"' + this.fontFamily + '"' : this.fontFamily
    ].join(' ')
  },

  _trimCanvas: function(canvas) {
    var ctx = canvas.getContext('2d'),
      w = canvas.width,
      h = canvas.height,
      pix = { x: [], y: [] },
      n,
      imageData = ctx.getImageData(0, 0, w, h),
      fn = function(a, b) {
        return a - b
      }

    for (var y = 0; y < h; y++) {
      for (var x = 0; x < w; x++) {
        if (imageData.data[(y * w + x) * 4 + 3] > 0) {
          pix.x.push(x)
          pix.y.push(y)
        }
      }
    }
    pix.x.sort(fn)
    pix.y.sort(fn)
    n = pix.x.length - 1

    w = pix.x[n] - pix.x[0]
    h = pix.y[n] - pix.y[0]
    var cut = ctx.getImageData(pix.x[0], pix.y[0], w, h)

    canvas.width = w
    canvas.height = h
    ctx.putImageData(cut, 0, 0)
  },

  // Source: http://jsfiddle.net/rbdszxjv/
  getCircularText: function() {
    var text = this.text,
      diameter = this.diameter,
      flipped = this.flipped,
      kerning = this.kerning,
      fill = this.fill,
      inwardFacing = true,
      startAngle = 0,
      canvas = fabric.util.createCanvasElement(),
      ctx = canvas.getContext('2d'),
      cw, // character-width
      x, // iterator
      clockwise = -1 // draw clockwise for aligned right. Else Anticlockwise

    if (flipped) {
      startAngle = 180
      inwardFacing = false
    }

    startAngle *= Math.PI / 180 // convert to radians

    // Calc heigt of text in selected font:
    var d = document.createElement('div')
    d.style.fontFamily = this.fontFamily
    d.style.whiteSpace = 'nowrap'
    d.style.fontSize = this.fontSize + 'px'
    d.style.fontWeight = this.fontWeight
    d.style.fontStyle = this.fontStyle
    d.textContent = text
    document.body.appendChild(d)
    var textHeight = d.offsetHeight
    document.body.removeChild(d)

    canvas.width = canvas.height = diameter
    ctx.font = this._getFontDeclaration()

    // Reverse letters for center inward.
    if (inwardFacing) {
      text = text
        .split('')
        .reverse()
        .join('')
    }

    // Setup letters and positioning
    ctx.translate(diameter / 2, diameter / 2) // Move to center
    startAngle += Math.PI * !inwardFacing // Rotate 180 if outward
    ctx.textBaseline = 'middle' // Ensure we draw in exact center
    ctx.textAlign = 'center' // Ensure we draw in exact center

    // rotate 50% of total angle for center alignment
    for (x = 0; x < text.length; x++) {
      cw = ctx.measureText(text[x]).width
      startAngle +=
        ((cw + (x == text.length - 1 ? 0 : kerning)) /
          (diameter / 2 - textHeight) /
          2) *
        -clockwise
    }

    // Phew... now rotate into final start position
    ctx.rotate(startAngle)

    // Now for the fun bit: draw, rotate, and repeat
    for (x = 0; x < text.length; x++) {
      cw = ctx.measureText(text[x]).width // half letter
      // rotate half letter
      ctx.rotate((cw / 2 / (diameter / 2 - textHeight)) * clockwise)
      // draw the character at "top" or "bottom"
      // depending on inward or outward facing

      // Stroke
      if (this.strokeStyle && this.strokeWidth) {
        ctx.strokeStyle = this.strokeStyle
        ctx.lineWidth = this.strokeWidth
        ctx.miterLimit = 2
        ctx.strokeText(
          text[x],
          0,
          (inwardFacing ? 1 : -1) * (0 - diameter / 2 + textHeight / 2)
        )
      }

      // Actual text
      ctx.fillStyle = fill
      ctx.fillText(
        text[x],
        0,
        (inwardFacing ? 1 : -1) * (0 - diameter / 2 + textHeight / 2)
      )

      ctx.rotate(((cw / 2 + kerning) / (diameter / 2 - textHeight)) * clockwise) // rotate half letter
    }
    return canvas
  },

  _set: function(key, value) {
    switch (key) {
      case 'scaleX':
        this.fontSize *= value
        this.diameter *= value
        this.width *= value
        this.scaleX = 1
        if (this.width < 1) {
          this.width = 1
        }
        break

      case 'scaleY':
        this.height *= value
        this.scaleY = 1
        if (this.height < 1) {
          this.height = 1
        }
        break

      default:
        this.callSuper('_set', key, value)
        break
    }
  },

  _render: function(ctx) {
    var canvas = this.getCircularText()
    this._trimCanvas(canvas)

    this.set('width', canvas.width)
    this.set('height', canvas.height)

    ctx.drawImage(
      canvas,
      -this.width / 2,
      -this.height / 2,
      this.width,
      this.height
    )

    this.setCoords()
  },

  toObject: function(propertiesToInclude) {
    return this.callSuper(
      'toObject',
      [
        'text',
        'diameter',
        'kerning',
        'flipped',
        'fill',
        'fontFamily',
        'fontSize',
        'fontWeight',
        'fontStyle',
        'strokeStyle',
        'strokeWidth',
        'styles'
      ].concat(propertiesToInclude)
    )
  }
})

fabric.TextCurved.fromObject = function(object, callback, forceAsync) {
  console.log('12345')
  console.log(object)
  console.log(callback)
  return fabric.Object._fromObject(
    'TextCurved',
    object,
    callback,
    forceAsync,
    'textcurved'
  )
}

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
        // console.log('Выделен объект')
      }
    })
    // обработка снятия фокуса с объекта
    this.ctx.on('selection:cleared', function(options) {
      // appData.showButtonDeleteDrawing = false
      store.dispatch('toggleDeleteBtn', false)
      // console.log('Снято выделение с объекта')
    })
    // this.ctx.on('object:selected', function(options) {
    //   console.log('obj.sel')
    // })
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
    size = 300,
    callback = function() {}
  ) {
    // сохраняем текущий контекст this
    var that = this
    fabric.Image.fromURL(
      imageUrl,
      function(img) {
        try {
          setFunction(img, context, size)
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
    // console.log('Добавлено изображение ' + imageName)
  }

  // удаление изображения
  removeImage(imageName) {
    // console.log(imageName)
    if (this.images[imageName] != undefined) {
      this.ctx.remove(this.images[imageName])
      delete this.images[imageName]
      // console.log('Изображение ' + imageName + '  удалено')
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

  // добавление текста
  addTextCurved(textName, text, options, callback = function() {}) {
    // сохраняем текущий контекст
    var that = this
    // сохраняем объект текста в список
    that.texts[textName] = new fabric.TextCurved(text, options)
    // скрываем элементы управления нанесением
    that.texts[textName].setControlVisible('ml', false)
    that.texts[textName].setControlVisible('mr', false)
    that.texts[textName].setControlVisible('mt', false)
    that.texts[textName].setControlVisible('mb', false)
    that.texts[textName].setControlVisible('mtr', false)
    // добавляем текст на холст
    that.ctx.add(that.texts[textName])
    callback(that.texts[textName])
    console.log('Добавлен изогнутый текст ' + textName)
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
