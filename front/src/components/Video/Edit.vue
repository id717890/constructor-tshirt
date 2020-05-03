<template>
  <v-form lazy-validation v-model="form.valid" ref="form">
    <v-container fluid>
      <v-row>
        <v-col cols="12">
          <h1>Редактирование видео</h1>
        </v-col>
      </v-row>
      <v-row>
        <v-col lg="6" md="8" sm="12" cols="12">
          <v-text-field
            label="Заголовок"
            v-model="form.title"
            required
            :rules="textField"
          ></v-text-field>
        </v-col>
      </v-row>
      <v-row>
        <v-col lg="6" md="8" sm="12" cols="12">
          <v-textarea
            solo
            name="input-7-4"
            label="Код видео"
            v-model="form.text"
          ></v-textarea>
        </v-col>
      </v-row>
      <v-row>
        <v-col lg="6" md="8" sm="12" cols="12" class="d-flex">
          <v-btn
            color="primary"
            large
            :loading="loading"
            @click.prevent="save"
            :disabled="!form.valid"
          >
            <v-icon class="mr-2">mdi-content-save</v-icon>
            Сохранить
          </v-btn>
          <v-spacer></v-spacer>
          <v-btn color="secondary" large to="/lk/videos">
            <v-icon class="mr-2">mdi-arrow-left</v-icon>
            Отмена
          </v-btn>
        </v-col>
      </v-row>
    </v-container>
  </v-form>
</template>

<script>
import loading from '../../mixins/loading'
import { mapActions, mapGetters } from 'vuex'

export default {
  mixins: [loading],
  props: ['id'],
  data: () => ({
    textField: [v => !!v || 'Обязательное поле'],
    form: {
      valid: true,
      title: '',
      text: ''
    }
  }),
  async created() {
    await this.getAllVideos()
    this.setLoad(false)
  },
  watch: {
    video(value) {
      if (value) {
        this.form.title = value.title
        this.form.text = value.text
      }
    }
  },
  mounted() {
    if (this.video) {
      this.form.title = this.video.title
      this.form.text = this.video.text
    }
  },
  computed: {
    ...mapGetters(['getVideoById']),
    video() {
      return this.getVideoById(this.id)
    }
  },
  methods: {
    ...mapActions(['updateVideo', 'getAllVideos']),
    save() {
      this.setLoad(true)
      if (this.$refs.form.validate()) {
        this.updateVideo({
          id: this.id,
          ...this.form
        })
      } else this.setLoad(false)
    }
  }
}
</script>
