<template>
  <v-container>
    <v-row no-gutters>
      <v-col sm="12" cols="12" v-if="form">
        <v-form lazy-validation v-model="valid" ref="form">
          <v-container>
            <v-row>
              <v-col class="text-center">
                <i class="fa fa-phone-square primary--text fa-3x"></i>
                <h3>Заказать обратный звонок.</h3>
              </v-col>
            </v-row>
            <v-row>
              <v-col sm="12" cols="12">
                <v-text-field v-model="name" label="Имя" required></v-text-field>
              </v-col>
              <v-col sm="12" cols="12">
                <v-text-field v-model="phone" :rules="textField"  label="Телефон" required></v-text-field>
              </v-col>
              <v-col sm="12" class="text-center" cols="12">
                <v-btn :loading="loading" x-large tile dark  color="primary" @click="submit" class="w100">
                  <i class="fa fa-check fa-2x"></i>
                  ОК
                </v-btn>
              </v-col>
            </v-row>
          </v-container>
        </v-form>
      </v-col>
      <v-col sm="12" cols="12" v-if="success">
        <v-alert type="success" class="mt-3">Ваш запрос успешно отправлен!</v-alert>
      </v-col>
      <v-col sm="12" cols="12" v-if="error">
        <v-alert type="error" class="mt-3">Возникла ошибка! Попробуйте повторить попытку.</v-alert>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { mapActions } from 'vuex'
import Alert from './Alert'
const settings = {
  height: 'auto',
  maxWidth: 400,
  adaptive: true,
  transition: 'nice-modal-fade',
  clickToClose: true
}
export default {
  data: () => ({
    form: true,
    success: false,
    error: false,
    loading: false,
    valid: false,
    name: null,
    phone: null,
    textField: [
      v => !!v || 'Поле обязательно для заполнения'
    ]
  }),
  methods: {
    ...mapActions(['createCallback']),
    reset () {
      this.form = true
      this.success = false
      this.error = false
    },
    submit (e) {
      e.preventDefault()
      this.loading = true
      if (this.$refs.form.validate()) {
        this.createCallback({ is_coupon: false, name: this.name, phone: this.phone })
          .then(() => {
            this.loading = false
            this.form = false
            this.$emit('close')
            this.$modal.show(Alert, { type: 'success', message: 'Запрос успешно отправлен!', message2: 'Если Вы правильно указали свой телефон, мы свяжемся с Вами в ближайшее время.' }, settings)
            this.$refs.form.reset()
          })
          .catch(x => {
            this.loading = false
            this.$modal.show(Alert, { type: 'error', message: 'Ошибка при отправке запроса!', message2: x }, settings)
            this.$refs.form.reset()
          })
      } else this.loading = false
    }
  }
}
</script>
