<template>
  <v-form lazy-validation v-model="form.valid" ref="form">
    <v-container fluid>
      <v-row>
        <v-col cols="12">
          <h1>Новый партнер для слайдера</h1>
        </v-col>
      </v-row>
      <v-row>
        <v-col lg="6" md="8" sm="12" cols="12">
          <v-text-field label="URL" v-model="form.url"></v-text-field>
          <v-btn @click="$refs.file.click()" dark class="mb-5 w100">
            <v-icon>mdi-image</v-icon>
            Загрузить изображение</v-btn
          >
          <input
            style="display: none"
            ref="file"
            type="file"
            @change="upload"
          />
          <div v-if="form.image">
            <img
              :src="img(form.image)"
              style="width: 100%; border-radius: 5px"
            />
          </div>
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
          <v-btn color="secondary" large to="/lk/home">
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
import { mapActions } from 'vuex'
import config from '../../init/config'
import imageMixin from '../../mixins/image'

export default {
  mixins: [loading, imageMixin],
  data: () => ({
    form: {
      valid: true,
      image: '',
      url: ''
    }
  }),
  methods: {
    ...mapActions(['createPartner', 'uploadImage']),
    upload(event) {
      const file = event.target.files[0]
      let fd = new FormData()
      fd.append('image', file)
      fd.append('prefix', 'home-partner-')
      this.uploadImage(fd).then(x => {
        this.form.image = x.fullname
      })
    },
    save() {
      this.setLoad(true)
      if (this.$refs.form.validate()) {
        this.createPartner(this.form)
      } else this.setLoad(false)
    }
  }
}
</script>
