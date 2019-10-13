<template>
  <v-container fluid fill-height class="main-bg pt-10" style="overflow-x: hidden">
    <v-row class="pt-12">
      <v-col cols="12" md="6" class="hidden-sm-and-down">
        <section class="d-flex flex-column justify-center vh100" align="center" justify="center" v-if="language === 'en'">
          <h1 class="f1">Z<span class="white--text">AMIR</span></h1>
          <h1 class="f1"><span class="white--text">YUSUPOV</span>.</h1>
          <h5 class="f2">FULLSTACK WEB PROGRAMMER</h5>
          <h5 class="f2" style="color: #00D646">C# / PHP / JavaScript</h5>
          <h5 class="f2 mb-10">AND SOFTWARE DEVELOPER</h5>
        </section>
        <section class="d-flex flex-column justify-center vh100" align="center" justify="center" v-if="language === 'ru'">
          <h1 class="f1">З<span class="white--text">АМИР</span></h1>
          <h1 class="f1"><span class="white--text">ЮСУПОВ</span>.</h1>
          <h5 class="f2">FULLSTACK ВЕБ-ПРОГРАММИСТ</h5>
          <h5 class="f2" style="color: #00D646">C# / PHP / JavaScript</h5>
          <h5 class="f2 mb-10">И РАЗРАБОТЧИК ПО</h5>
        </section>
      </v-col>
      <v-col cols="12" md="6" class="skewed hidden-sm-and-down">
        <!-- <div class="skewed"></div> -->
      </v-col>
      <v-col cols="12" md="6" class="hidden-md-and-up pa-0">
        <section class="skewed-responsive d-flex flex-column justify-center" style="background-position-x: center"  align="center" justify="center" v-if="language === 'en'">
          <h1 class="f1">Z<span class="white--text">AMIR</span></h1>
          <h1 class="f1"><span class="white--text">YUSUPOV</span>.</h1>
          <h5 class="f2">FULLSTACK WEB PROGRAMMER</h5>
          <h5 class="f2" style="color: #00D646">C# / PHP / JavaScript</h5>
          <h5 class="f2 mb-10">AND SOFTWARE DEVELOPER</h5>
        </section>
        <section class="skewed-responsive d-flex flex-column justify-center" style="background-position-x: center" align="center" justify="center" v-if="language === 'ru'">
          <h1 class="f1">З<span class="white--text">АМИР</span></h1>
          <h1 class="f1"><span class="white--text">ЮСУПОВ</span>.</h1>
          <h5 class="f2">FULLSTACK ВЕБ-ПРОГРАММИСТ</h5>
          <h5 class="f2" style="color: #00D646">C# / PHP / JavaScript</h5>
          <h5 class="f2 mb-10">И РАЗРАБОТЧИК ПО</h5>
        </section>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  props: ['language']
}
</script>

<style>

</style>
