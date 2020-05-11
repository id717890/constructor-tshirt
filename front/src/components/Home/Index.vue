<template>
  <v-row>
    <v-col cols="12">
      <h2>
        Настройка главой страницы
      </h2>
    </v-col>
    <v-col cols="12">
      <home-slider />
    </v-col>
  </v-row>
</template>

<script>
import HomeSlider from './HomeSlider'
export default {
  components: {
    HomeSlider
  }
}
</script>
