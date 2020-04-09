<template>
  <v-form lazy-validation v-model="form.valid" ref="form">
    <v-container fluid>
      <v-row>
        <v-col cols="12">
          <h1>Новый цвет</h1>
        </v-col>
      </v-row>
      <v-row>
        <v-col lg="4" sm="12" cols="12">
          <v-text-field
            label="Цвет"
            v-model="form.name"
            required
            :rules="textField"
          ></v-text-field>
        </v-col>
        <v-col lg="4" sm="12" cols="12">
          <v-text-field
            label="Артикул"
            v-model="form.article"
            required
            :rules="textField"
          ></v-text-field>
        </v-col>
        <v-col lg="4" sm="12" cols="12">
          <v-select
            :items="models"
            label="Модель"
            return-object
            item-text="name"
            v-model="form.model"
          ></v-select>
        </v-col>
      </v-row>
      <v-row>
        <v-col lg="6" sm="12" cols="12">
          <v-btn @click="$refs.fileFront.click()" dark class="mb-5">
            <v-icon>mdi-image</v-icon>
            Загрузить вид спереди</v-btn
          >
          <input
            style="display: none"
            ref="fileFront"
            type="file"
            @change="uploadFront"
          />
          <div v-if="previewFront">
            <img
              :src="img(previewFront)"
              alt=""
              style="max-height: 300px; border-radius: 10px"
            />
          </div>
        </v-col>
        <v-col lg="6" sm="12" cols="12">
          <v-btn @click="$refs.fileBack.click()" dark class="mb-5">
            <v-icon>mdi-image</v-icon>
            Загрузить вид сзади</v-btn
          >
          <input
            style="display: none"
            ref="fileBack"
            type="file"
            @change="uploadBack"
          />
          <div v-if="previewBack">
            <img
              :src="img(previewBack)"
              alt=""
              style="max-height: 300px; border-radius: 10px"
            />
          </div>
        </v-col>
      </v-row>
      <v-row>
        <v-col lg="6" md="8" sm="12" cols="12" class="d-flex">
          <v-btn color="secondary" class="mr-6" large to="/lk/colors">
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
import { mapActions, mapState } from 'vuex'
import config from '../../init/config'

export default {
  mixins: [loading],
  data: () => ({
    textField: [v => !!v || 'Обязательное поле'],
    form: {
      valid: true,
      name: '',
      article: '',
      model: null
    },
    previewFront: null,
    previewBack: null
  }),
  async mounted() {
    await this.getAllModels()
    this.setLoad(false)
    setTimeout(() => {
      this.form.model = this.models[0]
    }, 800)
  },
  computed: {
    ...mapState({
      models: state => state.model.allModels
    })
  },
  methods: {
    ...mapActions(['createColor', 'getAllModels', 'uploadImage']),
    img(url) {
      return config.apiAddress + 'api/image/' + url
    },
    uploadFront(event) {
      const file = event.target.files[0]
      let fd = new FormData()
      fd.append('image', file)
      fd.append('prefix', 'color-')
      this.uploadImage(fd).then(x => {
        this.previewFront = x.fullname
      })
    },
    uploadBack(event) {
      const file = event.target.files[0]
      let fd = new FormData()
      fd.append('image', file)
      fd.append('prefix', 'color-')
      this.uploadImage(fd).then(x => {
        this.previewBack = x.fullname
      })
    },
    save() {
      this.setLoad(true)
      if (
        this.$refs.form.validate() &&
        this.previewFront &&
        this.previewBack &&
        this.form.model
      ) {
        this.createColor({
          name: this.form.name,
          article: this.form.article,
          model_id: this.form.model.id,
          image_front: this.previewFront,
          image_back: this.previewBack
        })
      } else this.setLoad(false)
    }
  }
}
</script>
