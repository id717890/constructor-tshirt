<template>
  <v-form lazy-validation v-model="form.valid" ref="form">
    <v-container fluid>
      <v-row>
        <v-col cols="12">
          <h1>Редактирование фото из галереи</h1>
        </v-col>
      </v-row>
      <v-row>
        <v-col lg="5" md="6" sm="12" cols="12">
          <v-text-field
            label="Заголовок"
            v-model="form.title"
            required
            :rules="textField"
          ></v-text-field>
        </v-col>
      </v-row>
      <v-row>
        <v-col lg="5" md="6" sm="12" cols="12" class="pl-6">
          <v-btn @click="$refs.file.click()" dark class="mb-5">
            <v-icon>mdi-image</v-icon>
            Загрузить изображение</v-btn
          >
          <input
            style="display: none"
            ref="file"
            type="file"
            @change="upload"
            multiple
            enctype="multipart/form-data"
          />
          <div v-if="form.image">
            <img
              :src="img(form.image)"
              alt=""
              style="max-height: 300px; border-radius: 10px"
            />
          </div>
        </v-col>
      </v-row>
      <v-row>
        <v-col lg="5" md="6" sm="12" cols="12" class="d-flex">
          <v-btn class="mr-6" color="secondary" large to="/lk/photos">
            <v-icon class="mr-2">mdi-arrow-left</v-icon>
            Отмена
          </v-btn>
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
        </v-col>
      </v-row>
    </v-container>
  </v-form>
</template>

<script>
import loading from '../../mixins/loading'
import { mapActions, mapGetters, mapState } from 'vuex'
import imageMixin from '../../mixins/image'

export default {
  mixins: [loading, imageMixin],
  props: ['id'],
  data: () => ({
    textField: [v => !!v || 'Обязательное поле'],
    form: {
      valid: true,
      title: '',
      image: null
    }
  }),
  async created() {
    await this.getAllPhotos()
    this.setLoad(false)
  },
  mounted() {
    setTimeout(() => {
      if (this.photo) {
        this.form.title = this.photo.title
        this.form.image = this.photo.image
      }
    }, 800)
  },
  computed: {
    ...mapGetters(['getPhotoById']),
    photo() {
      return this.getPhotoById(this.id)
    }
  },
  methods: {
    ...mapActions(['updatePhoto', 'getAllPhotos', 'uploadImage']),
    upload(event) {
      const file = event.target.files[0]
      let fd = new FormData()
      fd.append('image', file)
      fd.append('prefix', 'image-')
      this.uploadImage(fd).then(x => {
        this.form.image = x.fullname
      })
    },
    save() {
      this.setLoad(true)
      if (this.$refs.form.validate() && this.form.image) {
        this.updatePhoto({
          id: this.id,
          ...this.form
        })
      } else this.setLoad(false)
    }
  }
}
</script>
