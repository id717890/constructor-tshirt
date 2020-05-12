<template>
  <v-card class="v-application">
    <v-form lazy-validation v-model="form.valid" ref="form">
      <v-card-title>
        <v-row>
          <v-col cols="12" class="pb-0">
            <v-text-field
              label="Ваше имя"
              required
              outlined
              :rules="textField"
              v-model="form.name"
            ></v-text-field>
            <v-text-field
              label="Телефон"
              required
              outlined
              :rules="textField"
              v-model="form.phone"
            ></v-text-field>
            <v-textarea
              required
              outlined
              :rules="textField"
              v-model="form.text"
            ></v-textarea>
          </v-col>
        </v-row>
      </v-card-title>
      <v-card-actions class="pb-6 px-6 pt-0">
        <v-spacer></v-spacer>
        <v-btn
          @click="sendForm"
          :disabled="!form.valid"
          :loading="loading"
          large
          color="success"
          class="px-10 w100"
        >
          <v-icon class="mr-6">mdi-send</v-icon>
          Отправить заявку
        </v-btn>
      </v-card-actions>
    </v-form>
  </v-card>
</template>

<script>
import context from '../../api/api'
export default {
  data: () => ({
    loading: false,
    form: {
      valid: true,
      name: '',
      phone: '',
      text: ''
    },
    textField: [v => !!v || 'Обязательное поле']
  }),
  methods: {
    sendForm() {
      if (this.$refs.form.validate()) {
        this.loading = true
        context
          .post('api/callback/design', this.form)
          .then(x => {
            this.loading = false
            this.$refs.form.reset()
            this.$emit('close')
          })
          .catch(x => {
            console.log(x)
            this.loading = false
          })
      }
    }
  }
}
</script>
