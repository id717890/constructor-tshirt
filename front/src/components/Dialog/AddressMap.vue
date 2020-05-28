<template>
  <v-card class="v-application h100">
    <div class="w100 d-flex flex-column  h100">
      <v-card-title class="px-8">
        <v-spacer></v-spacer>
        <v-btn outlined fab color="primary" @click="$emit('close')">
          <v-icon>mdi-close</v-icon>
        </v-btn>
      </v-card-title>
      <v-card-text class="flex-grow-1 d-flex">
        MAP
      </v-card-text>
      <v-card-actions class="px-8">
        <v-spacer></v-spacer>
        <v-btn outlined fab color="primary" @click="$emit('close')">
          <v-icon>mdi-close</v-icon>
        </v-btn>
      </v-card-actions>
    </div>
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
      phone: ''
    },
    textField: [v => !!v || 'Обязательное поле']
  }),
  methods: {
    sendForm() {
      if (this.$refs.form.validate()) {
        this.loading = true
        context
          .post('api/callback/callme', this.form)
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
