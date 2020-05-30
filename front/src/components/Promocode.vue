<template>
  <div class="d-flex">
    <v-btn
      v-if="!promocode"
      :loading="loading"
      large
      color="purple darken-2"
      dark
      class="mr-3 px-12"
      @click="checkCode"
    >
      <v-icon>mdi-check</v-icon>
      Применить
    </v-btn>
    <v-text-field
      v-if="!promocode"
      small
      outlined
      label="Введите промокод"
      v-model="code"
      @input="inputCode($event)"
      class="promocode"
    >
    </v-text-field>
    <v-alert
      class="ma-0 pa-0 w100 text-center title pt-1"
      dark
      height="44"
      color="purple"
      v-if="promocode"
    >
      Активирован ПРОМОКОД на скидку {{ promocode.discount }}%
    </v-alert>
  </div>
</template>

<script>
import context from '../api/api'
export default {
  data: () => ({
    loading: false,
    code: '',
    promocode: null
  }),
  methods: {
    inputCode(value) {
      this.code = value.toUpperCase()
    },
    checkCode() {
      if (this.code) {
        this.loading = true
        context
          .post('api/promocodes/check', { code: this.code })
          .then(x => {
            this.loading = false
            if (x.success && x.success === true) {
              const result = x.data
              this.$noty.success(
                'Активирован промокод на скидку ' + result.discount + '%'
              )
              this.promocode = result
              this.code = ''
              this.$emit('setPromocode', this.promocode)
            } else {
              this.$noty.error('Промокод не найден!')
            }
          })
          .catch(x => {
            this.$noty.error('Ошибка проверки промокода')
            this.loading = false
            console.log(x)
          })
      }
    }
  }
}
</script>

<style></style>
