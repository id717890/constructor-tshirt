<template>
  <v-form lazy-validation v-model="form.valid" ref="form">
    <v-container fluid v-if="slide">
      <v-row>
        <v-col cols="12">
          <h1>Редактирование изображения слайдера</h1>
        </v-col>
      </v-row>
      <v-row>
        <v-col lg="6" md="8" sm="12" cols="12">
          <v-radio-group @change="changeType" v-model="form.type">
            <v-radio label="Слайд" value="image"></v-radio>
            <v-radio label="Видео (YouTube)" value="iframe"></v-radio>
          </v-radio-group>
          <v-text-field
            v-show="form.type === 'image'"
            label="Ссылка"
            v-model="form.url"
          ></v-text-field>
        </v-col>
      </v-row>
      <v-row v-if="form.type === 'image'">
        <v-col lg="6" md="8" sm="12" cols="12">
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
      <v-row v-else>
        <v-col lg="6" md="8" sm="12" cols="12">
          <v-textarea
            outlined
            label="Код встраиваемого видео"
            v-model="form.iframe"
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
import { mapActions, mapState, mapGetters } from 'vuex'
import config from '../../init/config'
import imageMixin from '../../mixins/image'

export default {
  props: ['id'],
  mixins: [loading, imageMixin],
  data: () => ({
    form: {
      valid: true,
      url: '',
      image: '',
      type: '',
      iframe: null
    }
  }),
  async created() {
    await this.getAllHomeSlides()
  },
  watch: {
    slide(value) {
      if (value) {
        this.form.url = value.url
        this.form.image = value.image
        this.form.type = value.type
        this.form.iframe = value.iframe
      }
    }
  },
  computed: {
    ...mapGetters(['getHomeSlideById']),
    slide() {
      return this.getHomeSlideById(this.id)
    }
  },
  methods: {
    ...mapActions(['updateHomeSlide', 'getAllHomeSlides', 'uploadImage']),
    changeType(e) {
      this.form.image = ''
      this.form.iframe = null
    },
    upload(event) {
      const file = event.target.files[0]
      let fd = new FormData()
      fd.append('image', file)
      fd.append('prefix', 'home-slide-')
      this.uploadImage(fd).then(x => {
        this.form.image = x.fullname
      })
    },
    save() {
      this.setLoad(true)
      if (
        (this.form.type === 'iframe' && this.form.iframe) ||
        (this.form.type === 'image' && this.form.image)
      ) {
        this.updateHomeSlide({
          ...this.form,
          id: this.id
        })
      } else this.setLoad(false)
    }
  }
}
</script>
