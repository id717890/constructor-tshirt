<template>
  <v-container>
    <v-row>
      <v-col>
        <h1 class="white--text text-center" v-if="language === 'en'">
          What do you need?
        </h1>
        <h1 class="white--text text-center" v-if="language === 'ru'">
          Что Вам нужно?
        </h1>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12" class="text-center">
        <v-btn
          :disabled="status"
          x-large
          color="green darken-2"
          dark
          tile
          v-if="language === 'en'"
          @click="showCallDialog"
        >
          <v-icon class="mr-5">fab fa-telegram-plane</v-icon> Send Request
        </v-btn>
        <v-btn
          :disabled="status"
          x-large
          color="green darken-2"
          dark
          tile
          v-else
          @click="showCallDialog"
        >
          <v-icon class="mr-5">fab fa-telegram-plane</v-icon>Отправить запрос
        </v-btn>
      </v-col>
    </v-row>
    <v-row class="pa-12 pt-0">
      <v-col
        cols="12"
        md="4"
        class="pa-5"
        v-for="job in typeJobs"
        :key="job.id"
      >
        <v-card
          dark
          outlined
          class="main-bg"
          :class="typeJobSelected === job.id ? 'elevation-10' : ''"
          v-if="language === 'en'"
        >
          <v-card-title style="word-break: normal">{{
            job.nameEn
          }}</v-card-title>
          <!-- <v-card-text v-text="job.shortDescEn"></v-card-text> -->
          <v-card-actions>
            <!-- <v-btn text>Share</v-btn> -->
            <v-btn
              color="purple"
              v-if="typeJobSelected !== job.id"
              text
              @click="selectJobType(job.id)"
              >Select</v-btn
            >
            <v-btn color="success" v-else text @click="selectJobType(job.id)"
              >Unselect</v-btn
            >
            <v-spacer></v-spacer>
            <v-btn icon @click="job.showDesc = !job.showDesc">
              <v-icon>{{
                job.showDesc ? 'mdi-chevron-up' : 'mdi-chevron-down'
              }}</v-icon>
            </v-btn>
          </v-card-actions>
          <v-expand-transition>
            <div v-show="job.showDesc">
              <v-divider></v-divider>
              <v-card-text
                v-text="job.shortDescEn"
                class="text-justify"
              ></v-card-text>
            </div>
          </v-expand-transition>
        </v-card>
        <v-card
          dark
          outlined
          class="main-bg"
          :class="typeJobSelected === job.id ? 'elevation-10' : ''"
          v-if="language === 'ru'"
        >
          <v-card-title style="word-break: normal">{{
            job.nameRu
          }}</v-card-title>
          <!-- <v-card-text v-text="job.shortDescEn"></v-card-text> -->
          <v-card-actions>
            <!-- <v-btn text>Share</v-btn> -->
            <v-btn
              color="purple"
              v-if="typeJobSelected !== job.id"
              text
              @click="selectJobType(job.id)"
              >Выбрать</v-btn
            >
            <v-btn color="success" v-else text @click="selectJobType(job.id)"
              >Убрать</v-btn
            >
            <v-spacer></v-spacer>
            <v-btn icon @click="job.showDesc = !job.showDesc">
              <v-icon>{{
                job.showDesc ? 'mdi-chevron-up' : 'mdi-chevron-down'
              }}</v-icon>
            </v-btn>
          </v-card-actions>
          <v-expand-transition>
            <div v-show="job.showDesc">
              <v-divider></v-divider>
              <v-card-text
                v-text="job.shortDescRu"
                class="text-justify"
              ></v-card-text>
            </div>
          </v-expand-transition>
        </v-card>
      </v-col>
    </v-row>
    <v-row>
      <v-col class="px-12">
        <h3 class="white--text additional-services" v-if="language === 'en'">
          Additional requirements
        </h3>
        <h3 class="white--text additional-services" v-if="language === 'ru'">
          Дополнительные требования
        </h3>
      </v-col>
    </v-row>
    <v-row class="pa-12">
      <v-col
        cols="12"
        md="4"
        class="pa-5"
        v-for="job in typeAdditonalJobs"
        :key="job.id"
      >
        <v-card
          dark
          outlined
          class="main-bg"
          :class="job.selected ? 'elevation-10' : ''"
          v-if="language === 'en'"
        >
          <v-card-title style="word-break: normal">{{
            job.nameEn
          }}</v-card-title>
          <v-card-actions>
            <v-btn
              color="purple"
              v-if="!job.selected"
              text
              @click="job.selected = !job.selected"
              >Select</v-btn
            >
            <v-btn
              color="success"
              v-else
              text
              @click="job.selected = !job.selected"
              >Unselect</v-btn
            >
            <v-spacer></v-spacer>
            <v-btn icon @click="job.showDesc = !job.showDesc">
              <v-icon>{{
                job.showDesc ? 'mdi-chevron-up' : 'mdi-chevron-down'
              }}</v-icon>
            </v-btn>
          </v-card-actions>
          <v-expand-transition>
            <div v-show="job.showDesc">
              <v-divider></v-divider>
              <v-card-text
                v-text="job.shortDescEn"
                class="text-justify"
              ></v-card-text>
            </div>
          </v-expand-transition>
        </v-card>
        <v-card
          dark
          outlined
          class="main-bg"
          :class="job.selected ? 'elevation-10' : ''"
          v-if="language === 'ru'"
        >
          <v-card-title style="word-break: normal">{{
            job.nameRu
          }}</v-card-title>
          <!-- <v-card-text v-text="job.shortDescEn"></v-card-text> -->
          <v-card-actions>
            <!-- <v-btn text>Share</v-btn> -->
            <v-btn
              color="purple"
              v-if="!job.selected"
              text
              @click="job.selected = !job.selected"
              >Выбрать</v-btn
            >
            <v-btn
              color="success"
              v-else
              text
              @click="job.selected = !job.selected"
              >Убрать</v-btn
            >
            <v-spacer></v-spacer>
            <v-btn icon @click="job.showDesc = !job.showDesc">
              <v-icon>{{
                job.showDesc ? 'mdi-chevron-up' : 'mdi-chevron-down'
              }}</v-icon>
            </v-btn>
          </v-card-actions>
          <v-expand-transition>
            <div v-show="job.showDesc">
              <v-divider></v-divider>
              <v-card-text
                v-text="job.shortDescRu"
                class="text-justify"
              ></v-card-text>
            </div>
          </v-expand-transition>
        </v-card>
      </v-col>
    </v-row>
    <v-row>
      <v-col class="px-12">
        <h3 class="white--text additional-services" v-if="language === 'en'">
          Additional services
        </h3>
        <h3 class="white--text additional-services" v-if="language === 'ru'">
          Дополнительные услуги
        </h3>
      </v-col>
    </v-row>
    <v-row class="pa-12">
      <v-col
        cols="12"
        md="4"
        class="pa-5"
        v-for="job in typeAdditonalServices"
        :key="job.id"
      >
        <v-card
          dark
          outlined
          class="main-bg"
          :class="job.selected ? 'elevation-10' : ''"
          v-if="language === 'en'"
        >
          <v-card-title style="word-break: normal">{{
            job.nameEn
          }}</v-card-title>
          <v-card-actions>
            <v-btn
              color="purple"
              v-if="!job.selected"
              text
              @click="job.selected = !job.selected"
              >Select</v-btn
            >
            <v-btn
              color="success"
              v-else
              text
              @click="job.selected = !job.selected"
              >Unselect</v-btn
            >
            <v-spacer></v-spacer>
            <v-btn icon @click="job.showDesc = !job.showDesc">
              <v-icon>{{
                job.showDesc ? 'mdi-chevron-up' : 'mdi-chevron-down'
              }}</v-icon>
            </v-btn>
          </v-card-actions>
          <v-expand-transition>
            <div v-show="job.showDesc">
              <v-divider></v-divider>
              <v-card-text
                v-text="job.shortDescEn"
                class="text-justify"
              ></v-card-text>
            </div>
          </v-expand-transition>
        </v-card>
        <v-card
          dark
          outlined
          class="main-bg"
          :class="job.selected ? 'elevation-10' : ''"
          v-if="language === 'ru'"
        >
          <v-card-title style="word-break: normal">{{
            job.nameRu
          }}</v-card-title>
          <!-- <v-card-text v-text="job.shortDescEn"></v-card-text> -->
          <v-card-actions>
            <!-- <v-btn text>Share</v-btn> -->
            <v-btn
              color="purple"
              v-if="!job.selected"
              text
              @click="job.selected = !job.selected"
              >Выбрать</v-btn
            >
            <v-btn
              color="success"
              v-else
              text
              @click="job.selected = !job.selected"
              >Убрать</v-btn
            >
            <v-spacer></v-spacer>
            <v-btn icon @click="job.showDesc = !job.showDesc">
              <v-icon>{{
                job.showDesc ? 'mdi-chevron-up' : 'mdi-chevron-down'
              }}</v-icon>
            </v-btn>
          </v-card-actions>
          <v-expand-transition>
            <div v-show="job.showDesc">
              <v-divider></v-divider>
              <v-card-text
                v-text="job.shortDescRu"
                class="text-justify"
              ></v-card-text>
            </div>
          </v-expand-transition>
        </v-card>
      </v-col>
    </v-row>
    <v-row class="mb-12 pb-4">
      <v-col cols="12" class="text-center">
        <v-btn
          :disabled="status"
          x-large
          color="green darken-2"
          dark
          tile
          v-if="language === 'en'"
          @click="showCallDialog"
        >
          <v-icon class="mr-5">fab fa-telegram-plane</v-icon> Send Request
        </v-btn>
        <v-btn
          :disabled="status"
          x-large
          color="green darken-2"
          dark
          tile
          v-else
          @click="showCallDialog"
        >
          <v-icon class="mr-5">fab fa-telegram-plane</v-icon>Отправить запрос
        </v-btn>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import CallDialog from './Dialog/CallDialog'
const settings = {
  height: 'auto',
  maxWidth: 400,
  adaptive: true,
  transition: 'nice-modal-fade',
  clickToClose: true
}

export default {
  props: ['language'],
  data: () => ({
    typeJobSelected: null,
    typeJobs: [
      {
        id: 1,
        showDesc: false,
        nameRu: 'Лэндинг',
        nameEn: 'Langing Page',
        shortDescRu: `Разработаю по Вашему тех. заданию лэндинг, рекламирующий Ваши товары или услуги. 
        Лэндинг будет содержать несколько различных блоков: слайдеры, галлереи, простые текстовые блоки, блоки с эффектом Parallax.
        Если потребуется сложная анимация или дизайн, к проекту будет подключен дизайнер, который выполнит данную задачу.`,
        shortDescEn: `I will develop simple landing page, which will sale your products or services. 
        This landing will contain some different block like sliders, gallery, simple text blocks or blocks with Parallax effect.
        If you need especial design or animation on web site, task will delegate to designer, who will solve your task.`
      },
      {
        id: 2,
        showDesc: false,
        nameRu: 'Простой сайт (SPA)',
        nameEn: 'Simple Site (SPA)',
        shortDescRu:
          'Простой сайт по типу одностраничника (Single Page Application)',
        shortDescEn:
          'I will develop a simple site like Single Page Application.'
      },
      {
        id: 3,
        showDesc: false,
        nameRu: 'Доработка / Исправление ошибок',
        nameEn: 'Upgrade / Bugfix',
        shortDescRu: 'Доработка / исправление ошибок в Ваших ИТ проектах.',
        shortDescEn: 'I will upgrade or fix bugs of your digital solutions.'
      }
    ],
    typeAdditonalJobs: [
      {
        id: 1,
        showDesc: false,
        selected: false,
        nameRu: 'Подключить Google Analytics',
        nameEn: 'Connect Google Analytics',
        shortDescRu: `Google Analytics — бесплатный сервис, предоставляемый Google для создания детальной статистики посетителей веб-сайтов. 
        Статистика собирается на сервере Google, пользователь только размещает JS-код на страницах своего сайта. 
        Код отслеживания срабатывает, когда пользователь открывает страницу в своем веб-браузере.`,
        shortDescEn: `Google analytics is used to track the website activity of the users such as session duration,
        pages per session, bounce rate etc. along with the information on the source of the traffic.`
      },
      {
        id: 2,
        showDesc: false,
        selected: false,
        nameRu: 'Отправка уведомлений на E-mail',
        nameEn: 'Make E-mail notification',
        shortDescRu:
          'Отправка E-mail уведомлений с Вашего сайта. Например через кнопку "Заказать обратный звонок", "Купить продукт", "Оставить отзыв"',
        shortDescEn:
          'Send e-mail notifications from your website. For example throw button "Make order", "Call me", "Send feedback"'
      },
      {
        id: 3,
        showDesc: false,
        selected: false,
        nameRu:
          'Привязать оплату через Yandex кошелек (или другой платежный сервис)',
        nameEn: 'Bind payment via Yandex wallet (or other payment service)',
        shortDescRu: `Подключение на Вашем сайте платежного шлюза для обработки платеже клиентов. 
        Большинство платежных систем работают только с ИП, исключения Яндекс.Кошелек и возможно другие.`,
        shortDescEn: `I will help you to connect payment getway for your website. 
        Majority payment services work only with individual entrepreneurs, but some like Yandex.Wallet also works with ordinary people.`
      },
      {
        id: 4,
        showDesc: false,
        selected: false,
        nameRu: 'Авторизация на сайте (например JSON Web Token)',
        nameEn: 'JSON Web Token Authorization',
        shortDescRu:
          'Помогу реализовать слой авторизации для вашего приложения. Большинство современных приложений используют Json Web Token авторизацию.',
        shortDescEn:
          'I will develop authorization layer for your application. Majority apps use Json Web Token Authorization'
      },
      {
        id: 5,
        showDesc: false,
        selected: false,
        nameRu: 'Персональный дизайн',
        nameEn: 'Especial design',
        shortDescRu:
          'Если Вам требуется создать персональный и сложный дизайн, а затем сверстать макеты из PSD файлов, будет привлечен дизайнер, который поможет решить любую Вашу задачу.',
        shortDescEn:
          'If you need to create especial and difficult design, I will delegate this task to designer, which can resolve any your tasks.'
      },
      {
        id: 6,
        showDesc: false,
        selected: false,
        nameRu: 'Управление контентом на сайте',
        nameEn: 'Manage your website',
        shortDescRu: `Если Вам нужно управлять некоторыми блоками вашего сайта (новости, статьи, пользователи, отзывы).
        Я помогу реализовать функционал позволяющий это сделать. Но Вы должны понимать, что это увеличит стоимость и временные затраты вдвое.`,
        shortDescEn: `If you need to manage some blocks in your website, they call it CRM, 
        I can implement any part and than you could manage your news, products, 
        feedbacks or others part of your website. 
        But you should understand it will increase price of developing and time almost double.`
      },
      {
        id: 7,
        showDesc: false,
        selected: false,
        nameRu: 'Верстка макетов по PSD файлам',
        nameEn: 'Create templates from scratch (Vue + HTML + CSS).',
        shortDescRu: `Помогу сверстать пользовательскую часть по вашим макетам из PSD файлов. По итогу вы получите работающий прототип вашего Web-приложения с заглушками.`,
        shortDescEn: `I will help to develop frontend part of your web application if you provide me PSD files. As a result you'll get completly work application with stubs.`
      }
    ],
    typeAdditonalServices: [
      {
        id: 1,
        showDesc: false,
        selected: false,
        nameRu: 'Регистрация / настрйока домена',
        nameEn: 'Domain registration / configuration',
        shortDescRu: `Регистрация, перенос, настройка новых доменов, настройка делегирования`,
        shortDescEn: `Domain registraion, move to another hosting, configure delegation`
      },
      {
        id: 2,
        showDesc: false,
        selected: false,
        nameRu: 'Регистрация / настрйока хостинга',
        nameEn: 'Hosting configuration',
        shortDescRu:
          'Регистрация и настройка Shared-хостинга для вашего проекта.',
        shortDescEn: 'Configure shared-hosting for publish your project'
      },
      {
        id: 3,
        showDesc: false,
        selected: false,
        nameRu: 'Просто запрос перезвонить',
        nameEn: 'Just request for calling / writing',
        shortDescRu: 'Просто оставьте заявку и я перезвоню / напишу Вам.',
        shortDescEn: "Just leave request and I'll call / write you"
      }
    ]
  }),
  methods: {
    selectJobType(id) {
      this.typeJobSelected === id
        ? (this.typeJobSelected = null)
        : (this.typeJobSelected = id)
    },
    showCallDialog(e) {
      e.preventDefault()
      let result = ''
      if (this.typeJobSelected !== null) {
        let findJob1 = this.typeJobs.find(x => x.id === this.typeJobSelected)
        if (
          findJob1 !== null &&
          findJob1 !== undefined &&
          findJob1 !== 'undefined'
        ) {
          result = 'Тип сайта: ' + findJob1.nameRu + '<br><br>'
        }
      }
      let job2 = this.typeAdditonalJobs.filter(x => x.selected)
      if (job2.length > 0) {
        result += 'Доп. требования: <br>'
        job2.forEach(x => {
          result += x.nameRu + '<br>'
        })
      }
      let job3 = this.typeAdditonalServices.filter(x => x.selected)
      if (job3.length > 0) {
        result += '<br>Доп. услуги: <br>'
        job3.forEach(x => {
          result += x.nameRu + '<br>'
        })
      }
      this.$modal.show(
        CallDialog,
        { language: this.language, result: result },
        settings
      )
    }
  },
  computed: {
    status() {
      let findJob1 = this.typeAdditonalJobs.filter(x => x.selected === true)
        .length
      let findJob2 = this.typeAdditonalServices.filter(x => x.selected === true)
        .length
      return this.typeJobSelected === null && findJob1 === 0 && findJob2 === 0
    }
  }
}
</script>

<style></style>
