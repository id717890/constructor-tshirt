// включаем интструменты разработчика Vue
Vue.config.debug = true;
Vue.config.devtools = true;
$(document).ready(function () {
  // объект холстов
  canvases = {};
  // данные приложения (посредник между сервером и приложением Vue.js)
  appData = {
    agreeRules: false,
    typeCustomer: null,
    fizik: {
      number: null,
      date: null,
      firstName: "",
      lastName: "",
      middleName: "",
      email: "",
      phone: "",
      price: 0,
      agreeContractNanesenie: false,
      agreeContractBuy: false,
      showContractBuy: false,
      showContractNanesenie: false
    },
    yurik: {
      number: null,
      date: null,
      field1: "",
      field2: "",
      field3: "",
      email: "",
      phone: "",
      price: 0,
      agreeContractNanesenie: false,
      agreeContractBuy: false,
      showContractBuy: false,
      showContractNanesenie: false
    },
    shoaAllRules: false,
    loading: false,
    tableSizes: [],
    tableNumberName: [],
    tableNanesenie: [],
    itogoTableForZakazNanesenie: [],
    showItogZakazNanesenie: false,
    orders: [{
      order: new Order(),
      selectedType: null,
      selectedModel: null,
      selectedColor: null,
      drawings: {
        Логотипы: [],
        Номера: [],
        Строки: []
      },
      drawingCounter: 0,
      sizes: {}
    }],
    selectedOrder: 0,
    types: [],
    models: null,
    swiper: {
      slidesPerView: 4,
      spaceBetween: 10,
      slidesPerGroup: 1,
      loop: false,
      loopFillGroupWithBlank: false,
      slidesOffsetBefore: 0,
      slidesOffsetAfter: 40,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
      }
    },
    logos: [],
    drawings: [],
    colorsCode: [],
    sizesTooltip: [],
    fonts: [],
    fontName: "Nike",
    // показываем кнопку удаления нанесения
    showButtonDeleteDrawing: false,
    // показываем цвета текста для выбора
    showSelectColors: false,
    // текущие настройки нанесения логотипа
    logoProps: {
      image: null,
      i: null,
      size: null,
      price: null,
      type: null
    },
    // текущие настройки нанесения номера
    numberProps: {
      size: null,
      price: null,
      value: null,
      color: {
        name: "Черный",
        code: "#000000"
      }
    },
    // текущие настройки нанесения строки
    stringProps: {
      size: null,
      price: null,
      value: null,
      color: {
        name: "Черный",
        code: "#000000"
      }
    }
  };
  // текущий заказ
  currentOrder = appData.orders[appData.selectedOrder];
  // временное хранилище даных
  tempData = null;
  // временное хранение загруженного изображения
  imgCache = null;
  // функция получения данных из БД
  get = function get(name, callback, data = null) {
    $.getJSON(
      "assets/php/api.php", {
        action: "get",
        name: name,
        data: data
      },
      function (temp) {
        callback(temp);
      }
    );
  };
  // функция добавления нового заказа
  addOrder = function addOrder() {
    appData.orders.push({
      order: new Order(),
      selectedType: null,
      selectedModel: null,
      selectedColor: null,
      drawings: {
        Логотипы: [],
        Номера: [],
        Строки: []
      },
      drawingCounter: 0,
      sizes: {}
    });
    appData.selectedOrder++;
    currentOrder = appData.orders[appData.selectedOrder];
  };

  // подключаем компонент VueAwesomeSwiper
  Vue.use(VueAwesomeSwiper);

  // объект приложения Vue.js
  app = new Vue({
    el: "#c__app",
    components: {
      LocalSwiper: VueAwesomeSwiper.swiper,
      LocalSlide: VueAwesomeSwiper.swiperSlide
    },
    data: appData,
    methods: {
      deleteOrder(i) {
        this.selectOrder(0)
        if (this.orders && this.orders.length === 1) {
          let order = this.orders[i]
          order.selectedColor = null
          order.selectedType = null
          order.selectedModel = null
          order.order = new Order()
        } else {
          this.orders[i] = new Order()
          this.orders.splice(i, 1)
        }
        // } else {
        //   console.log(123)
        //   this.orders.selectedOrder = 0
        //   // this.orders.splice(i, 1)
        // }
      },
      toggleYurNanesenie() {
        this.yurik.showContractNanesenie = !this.yurik.showContractNanesenie;
        var el = this.$refs["yurik-contract-for-nanesenie"];
        if (el.style.maxHeight) {
          el.style.maxHeight = null;
        } else {
          el.style.maxHeight = el.scrollHeight + "px";
          el.style.height = el.scrollHeight + "px";
        }
      },
      toggleYurBuy() {
        this.yurik.showContractBuy = !this.yurik.showContractBuy;
        var el = this.$refs["yurik-contract-for-buy"];
        if (el.style.maxHeight) {
          el.style.maxHeight = null;
        } else {
          el.style.maxHeight = el.scrollHeight + "px";
          el.style.height = el.scrollHeight + "px";
        }
      },
      toggleFizNanesenie() {
        this.fizik.showContractNanesenie = !this.fizik.showContractNanesenie;
        var el = this.$refs["fizik-contract-for-nanesenie"];
        if (el.style.maxHeight) {
          el.style.maxHeight = null;
        } else {
          el.style.maxHeight = el.scrollHeight + "px";
          el.style.height = el.scrollHeight + "px";
        }
      },
      toggleFizBuy() {
        this.fizik.showContractBuy = !this.fizik.showContractBuy;
        var el = this.$refs["fizik-contract-for-buy"];
        if (el.style.maxHeight) {
          el.style.maxHeight = null;
        } else {
          el.style.maxHeight = el.scrollHeight + "px";
          el.style.height = el.scrollHeight + "px";
        }
      },
      toggleRules() {
        this.shoaAllRules = !this.shoaAllRules;
        var rules = this.$refs["rules-for-form"];
        if (rules.style.maxHeight) {
          rules.style.maxHeight = null;
        } else {
          rules.style.maxHeight = rules.scrollHeight + "px";
          rules.style.height = rules.scrollHeight + "px";
        }
      },
      prepareForm() {
        const date = new Date();
        const contractNumber =
          date.getFullYear().toString() +
          (date.getMonth() + 1).toString() +
          date.getDate() +
          date.getHours() +
          date.getMinutes() +
          date.getSeconds();
        this.fizik.number = contractNumber;
        this.yurik.number = contractNumber;

        this.fizik.date = date.toLocaleDateString();
        this.yurik.date = date.toLocaleDateString();
        this.fizik.price = 12;
        this.yurik.price = 13;

        this.fillTableSizes();
        this.fillTableItogoForZakazNanesenie();
        this.fillTableNumberName();
        let sumZakaz = 0;
        if (this.tableSizes && this.tableSizes.length > 0) {
          this.tableSizes.forEach(x => {
            if (x.sum) sumZakaz += x.sum;
          });
        }
        this.fizik.price = sumZakaz + this.itogoForZakazNanesenie;
        this.yurik.price = sumZakaz + this.itogoForZakazNanesenie;
      },
      sendForm() {
        let docBuy = ""
        let docNanesenie = ""
        let info = "";
        if (this.typeCustomer === "fizik") {
          docBuy = this.$refs["fizik-contract-for-buy"];
          docNanesenie = this.$refs["fizik-contract-for-nanesenie"];

          info =
            "Физ. лицо: " +
            this.fizik.lastName +
            " " +
            this.fizik.firstName +
            " " +
            this.fizik.middleName +
            "<br/>";
          info += "Телефон: " + this.fizik.phone + "<br/>";
          info +=
            "Договор купли-продажи №" +
            this.fizik.number +
            " от " +
            this.fizik.date +
            "<br/>";
          info +=
            "Договор оказания услуг №" +
            this.fizik.number +
            " от " +
            this.fizik.date +
            "<br/>";
          info += "Сумма договора: " + this.fizik.price + " руб.<br/>";
          if (this.fizik.email) info += "E-mail: " + this.fizik.email + "<br/>";
        }

        if (this.typeCustomer === "yurik") {
          docBuy = this.$refs["yurik-contract-for-buy"];
          docNanesenie = this.$refs["yurik-contract-for-nanesenie"];
          info = "Юридическое лицо: <br/>" + this.yurik.field1 + "<br/>";
          info += "Телефон: " + this.yurik.phone + "<br/>";
          if (this.yurik.email) info += "E-mail: " + this.yurik.email + "<br/>";
          if (this.yurik.field2) info += this.yurik.field2 + "<br/>";
          if (this.yurik.field3) info += this.yurik.field3 + "<br/>";
          info +=
            "Договор купли-продажи №" +
            this.yurik.number +
            " от " +
            this.yurik.date +
            "<br/>";
          info +=
            "Договор оказания услуг №" +
            this.yurik.number +
            " от " +
            this.yurik.date +
            "<br/>";
          info += "Сумма договора: " + this.yurik.price + " руб.<br/>";
        }

        let fd = new FormData();
        // const canvas = this.$refs;
        // const c = document.getElementById("modelImageCanvas_0");
        // console.log(c);
        // let images = [];
        this.orders.forEach((order, index) => {
          const img = document.getElementById("modelImageCanvas_" + index);
          img.toBlob(data => {
            // console.log(data);
            // images.push({
            //   name: order.order.model.name + " " + order.order.color.name,
            //   image: data
            // });
            fd.append(
              "images[]",
              data,
              order.order.model.name + " " + order.order.color.name
            );
          });
        });
        // console.log(fd.get("images"));
        // console.log(fd.values());
        // return;
        // console.log(this.tableSizes);
        // let data = {
        //   zakazTovar: this.tableSizes,
        //   zakazNanesenie: this.itogoTableForZakazNanesenie,
        //   zakazNumberName: this.tableNumberName,
        //   zakazNanesenieEach: this.tableNanesenie,
        //   images: images
        // };
        fd.append("zakazTovar", JSON.stringify(this.tableSizes));
        fd.append(
          "zakazNanesenie",
          JSON.stringify(this.itogoTableForZakazNanesenie)
        );
        fd.append("zakazNumberName", JSON.stringify(this.tableNumberName));
        fd.append("zakazNanesenieEach", JSON.stringify(this.tableNanesenie));
        fd.append("info", JSON.stringify(info));
        // fd.append("docBuy", docBuy.innerHTML);
        // fd.append("docNanesenie", JSON.stringify(docNanesenie));

        // console.log(docBuy.innerText)
        // return null
        // this.loading = true;
        const config = {
          "content-type": "multipart/form-data"
        };

        setTimeout(() => {
          axios
            .post("https://joma-club.ru/api/api/callback/create", fd, config)
            // .post("http://localhost/resume/back/public/api/callback/create", fd, config)
            .then(x => {
              this.loading = false;
            })
            .catch(() => {
              this.loading = false;
            });
        }, 2000);
      },
      fillTableNumberName: function () {
        let result = [];
        if (this.orders && this.orders.length > 0) {
          this.orders.forEach(order => {
            if (order.order.sizes && order.order.sizes.sizeNames) {
              Object.keys(order.order.sizes.sizeNames).forEach(sizeKey => {
                if (
                  order.order.sizes.sizeNames[sizeKey].numberSurname &&
                  order.order.sizes.sizeNames[sizeKey].numberSurname.length > 0
                ) {
                  order.order.sizes.sizeNames[sizeKey].numberSurname.forEach(
                    numName => {
                      result.push({
                        size: "Размер " + sizeKey,
                        number: numName.number,
                        name: numName.surname
                      });
                    }
                  );
                }
              });
            }
          });
        }
        this.tableNumberName = result;
      },
      fillTableItogoForZakazNanesenie: function () {
        this.fillTableSizes();
        let result = [];
        let resultForTableNanesenie = [];
        if (this.orders && this.orders.length > 0) {
          this.orders.forEach(order => {
            let bufArray = [];

            let countTshirt = 0;
            if (order.order.sizes && order.order.sizes.count) {
              countTshirt = order.order.sizes.count;
            }

            //Считаем логотипы
            if (
              order.order &&
              order.order.logotypes &&
              order.order.logotypes.sizeNames
            ) {
              Object.keys(order.order.logotypes.sizeNames).forEach(logo => {
                Object.keys(order.order.logotypes.sizeNames[logo]).forEach(
                  logoType => {
                    let buf = {
                      name: "Логотип " + logo + " " + logoType
                    };
                    let count = 0;
                    let sum = 0;

                    let bufForOrder = {
                      name: "Логотип " + logo + " " + logoType
                    };

                    const logoBuf =
                      order.order.logotypes.sizeNames[logo][logoType];
                    if (logoBuf) {
                      if (logoBuf.count) {
                        count += logoBuf.count;
                        bufForOrder.count = logoBuf.count;
                      }
                      if (logoBuf.total) {
                        sum += logoBuf.total;
                        bufForOrder.sum = logoBuf.total;
                      }
                      if (logoBuf.price) {
                        bufForOrder.price = logoBuf.price;
                      }
                    }
                    // Object.keys(order.order.logotypes.sizeNames[logo]).forEach(
                    //   logoInside => {
                    //   }
                    // );
                    buf.count = count * countTshirt;
                    buf.sum = sum * countTshirt;

                    let find = result.find(
                      x => x.name.toLowerCase() === buf.name.toLowerCase()
                    );
                    if (!find) {
                      result.push(buf);
                    } else {
                      find.count += buf.count;
                      find.sum += buf.sum;
                    }
                    bufArray.push(bufForOrder);
                  }
                );
              });
            }

            if (bufArray.length > 0) {
              const name =
                order.order.model.name + " " + order.order.color.name;
              const obj = {};
              obj[name] = bufArray;
              resultForTableNanesenie.push(obj);
            }

            //Считаем номера
            if (
              order.order &&
              order.order.numbers &&
              order.order.numbers.sizeNames
            ) {
              Object.keys(order.order.numbers.sizeNames).forEach(num => {
                let buf = {
                  name: "Номер " + num
                };

                let count = 0;
                let sum = 0;

                const numBuf = order.order.numbers.sizeNames[num];
                console.log(numBuf);
                if (numBuf) {
                  if (numBuf.count) count += numBuf.count;
                  if (numBuf.total) sum += numBuf.total;
                }
                buf.count = count * countTshirt;
                buf.sum = sum * countTshirt;

                let find = result.find(
                  x => x.name.toLowerCase() === buf.name.toLowerCase()
                );
                if (!find) {
                  result.push(buf);
                } else {
                  find.count += buf.count;
                  find.sum += buf.sum;
                }
              });
            }

            //Считаем надписи
            if (
              order.order &&
              order.order.strings &&
              order.order.strings.sizeNames
            ) {
              Object.keys(order.order.strings.sizeNames).forEach(str => {
                let buf = {
                  name: "Надписи " + str
                };

                let count = 0;
                let sum = 0;

                const strBuf = order.order.strings.sizeNames[str];
                console.log(strBuf);
                if (strBuf) {
                  if (strBuf.count) count += strBuf.count;
                  if (strBuf.total) sum += strBuf.total;
                }
                buf.count = count * countTshirt;
                buf.sum = sum * countTshirt;

                let find = result.find(
                  x => x.name.toLowerCase() === buf.name.toLowerCase()
                );
                if (!find) {
                  result.push(buf);
                } else {
                  find.count += buf.count;
                  find.sum += buf.sum;
                }
              });
            }
          });
        }

        this.itogoTableForZakazNanesenie = result;
        this.tableNanesenie = resultForTableNanesenie;
      },
      fillTableSizes: function () {
        let result = [];
        if (this.orders && this.orders.length > 0) {
          this.orders.forEach(order => {
            if (
              order.order &&
              order.order.sizes &&
              order.order.sizes.sizeNames
            ) {
              Object.keys(order.order.sizes.sizeNames).forEach(size => {
                if (
                  order.order.sizes.sizeNames[size] &&
                  order.order.sizes.sizeNames[size].count &&
                  order.order.sizes.sizeNames[size].count > 0
                ) {
                  const buf = order.order.sizes.sizeNames[size];
                  result.push({
                    name: order.order.model.name + " " + order.order.color.name,
                    size: size,
                    countMoscow: buf.countMoscow,
                    countSpain: buf.countSpain,
                    count: buf.count,
                    price: buf.price,
                    sum: buf.total
                  });
                }
              });
            }
          });
        }
        // Vue.set(app, 'tableSizes', result)
        this.tableSizes = result;
      },
      // кликнули по вкладке заказа
      selectOrder: function (selectedOrder) {
        appData.selectedOrder = selectedOrder;
        currentOrder = appData.orders[selectedOrder];
        this.showItogZakazNanesenie = false;
      },
      toggleItogZakazNanesenie() {
        this.showItogZakazNanesenie = true;
      },
      // выбрали тип
      selectType: function (selectedType) {
        // если модели не загружались
        if (appData.types[selectedType].models.length == 0) {
          console.log("Загрузка моделей");
          // получаем модели для выбранного типа
          get(
            "models",
            function (models) {
              appData.types[selectedType].models = models;
            }, {
              ntype: selectedType
            }
          );
        }
        // изменяем тип на выбранный
        currentOrder.order.typeName = appData.types[selectedType].name;
        currentOrder.selectedType = selectedType;
        currentOrder.selectedModel = null;
        currentOrder.selectedColor = null;
      },
      // выбрали модель
      selectModel: function (selectedModel) {
        // если цвета не загружались
        if (
          appData.types[currentOrder.selectedType].models[selectedModel].colors
          .length == 0
        ) {
          console.log("Загрузка цветов");
          // получаем цвета для выбранной модели
          get(
            "colors",
            function (colors) {
              appData.types[currentOrder.selectedType].models[
                selectedModel
              ].colors = colors;
            }, {
              ntype: currentOrder.selectedType,
              nmodel: selectedModel
            }
          );
        } else {
          // удаляем ранее загруженные данные о цвете
          currentOrder.order.clearColor();
        }

        currentOrder.order.model.name =
          appData.types[currentOrder.selectedType].models[selectedModel][
            "Название"
          ];
        currentOrder.selectedModel = selectedModel;
        currentOrder.selectedColor = null;
      },
      // выбрали цвет
      selectColor: function (selectedColor) {
        console.log("Выбран цвет " + selectedColor);
        currentOrder.selectedColor = selectedColor;

        get(
          "model",
          function (model) {
            // удаляем предыдущие загруженные размеры
            currentOrder.order.clearSizes();

            // устанавливаем доступные размеры
            $.each(model["Размеры"], function (sizeName) {
              currentOrder.sizes[sizeName] = {
                count: 0,
                countMoscow: 0,
                countSpain: 0,
                price: model["Размеры"][sizeName]["Цена"],
                numberAndSurname: []
              };
              // добавление нового размера
              currentOrder.order.addSize(
                sizeName,
                model["Размеры"][sizeName]["Штрихкод"],
                model["Размеры"][sizeName]["Цена"],
                model["Размеры"][sizeName]["Количество"]
              );
            });
            // объединяем уже существующие данные модели с полученными
            appData.types[currentOrder.selectedType].models[
              currentOrder.selectedModel
            ] = Object.assign(
              appData.types[currentOrder.selectedType].models[
                currentOrder.selectedModel
              ],
              model
            );

            currentOrder.order.model.description =
              appData.types[currentOrder.selectedType].models[
                currentOrder.selectedModel
              ]["Описание"];
            currentOrder.order.color.name =
              appData.types[currentOrder.selectedType].models[
                currentOrder.selectedModel
              ].colors[selectedColor]["Название"];
            currentOrder.order.color.articul =
              appData.types[currentOrder.selectedType].models[
                currentOrder.selectedModel
              ].colors[selectedColor]["Артикул"];
            currentOrder.order.color.imageFront =
              appData.types[currentOrder.selectedType].models[
                currentOrder.selectedModel
              ]["ВидСпереди"];
            currentOrder.order.color.imageBack =
              appData.types[currentOrder.selectedType].models[
                currentOrder.selectedModel
              ]["ВидСзади"];
            // стоимость нанесения строки
            currentOrder.order.strings.price = Object.values(
              appData.drawings["Надпись"].sizes
            )[0].price;

            // если холст еще не создан
            if (canvases[appData.selectedOrder] == null) {
              console.log("- Создан новый холст");
              // добавляем холст
              canvases[appData.selectedOrder] = new Canvas(
                "modelImageCanvas_" + appData.selectedOrder
              );
            }
            // удаляем предыдущие изображения ВидСпереди и ВидСзади
            canvases[appData.selectedOrder].removeImage("ВидСпереди");
            canvases[appData.selectedOrder].removeImage("ВидСзади");
            // если есть картинка для вида сзади
            if (model["ВидСзади"]) {
              // показываем вид спереди
              canvases[appData.selectedOrder].addImage(
                "ВидСпереди",
                model["ВидСпереди"],
                function (img) {
                  img.set({
                    scaleX: canvases[appData.selectedOrder].ctx.width / img.width / 2,
                    scaleY: canvases[appData.selectedOrder].ctx.height / img.height,
                    originX: 0,
                    originY: "top",
                    selectable: false
                  });
                },
                function (img) {
                  img.sendToBack();
                }
              );
              // показываем вид сзади
              canvases[appData.selectedOrder].addImage(
                "ВидСзади",
                model["ВидСзади"],
                function (img) {
                  img.set({
                    scaleX: canvases[appData.selectedOrder].ctx.width / img.width / 2,
                    scaleY: canvases[appData.selectedOrder].ctx.height / img.height,
                    originX: -1,
                    originY: "top",
                    selectable: false
                  });
                },
                function (img) {
                  img.sendToBack();
                }
              );
            } else {
              // если нет вида сзади, показываем вид спереди по середине
              canvases[appData.selectedOrder].addImage(
                "ВидСпереди",
                model["ВидСпереди"],
                function (img) {
                  img.set({
                    scaleX: canvases[appData.selectedOrder].ctx.width / img.width / 2,
                    scaleY: canvases[appData.selectedOrder].ctx.height / img.height,
                    originX: -0.5,
                    originY: "top",
                    selectable: false
                  });
                },
                function (img) {
                  img.sendToBack();
                }
              );
            }
            // перерисовываем приложение Vue
            app.$forceUpdate();
          }, {
            ntype: currentOrder.selectedType,
            nmodel: currentOrder.selectedModel,
            ncolor: currentOrder.selectedColor
          }
        );
        // делаем скролл к области выбранной модели
        $("html, body").animate({
            scrollTop: $("#model").offset().top
          },
          500
        );
      },
      // добавление логотипа
      addLogo: function () {
        // добавляем логотип
        logoId = currentOrder.order.addLogotype(
          appData.logoProps.size,
          appData.logoProps.type,
          appData.logoProps.price,
          appData.logoProps.image
        );

        // имя нанесения
        /*var drawingName = "Нанесение логотипа " + appData.logoProps.size + " мм (" + appData.logoProps.type + ")"
        console.log(drawingName)
        // если уже добавляли логотипы с таким же размером и типом нанесения
        if (drawingName in currentOrder.drawings["Логотипы"]) {
            // добавляем новое изображение в массив таких логотипов
            currentOrder.drawings["Логотипы"][drawingName]["drawings"].push({
                id: logoId,
                "Изображение": appData.logoProps.image
            })
            currentOrder.drawings["Логотипы"][drawingName]["Количество"] += 1
        } else {
            // создаем массив для таких логотипов и добавляем изображение выбранного логотипа
            currentOrder.drawings["Логотипы"][drawingName] = {
                "Цена": logotypePrice,
                "Количество": 1,
                "drawings": [{
                    id: logoId,
                    "Изображение": appData.logoProps.image
                }]
            }
        }*/
        //console.log(currentOrder.drawings)
        // добавляем логотип
        canvases[appData.selectedOrder].addImage(
          logoId,
          appData.logoProps.image,
          function (img) {
            /*
          считаем коэффициент масштабирования scale, чтобы изображения добавлялись
          на холст всегда с одинаковыми размерами (или по высоте, или по ширине)
          */
            if (img.width >= img.height) {
              var scale = parseInt(appData.logoProps.size) / 3 / img.width;
            } else {
              var scale = parseInt(appData.logoProps.size) / 3 / img.height;
            }
            // устанавливаем настройки изображения
            img.set({
              scaleX: scale,
              scaleY: scale,
              left: canvases[appData.selectedOrder].ctx.width / 2,
              top: canvases[appData.selectedOrder].ctx.height / 2,
              originX: "center",
              originY: "center",
              centeredScaling: true,
              padding: 10,
              transparentCorners: false,
              borderColor: "#000000",
              cornerColor: "#000000",
              cornerStrokeColor: "#000000"
            });
            // скрываем элементы управления нанесением
            img.setControlVisible("ml", false);
            img.setControlVisible("mr", false);
            img.setControlVisible("mt", false);
            img.setControlVisible("mb", false);
            img.setControlVisible("mtr", false);
          }
        );
      },
      // загрузка своего логотипа
      addLogoImage: function (event) {
        var input = event.target;
        var reader = new FileReader();
        let that = this;
        reader.onload = function () {
          console.log(reader.result);
          // добавляем изображение в массив логотипов
          appData.logos.splice(0, 0, {
            Изображение: reader.result
          });
          // выбираем добавленный логотип
          that.setLogoImage(reader.result, 0);
          console.log(reader.result);
        };
        reader.readAsDataURL(input.files[0]);
        input.value = null;
      },
      // добавление номера
      addNumber: function () {
        // если номера нет, выходим из функции
        if (
          appData.numberProps.value == null ||
          appData.numberProps.value == ""
        )
          return;

        // добавляем номер к текущему заказу
        numberId = currentOrder.order.addNumber(
          appData.numberProps.size,
          appData.numberProps.price,
          appData.numberProps.value,
          appData.fontName,
          appData.numberProps.color
        );
        console.log(numberId);

        // добавляем номер на холст
        canvases[appData.selectedOrder].addText(
          numberId,
          appData.numberProps.value, {
            originX: "center",
            originY: "center",
            left: canvases[appData.selectedOrder].ctx.width * 0.5,
            top: canvases[appData.selectedOrder].ctx.height * 0.5,
            fontFamily: appData.fontName,
            fontSize: parseInt(appData.numberProps.size) * 0.35,
            fill: appData.numberProps.color.code,
            centeredScaling: true,
            padding: 10,
            transparentCorners: false,
            borderColor: "#000000",
            cornerColor: "#000000",
            cornerStrokeColor: "#000000"
          }
        );
      },
      // добавление строки
      addString: function () {
        // если строки нет, выходим из функции
        if (
          appData.stringProps.value == null ||
          appData.stringProps.value == ""
        )
          return;

        // добавляем строку к текущему заказу
        stringId = currentOrder.order.addString(
          appData.stringProps.size,
          appData.stringProps.price,
          appData.stringProps.value,
          appData.fontName,
          appData.stringProps.color
        );
        console.log(stringId);

        // добавляем строку на холст
        canvases[appData.selectedOrder].addText(
          stringId,
          appData.stringProps.value, {
            originX: "center",
            originY: "center",
            left: canvases[appData.selectedOrder].ctx.width * 0.5,
            top: canvases[appData.selectedOrder].ctx.height * 0.5,
            fontFamily: appData.fontName,
            fontSize: parseInt(appData.stringProps.size) * 0.35,
            fill: appData.stringProps.color.code,
            centeredScaling: true,
            padding: 10,
            transparentCorners: false,
            borderColor: "#000000",
            cornerColor: "#000000",
            cornerStrokeColor: "#000000"
          }
        );
      },
      // показываем область информации о модели и холст
      showAreaModelImage: function (orderIndex) {
        if (
          appData.orders[appData.selectedOrder].selectedColor != null &&
          orderIndex == appData.selectedOrder
        ) {
          return true;
        } else {
          return false;
        }
      },
      // показываем детали заказа (таблица размеров, кнопки, размер-номер-фамилия и т.д.)
      showOrderDetails: function () {
        // инициализируем все подсказки
        $('[data-toggle="tooltip"]').tooltip();
        // если загрузили типы, модель и размеры, если выбрали модель и цвет
        return (
          typeof appData.types[
            appData.orders[appData.selectedOrder].selectedType
          ] != "undefined" &&
          typeof appData.types[
            appData.orders[appData.selectedOrder].selectedType
          ].models[appData.orders[appData.selectedOrder].selectedModel] !=
          "undefined" &&
          typeof appData.types[
            appData.orders[appData.selectedOrder].selectedType
          ].models[appData.orders[appData.selectedOrder].selectedModel][
            "Размеры"
          ] != "undefined" &&
          appData.orders[appData.selectedOrder].order.model.name != null &&
          appData.orders[appData.selectedOrder].order.color.name != null
        );
      },
      // функция удаления выбранного нанесения
      deleteSelectedDrawing: function () {
        console.log("Удаление выбранного нанесения...");
        try {
          // выделенное нанесение
          var selectedDrawing = canvases[
            appData.selectedOrder
          ].ctx.getActiveObject();

          // если выбрали изображение
          if (selectedDrawing.type == "image") {
            console.log(" - Выбрали изображение");
            for (imageId in canvases[appData.selectedOrder].images) {
              if (
                canvases[appData.selectedOrder].images[imageId] ==
                selectedDrawing
              ) {
                console.log(" - ID удаляемого изображения: " + imageId);
                // удаляем логотип из заказа
                currentOrder.order.removeLogotype(imageId);
                // удаляем изображение логотипа с холста
                canvases[appData.selectedOrder].removeImage(imageId);
              }
            }
          }
          // если выбрали текст
          else if (selectedDrawing.type == "text") {
            console.log(" - Выбрали текст");
            for (textName in canvases[appData.selectedOrder].texts) {
              if (
                canvases[appData.selectedOrder].texts[textName] ==
                selectedDrawing
              ) {
                // удаляем номер или надпись из заказа
                currentOrder.order.removeNumber(textName);
                currentOrder.order.removeString(textName);
                // удаляем текст с холста
                canvases[appData.selectedOrder].removeText(textName);
              }
            }
          }
        } catch {}
      },
      // обновляем объект Размер-Номер-Фамилия (orders[selectedOrder].sizes[sizeName].numberAndSurname)
      updateSizes: function () {
        for (sizeName in this.orders[this.selectedOrder].sizes) {
          // считаем на сколько изменилось количество заказа для размера sizeName
          var raznost =
            this.orders[this.selectedOrder].sizes[sizeName].count -
            this.orders[this.selectedOrder].sizes[sizeName].numberAndSurname
            .length;
          if (raznost > 0) {
            // добавляем поля игрока "Номер" и "Фамилия"
            while (raznost > 0) {
              this.orders[this.selectedOrder].sizes[
                sizeName
              ].numberAndSurname.push({
                number: null,
                surname: null
              });
              raznost--;
            }
          } else if (raznost < 0) {
            // удаляем последние поля игрока "Номер" и "Фамилия"
            while (raznost < 0) {
              this.orders[this.selectedOrder].sizes[
                sizeName
              ].numberAndSurname.pop();
              raznost++;
            }
          }
        }
      },
      // пересчет количества заказа со слада в Москве
      countMoscow: function (j, countOrder) {
        appData.orders[appData.selectedOrder].sizes[j].countMoscow =
          appData.orders[appData.selectedOrder].sizes[j].count <= countOrder ?
          appData.orders[appData.selectedOrder].sizes[j].count :
          countOrder;
        return appData.orders[appData.selectedOrder].sizes[j].countMoscow;
      },
      // пересчет количества заказа со слада в Испании
      countSpain: function (j, countOrder) {
        appData.orders[appData.selectedOrder].sizes[j].countSpain =
          appData.orders[appData.selectedOrder].sizes[j].count > countOrder ?
          appData.orders[appData.selectedOrder].sizes[j].count - countOrder :
          0;
        return appData.orders[appData.selectedOrder].sizes[j].countSpain;
      },
      // итоговая стоимость всех товаров (БЕЗ НАНЕСЕНИЯ)
      totalProduct: function () {
        tmpTotalProduct = 0;
        $.map(appData.orders, function (order) {
          tmpTotalProduct += order.order.sizes.total;
        });
        return tmpTotalProduct;
      },
      // итоговая стоимость всех нанесений
      totalDrawings: function () {
        tmpTotalDrawings = 0;
        $.map(appData.orders, function (order) {
          tmpTotalDrawings += order.order.logotypes.total;
          tmpTotalDrawings += order.order.numbers.total;
          tmpTotalDrawings += order.order.strings.total;
        });
        return tmpTotalDrawings;
      },
      /*// нанесения со всех заказов
      ordersDrawings: function() {
          // возвращаемая таблица с результатом
          r = {
              rows: [],
              total: 0
          }

          // цикл по заказам
          for (i in this.orders) {
              // указатели на объекты заказа
              // логотипы
              logotypes = this.orders[i]['drawings']['Логотипы']

              // цикл по логотипам
              for (logotypeName in logotypes) {
                  // данные логотипа
                  logotypeCount = logotypes[logotypeName]["Количество"]
                  logotypePrice = logotypes[logotypeName]["Цена"]
                  logotypeSumma = logotypeCount * logotypePrice

                  // если строка уже существует
                  if (logotypeName in r.rows) {
                      // добавляем к строке количество таких же логотипов и их сумму для текущего заказа
                      r.rows[logotypeName].count += logotypeCount
                      r.rows[logotypeName].summa += logotypeSumma
                  } else {
                      // создаем новую строку
                      r.rows[logotypeName] = {
                          count: logotypeCount,
                          price: logotypePrice,
                          summa: logotypeSumma
                      }
                  }
                  // прибавляем стоимость логотипа к общей стоимости нанесений
                  r.total += logotypeSumma
              }

              // цикл по номерам
              for (numberName in logotypes) {
                  // данные логотипа
                  logotypeCount = logotypes[logotypeName]["Количество"]
                  logotypePrice = logotypes[logotypeName]["Цена"]
                  logotypeSumma = logotypeCount * logotypePrice

                  // если строка уже существует
                  if (logotypeName in r.rows) {
                      // добавляем к строке количество таких же логотипов и их сумму для текущего заказа
                      r.rows[logotypeName].count += logotypeCount
                      r.rows[logotypeName].summa += logotypeSumma
                  } else {
                      // создаем новую строку
                      r.rows[logotypeName] = {
                          count: logotypeCount,
                          price: logotypePrice,
                          summa: logotypeSumma
                      }
                  }
                  // прибавляем стоимость логотипа к общей стоимости нанесений
                  r.total += logotypeSumma
              }
          }

          return r
      },*/
      setLogoImage: function (image, i) {
        appData.logoProps.image = image;
        appData.logoProps.i = i;
      },
      setLogoSize: function (size) {
        appData.logoProps.size = size;
        // устанавливаем тип нанесения для логотипа по умолчанию
        appData.logoProps.type = Object.keys(
          appData.drawings["Логотип"].sizes[appData.logoProps.size].types
        )[0];
        // устанавливаем цену логотипа
        appData.logoProps.price =
          appData.drawings["Логотип"].sizes[appData.logoProps.size].types[
            appData.logoProps.type
          ].price;
      },
      setNumberSize: function (size) {
        appData.numberProps.size = size;
        // устанавливаем цену номера
        appData.numberProps.price =
          appData.drawings["Номер"].sizes[appData.numberProps.size].price;
      },
      setStringSize: function (size) {
        appData.stringProps.size = size;
        // устанавливаем цену надписи
        appData.stringProps.price =
          appData.drawings["Надпись"].sizes[appData.stringProps.size].price;
      },
      setTextColor: function (colorName, colorCode, forObject) {
        forObject.color.name = colorName;
        forObject.color.code = colorCode;
        appData.showSelectColors = false;
        // обновляем цвет выбранного текста (если он есть)
        try {
          // выделенное нанесение
          var selectedDrawing = canvases[
            appData.selectedOrder
          ].ctx.getActiveObject();
          // если выделенное нанесение это текст
          if (selectedDrawing.type == "text") {
            for (textName in canvases[appData.selectedOrder].texts) {
              if (
                canvases[appData.selectedOrder].texts[textName] ==
                selectedDrawing
              ) {
                canvases[appData.selectedOrder].updateTextColor(
                  textName,
                  colorCode
                );
              }
            }
          }
        } catch {}
      }
    },
    computed: {
      allowSendFormFizik() {
        if (this.typeCustomer === "fizik")
          return (
            this.fizik.agreeContractBuy === false ||
            this.fizik.agreeContractNanesenie === false ||
            !this.fizik.firstName ||
            !this.fizik.lastName ||
            !this.fizik.middleName ||
            !this.fizik.phone
          );
        if (this.typeCustomer === "yurik")
          return (
            this.yurik.agreeContractBuy === false ||
            this.yurik.agreeContractNanesenie === false ||
            !this.yurik.field1 ||
            !this.yurik.phone
          );
      },
      itogoForZakazNanesenie: function () {
        let result = 0;
        this.itogoTableForZakazNanesenie.forEach(x => (result += x.sum));
        return result;
      },
      sumForTableSizes: function () {
        let result = 0;
        this.tableSizes.forEach(x => {
          result += x.sum;
        });
        return result;
      },
      swiperModels: function () {
        return this.$refs.swiperModels.swiper;
      },
      swiperColors: function () {
        return this.$refs.swiperColors.swiper;
      },
      // показываем модели
      showModels: function () {
        // если у текущего заказа выбран ТИП одежды
        if (appData.orders[appData.selectedOrder].selectedType != null) {
          return true;
        } else {
          return false;
        }
      },
      // показываем цвета
      showColors: function () {
        // если у текущего заказа выбрана МОДЕЛЬ одежды
        if (appData.orders[appData.selectedOrder].selectedModel != null) {
          return true;
        } else {
          return false;
        }
      },
      // показываем вкладки заказов
      showTabOrder: function () {
        // если у текущего заказа выбрана модель и цвет
        if (
          this.orders[this.selectedOrder].order.model.name != null &&
          this.orders[this.selectedOrder].order.color.name != null
        ) {
          return true;
        } else {
          return false;
        }
      },
      // показываем область выбора типа, модели и цвета
      showAreaChoice: function () {
        // если у текущего заказа не выбран цвет
        if (appData.orders[appData.selectedOrder].selectedColor == null) {
          return true;
        } else {
          return true;
        }
      },
      // показываем область наложения нанесений
      showDrawings: function () {
        // если загрузили логотипы, нанесения, цвета, шрифты
        if (
          appData.logos.length != 0 &&
          appData.drawings.length != 0 &&
          appData.colorsCode.length != 0 &&
          appData.fonts.length != 0
        ) {
          return true;
        } else {
          return false;
        }
      },
      // показываем таблицу Размер-Номер-Фамилия
      showTableRazNomFam: function () {
        // если загрузили размеры
        if (
          Object.keys(appData.orders[appData.selectedOrder].sizes).length != 0
        ) {
          return true;
        } else {
          return false;
        }
      },
      // стоимость всех логотипов со всех заказов
      logotypesTotal: function () {
        logotypesTotal = 0;
        appData.orders.forEach(order => {
          logotypesTotal += order.order.logotypes.total;
        });
        return logotypesTotal;
      },
      // строка в верхнем регистре
      stringPropsValue: function () {
        appData.stringProps.value = appData.stringProps.value.toUpperCase();
        return appData.stringProps.value;
      }
    }
  });
  // получаем типы одежды
  get("types", function (types) {
    console.log("Получили типы");
    tmp = types;
    for (i in types) {
      appData.types.push({
        name: types[i],
        models: []
      });
    }
  });
  // получаем логотипы
  get("logos", function (logos) {
    console.log("Получили логотипы");
    tmp = logos;
    appData.logos = logos;
    // устанавливаем по умолчанию первый логотип
    appData.logoProps.image = logos[0]["Изображение"];
    appData.logoProps.i = 0;
  });
  // получаем типы нанесений
  get("drawings", function (drawings) {
    console.log("Получили типы нанесений");
    tmp = drawings;
    appData.drawings = drawings;

    // устанавливаем размер логотипа по умолчанию
    app.setLogoSize(Object.keys(appData.drawings["Логотип"].sizes)[0]);

    // устанавливаем размер номера по умолчанию
    app.setNumberSize(Object.keys(appData.drawings["Номер"].sizes)[0]);

    // устанавливаем размер надписи по умолчанию
    app.setStringSize(Object.keys(appData.drawings["Надпись"].sizes)[0]);
  });
  // получаем коды цветов
  get("colorsCode", function (colorsCode) {
    console.log("Получили коды цветов");
    tmp = colorsCode;
    appData.colorsCode = colorsCode;
  });
  // получаем подсказки к размерам
  get("sizesTooltip", function (sizesTooltip) {
    console.log("Получили подсказки к размерам");
    tmp = sizesTooltip;
    appData.sizesTooltip = sizesTooltip;
  });
  // получаем названия шрифтов
  get("fonts", function (fonts) {
    console.log("Получили названия шрифтов");
    tmp = fonts;
    appData.fonts = fonts;
  });
  // отслеживаем нажатие клавиши Delete для удаления нанесений
  $("html").keydown(function (eventObject) {
    if (event.keyCode == 46) {
      //если нажали Delete
      try {
        app.deleteSelectedDrawing();
      } catch {}
    }
  });
});