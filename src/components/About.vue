<template>
  <v-container class="main-bg">
    <v-row align="stretch">
      <v-col cols="12" md="6" class="pa-12">
        <v-img class="about-photo" style="margin: auto" :src="require('../../public/img/ab-img.png')"></v-img>
      </v-col>
      <v-col cols="12" md="6" class="white--text pa-12">
        <section class="d-flex flex-column justify-center h100">
          <h2 v-if="language === 'en'">About Me</h2>
          <p v-if="language === 'en'">Hello, I’m Zamir, web-programmer and software developer based on Uray. I have rich experience in web site programming & building and customization them. Also I am good at</p>
          <h2 v-if="language === 'ru'">Обо мне</h2>
          <p v-if="language === 'ru'">Привет, моё имя Замир, я веб-программист и разработчик ПО. У меня богатый опыт в программировании/доработке практически любых веб-сайтов, веб-сервисов. Так же я хорошо знаком со следующими технологиями:</p>
          <p>
            <v-chip color="red accent-4" outlined class="ma-2">ASP.NET MVC</v-chip>
            <v-chip color="success" outlined class="ma-2">.NET Core</v-chip>
            <v-chip color="yellow" outlined class="ma-2">ASP.NET Web Api</v-chip>
            <v-chip color="purple" outlined class="ma-2">Laravel Framework</v-chip>
            <v-chip color="pink" outlined class="ma-2">Lumen Framework</v-chip>
            <v-chip color="green darken-3" outlined class="ma-2">Vue</v-chip>
            <v-chip color="primary" outlined class="ma-2">Vuex</v-chip>
            <v-chip color="indigo" outlined class="ma-2">ORM Entity Framework</v-chip>
            <v-chip color="cyan" outlined class="ma-2">ORM NHibernate</v-chip>
            <v-chip color="success" outlined class="ma-2">ORM Eloquent</v-chip>
            <v-chip color="error" outlined class="ma-2">DB MS SQL</v-chip>
            <v-chip color="lime" outlined class="ma-2">DB MySQL</v-chip>
            <v-chip color="orange" outlined class="ma-2">DB Oracle</v-chip>
            <v-chip color="success" outlined class="ma-2">T-SQL, PL/SQL</v-chip>
            <v-chip color="warning" outlined class="ma-2">GIT</v-chip>
            <v-chip color="amber" outlined class="ma-2">SVN Tortoise</v-chip>
            <v-chip color="deep-orange" outlined class="ma-2">CSS</v-chip>
            <v-chip color="teal" outlined class="ma-2">HTML</v-chip>
          </p>
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
