<template>
  <v-container :scroll="handleScroll">
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
                :value="tweenCommunication.toFixed(0)"
                color="green"
                size="130"
                width="20"
                ><span
                  >{{ tweenCommunication.toFixed(0) }}%</span
                ></v-progress-circular
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
                :value="tweenTeamWork.toFixed(0)"
                color="teal"
                size="130"
                width="20"
                ><span
                  >{{ tweenTeamWork.toFixed(0) }}%</span
                ></v-progress-circular
              >
              <h3 class="white--text" v-if="language === 'en'">Team Work</h3>
              <h3 class="white--text" v-if="language === 'ru'">
                Работа в команде
              </h3>
            </v-col>
            <v-col cols="12" md="6" class="text-center">
              <v-progress-circular
                :value="tweenSelfStuding.toFixed(0)"
                color="yellow"
                size="130"
                width="20"
                ><span
                  >{{ tweenSelfStuding.toFixed(0) }}%</span
                ></v-progress-circular
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
                :value="tweenCreativity.toFixed(0)"
                color="red"
                size="130"
                width="20"
                ><span
                  >{{ tweenCreativity.toFixed(0) }}%</span
                ></v-progress-circular
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
import gsap from 'gsap'
export default {
  props: ['language'],
  data: () => ({
    net: 0,
    php: 0,
    js: 0,
    css: 0,
    core: 0,
    aspnet: 0,
    communication: 0,
    tweenCommunication: 0,
    teamWork: 0,
    tweenTeamWork: 0,
    selfStuding: 0,
    tweenSelfStuding: 0,
    creativity: 0,
    tweenCreativity: 0
  }),
  methods: {
    handleScroll() {
      if (window.scrollY >= 1020) {
        this.communication = 81
        this.teamWork = 89

        this.net = 87
        this.php = 67
        this.js = 71
        this.css = 75
        this.core = 66
        this.aspnet = 73
      }
      if (window.scrollY >= 1050) {
        this.selfStuding = 96
        this.creativity = 60
      }
    }
  },
  created() {
    window.addEventListener('scroll', this.handleScroll)
  },
  destroyed() {
    window.removeEventListener('scroll', this.handleScroll)
  },
  watch: {
    selfStuding(value) {
      gsap.to(this.$data, {
        duration: 0.4,
        delay: 0.5,
        ease: 'circ.out',
        tweenSelfStuding: value
      })
    },
    creativity(value) {
      gsap.to(this.$data, {
        duration: 0.6,
        delay: 0.4,
        ease: 'circ.out',
        tweenCreativity: value
      })
    },
    teamWork(value) {
      gsap.to(this.$data, {
        duration: 1.5,
        delay: 0.8,
        ease: 'circ.out',
        tweenTeamWork: value
      })
    },
    communication(value) {
      gsap.to(this.$data, {
        duration: 0,
        ease: 'circ.out',
        tweenCommunication: value
      })
    }
  }
}
</script>

<style></style>
