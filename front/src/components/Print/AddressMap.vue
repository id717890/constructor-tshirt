<template>
  <v-container fluid>
    <v-row class="v-application">
      <v-col cols="12" lg="6" offset-lg="3" md="8" offset-md="2">
        <v-row>
          <v-col cols="12">
            <iframe
              src="https://yandex.ru/map-widget/v1/?um=constructor%3A65622dca02b6643717de04c5237e3fec1ef211101f2ffbfb43a92ed2ff579f36&amp;source=constructor"
              width="100%"
              height="400"
              frameborder="0"
            >
            </iframe>
            <!-- <img class="w100" src="~@/assets/img/joma-map.webp" alt="" /> -->
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" class="">
            <div class="d-flex justify-center mb-6 display-1">
              <v-icon x-large>mdi-map-marker</v-icon>
              г.Москва, ул.Краснобогатырская 89, стр.5
            </div>
            <div class="d-flex justify-center mb-6 display-1">
              <v-icon x-large>mdi-cellphone</v-icon>
              +7 (967) 21-92-444 (Москва)
            </div>
            <div class="d-flex justify-center display-1">
              <v-icon x-large>mdi-email</v-icon>
              info@joma-club.ru
            </div>
            <v-btn @click="print" class="w100 mt-12" tile large text outlined>
              <v-icon>mdi-printer</v-icon>
              Печать
            </v-btn>
          </v-col>
        </v-row>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  methods: {
    print() {
      window.print()
    }
  }
}
</script>
