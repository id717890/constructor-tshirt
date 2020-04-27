<template>
  <v-app id="app" dark style="background: white">
    <v-container fluid>
      <modals-container />
      <v-row no-gutters>
        <v-col md="8" offset-md="2" sm="12" cols="12">
          <v-row>
            <v-col cols="2">1</v-col>
            <v-col cols="4">
              <div class="t2">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea
                doloremque facilis quasi molestias veniam cupiditate sit a
                excepturi? Ex, tempore saepe. Dolorem, impedit ratione? Ut in
                modi minus perspiciatis nulla?
              </div>
            </v-col>
            <v-col cols="6" class="d-flex flex-row flex-nowrap">
              <v-btn class="btn-social">vk</v-btn>
              <v-btn class="btn-social">f</v-btn>
              <v-btn class="btn-social">t</v-btn>
              <v-btn class="pdf-catalog">
                <v-icon>mdi-download</v-icon>
                Скачать каталог в PDF
              </v-btn>
              <v-btn class="btn-social" color="warning" outlined
                >Оставить заявку</v-btn
              >
            </v-col>
          </v-row>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12" class="menu pa-0">
          <router-link
            :to="item.url"
            v-for="(item, index) in menu"
            :key="index"
            class="d-flex flex-column item"
          >
            <v-icon dark>{{ item.icon }}</v-icon>
            <span class="text-center">{{ item.title }}</span>
          </router-link>
        </v-col>
      </v-row>
      <router-view name="guest"></router-view>
    </v-container>
  </v-app>
</template>

<script>
export default {
  data: () => ({
    menu: [
      { icon: 'mdi-home', title: 'Главная', url: '/' },
      { icon: 'mdi-information', title: 'О компании', url: '/about' },
      { icon: 'mdi-image-multiple', title: 'Фотогалерея', url: '/photos' },
      { icon: 'mdi-video', title: 'Видеогалерея', url: '/videos' },
      {
        icon: 'mdi-message-outline',
        title: 'Отзывы и пожелания',
        url: '/feedbacks'
      },
      { icon: 'mdi-help-circle', title: 'Вопрос-ответ', url: '/faq' }
    ]
  })
}
</script>

<style></style>
