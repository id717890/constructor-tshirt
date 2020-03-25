<template>
  <v-container>
    <v-row>
      <v-col cols="12" md="6" class="pa-12">
        <h1
          class="display-1 white--text font-weight-bold text-center"
          v-if="language === 'en'"
        >
          Hard Skills
        </h1>
        <h1
          class="display-1 white--text font-weight-bold text-center"
          v-if="language === 'ru'"
        >
          Технические навыки
        </h1>
        <div class="d-flex flex-row white--text">
          <span class="title">C#</span>
          <div class="flex-grow-1"></div>
          <span>{{ Math.ceil(net) }}%</span>
        </div>
        <v-progress-linear
          class="mb-5"
          color="purple"
          v-model="net"
          height="7"
          reactive
        ></v-progress-linear>

        <div class=" d-flex flex-row white--text">
          <span class="title">ASP.NET MVC</span>
          <div class="flex-grow-1"></div>
          <span>{{ Math.ceil(aspnet) }}%</span>
        </div>
        <v-progress-linear
          class="mb-5"
          color="cyan"
          v-model="aspnet"
          height="7"
          reactive
        ></v-progress-linear>

        <div class="d-flex flex-row white--text">
          <span class="title">.Net Core</span>
          <div class="flex-grow-1"></div>
          <span>{{ Math.ceil(core) }}%</span>
        </div>
        <v-progress-linear
          class="mb-5"
          color="red"
          v-model="core"
          height="7"
          reactive
        ></v-progress-linear>

        <div class="d-flex flex-row white--text">
          <span class="title">PHP</span>
          <div class="flex-grow-1"></div>
          <span>{{ Math.ceil(php) }}%</span>
        </div>
        <v-progress-linear
          class="mb-5"
          color="green"
          v-model="php"
          height="7"
          reactive
        ></v-progress-linear>

        <div class="d-flex flex-row white--text">
          <span class="title">JavaScript</span>
          <div class="flex-grow-1"></div>
          <span>{{ Math.ceil(js) }}%</span>
        </div>
        <v-progress-linear
          class="mb-5"
          color="yellow"
          v-model="js"
          height="7"
          reactive
        ></v-progress-linear>

        <div class="d-flex flex-row white--text">
          <span class="title">CSS / Flex / HTML</span>
          <div class="flex-grow-1"></div>
          <span>{{ Math.ceil(css) }}%</span>
        </div>
        <v-progress-linear
          class="mb-5"
          color="orange"
          v-model="css"
          height="7"
          reactive
        ></v-progress-linear>
      </v-col>
      <v-col cols="12" md="6" class="pa-12">
        <h1
          class="display-1 white--text font-weight-bold text-center"
          v-if="language === 'en'"
        >
          Soft Skills
        </h1>
        <h1
          class="display-1 white--text font-weight-bold text-center"
          v-if="language === 'ru'"
        >
          Прочие характеристики
        </h1>
        <v-container fluid>
          <v-row>
            <v-col cols="12" md="6" class="text-center">
              <v-progress-circular
                :value="communication"
                color="green"
                size="130"
                width="20"
                ><span>{{ communication }}%</span></v-progress-circular
              >
              <h3 class="white--text" v-if="language === 'en'">
                Communication
              </h3>
              <h3 class="white--text" v-if="language === 'ru'">
                Коммуникабельность
              </h3>
            </v-col>
            <v-col cols="12" md="6" class="text-center">
              <v-progress-circular
                :value="teamWork"
                color="teal"
                size="130"
                width="20"
                ><span>{{ teamWork }}%</span></v-progress-circular
              >
              <h3 class="white--text" v-if="language === 'en'">Team Work</h3>
              <h3 class="white--text" v-if="language === 'ru'">
                Работа в команде
              </h3>
            </v-col>
            <v-col cols="12" md="6" class="text-center">
              <v-progress-circular
                :value="selfStuding"
                color="yellow"
                size="130"
                width="20"
                ><span>{{ selfStuding }}%</span></v-progress-circular
              >
              <h3 class="white--text" v-if="language === 'en'">
                Ambitions <br />to self-studing
              </h3>
              <h3 class="white--text" v-if="language === 'ru'">
                Стремление к самосовершенствованию
              </h3>
            </v-col>
            <v-col cols="12" md="6" class="text-center">
              <v-progress-circular
                :value="creativity"
                color="red"
                size="130"
                width="20"
                ><span>{{ creativity }}%</span></v-progress-circular
              >
              <h3 class="white--text" v-if="language === 'en'">Creativity</h3>
              <h3 class="white--text" v-if="language === 'ru'">Креативность</h3>
            </v-col>
          </v-row>
        </v-container>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  props: ['language'],
  data: () => ({
    net: 86,
    php: 66,
    js: 71,
    css: 75,
    core: 66,
    aspnet: 73,
    communication: 81,
    teamWork: 88,
    selfStuding: 93,
    creativity: 54
  })
}
</script>

<style></style>
