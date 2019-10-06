<template>
  <v-container>
    <v-row>
      <v-col>
        <h1 class="white--text text-center" v-if="language === 'en'">Recent Portfolio</h1>
        <h1 class="white--text text-center" v-if="language === 'ru'">Портфолио</h1>
      </v-col>
    </v-row>
    <v-row class="pa-12">
      <v-col cols="12" md="4" class="pa-5" v-for="product in products" :key="product.id">
        <figure @click="openDialog($event, product)">
          <img :src="product.img[0]" alt="img04">
          <figcaption class="fig-caption">
              <i class="fa fa-search"></i>
              <h5 class="title">{{product.name}}</h5>
              <span class="sub-title">{{product.tech}}</span>
          </figcaption>
      </figure>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import Dialog from './Dialog/SliderDialog'
const settings = {
  height: 'auto',
  // maxWidth: 400,
  adaptive: true,
  transition: 'nice-modal-fade',
  clickToClose: true
}
export default {
  props: ['language'],
  methods: {
    openDialog (e, product) {
      e.preventDefault()
      this.$modal.show(Dialog, { product: product }, settings)
    }
  },
  data: () => ({
    products: [
      {
        id: 1,
        name: 'Animal Flow',
        tech: 'PHP (Lumen) + MySQL + JS (Vue + Vuex) ',
        text: 'Web-сайт сертифицированного инструктора методики ANIMAL FLOW.',
        site: 'https://evgeniakabanova.com/',
        img: ['./img/products/p19_3.jpg', './img/products/p19_1.jpg', './img/products/p19_2.jpg']
      },
      {
        id: 2,
        name: 'Управление поддоменами',
        tech: 'PHP (Lumen) + MySQL + JS (Vue + Vuex) ',
        text: 'Web-интерфейс для агрегирования и управления поддомена клстера РБТ',
        site: null,
        img: ['./img/products/rbt1.jpg', './img/products/rbt2.jpg']
      },
      {
        id: 15,
        tech: 'Vue + CSS + HTML',
        name: 'Сайт резюме',
        text: null,
        site: null,
        img: ['./img/products/03/031.jpg']
      },
      {
        id: 3,
        tech: '.NET Core, CSS, HTML',
        name: 'CRM транспортные перевозки',
        text: 'Доработка раздела контрагенты, доавление возмжности загрузки изображений логотипов, подписей рукводителй, факсимиле, для дальнейшего вывода в отчетности. Реализация отчетов договор-поручение, договор-заявка, счет.',
        site: null,
        img: ['./img/products/s17-1.jpg', './img/products/s17-2.jpg']
      },
      {
        id: 4,
        tech: 'ASP.NET MVC, WebAPI, JavaScript, CSS',
        name: 'Программа лояльности "HOLIKA"',
        text: 'Верстка личного кабинет по PSD шаблону, реализация взаимодействия ЛК с WebAPI программы лояльности, авторизация через JSON WEB TOKEN.',
        site: 'http://kbeautyclub.ru/',
        img: ['./img/products/s15-1.jpg', './img/products/s15-2.jpg', './img/products/s15-3.jpg', './img/products/s15-4.jpg']
      },
      {
        id: 5,
        tech: 'ASP.NET MVC, WebAPI, JavaScript',
        name: 'Программа лояльности',
        text: 'Реализация авторизации через JSON Web Token, рефакторинг кода, доработка методов Web API',
        site: 'https://mloyalty.ru/',
        img: ['./img/products/14/141.jpg', './img/products/14/142.jpg', './img/products/14/143.jpg', './img/products/14/144.jpg']
      },
      {
        id: 6,
        tech: 'PHP (Laravel framework + MySQL) + API Яндекс.Карт',
        name: 'Таунхаусы «Парк Апрель»',
        text: 'Отрисовка карты таунхаусов с помощью API Яндекс.Карт',
        site: 'https://p-aprel.ru/',
        img: ['./img/products/13/131.jpg', './img/products/13/132.jpg', './img/products/13/133.jpg', './img/products/13/134.jpg']
      },
      {
        id: 7,
        tech: 'PHP (Laravel framework + MySQL + Vue) + CSS',
        name: 'Агромастер',
        text: 'Доработка главного меню, а также стилей панели управления CRM.',
        site: null,
        img: ['./img/products/11/111.jpg', './img/products/11/112.jpg']
      },
      {
        id: 8,
        tech: 'CSS/HTML/JS - верстка страниц.',
        name: 'Mera Costume',
        text: 'Небольшой опыт работы на зарубежной площадке "Upwork".',
        site: null,
        img: ['./img/products/12/121.jpg', './img/products/12/122.jpg', './img/products/12/123.jpg']
      },
      {
        id: 9,
        tech: 'PHP (Laravel framework + MySQL), Vue.js',
        name: 'ДЮСШ "СТАРТ"',
        text: 'Самостоятельная разработка веб-сайта для информационного обеспечения населения города о предоставляемых услугах и результатах деятельности учреждения',
        site: 'https://start-uray.ru/',
        img: ['./img/products/10/101.jpg', './img/products/10/102.jpg']
      },
      {
        id: 10,
        tech: 'Верстка шаблонов, доработка функционала серверной части (ASP.NET MVC), исправление ошибок БД (SQL Server)',
        name: 'KRASNOE & ЧЕРНОЕ',
        text: 'КЛУБ "KRASNOE & ЧЕРНОЕ" - СООБЩЕСТВО АКТИВНЫХ, ИНТЕРЕСНЫХ И ПРЕДПРИИМЧИВЫХ ЛЮДЕЙ',
        site: 'http://redblackclub.ru/',
        img: ['./img/products/08/081.jpg', './img/products/08/082.jpg', './img/products/08/083.jpg']
      },
      {
        id: 11,
        tech: 'Разработка серверной части (ASP.NET Web API), клиентской части (Angular 2) + СУБД MS SQL Server',
        name: 'АРМ МФЦ',
        text: 'АРМ МФЦ - это система для учета поступивших обращений от посетителей',
        site: null,
        img: ['./img/products/09/091.jpg', './img/products/09/092.jpg', './img/products/09/093.jpg', './img/products/09/094.jpg']
      },
      {
        id: 12,
        tech: 'PHP (Laravel framework) + MySql',
        name: 'Федерация уличного танца',
        text: 'Система для ведения расписаний по группам, учета посещаемости учеников, ведения платежных карт, расчета задолженности, расчета проведенных занятий тренерами групп',
        site: null,
        img: ['./img/products/07/071.jpg', './img/products/07/072.jpg', './img/products/07/073.jpg', './img/products/07/074.jpg']
      },
      {
        id: 13,
        tech: 'Wordpress',
        name: 'Агентство недвижимости',
        text: 'Сайт агентства недвижимости "Ваш Риэлтор..."',
        site: 'http://vashrealtor-urai.ru/',
        img: ['./img/products/06/061.jpg', './img/products/06/062.jpg']
      },
      {
        id: 14,
        tech: 'ASP.NET MVC + MS SQL Server 2008',
        name: 'Интернет-магазин',
        text: null,
        site: null,
        img: ['./img/products/01/011.jpg', './img/products/01/012.jpg']
      },
      {
        id: 16,
        tech: 'ASP.NET MVC + БД Oracle 10g. + Entity Framework 6',
        name: 'Геологическая программа v.2',
        text: 'Обновленная версия веб приложение для выгрузки, просмотра технологических параметров скважины, замерных значений телеметрии. Программа показывает каких данных не хватает для расчета давлений на скважинах.',
        site: null,
        img: ['./img/products/04/041.jpg', './img/products/04/042.jpg', './img/products/04/043.jpg']
      }
    ]
  })

}
</script>

<style>

</style>
