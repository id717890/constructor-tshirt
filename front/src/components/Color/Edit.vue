<template>
  <v-form lazy-validation v-model="form.valid" ref="form">
    <v-container fluid>
      <v-row>
        <v-col cols="12">
          <h1>Редактирование цвета</h1>
        </v-col>
      </v-row>
      <v-row>
        <v-col lg="4" sm="12" cols="12">
          <v-text-field
            label="Наименование"
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
          <v-btn
            @click="$refs.fileFront.click()"
            dark
            color="info"
            class="mb-5"
          >
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
          <v-btn @click="$refs.fileBack.click()" dark color="info" class="mb-5">
            <v-icon>mdi-image</v-icon>
            Загрузить вид сзади</v-btn
          >
          <input
            style="display: none"
            ref="fileBack"
            type="file"
            @change="uploadBack"
          />
          <div v-if="previewFront">
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
          <v-btn color="secondary" large to="/lk/colors" class="mr-6">
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
import config from '../../init/config'

export default {
  mixins: [loading],
  props: ['id'],
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
  created() {},
  async beforeMount() {},
  async mounted() {
    await this.getAllColors()
    await this.getAllModels()
    this.setLoad(false)
    setTimeout(() => {
      this.form.model = this.models[0]
      if (this.color) {
        this.form.name = this.color.name
        this.form.article = this.color.article
        this.previewBack = this.color.image_back
        this.previewFront = this.color.image_front
      }
    }, 800)
  },
  computed: {
    ...mapGetters(['getColorById']),
    ...mapState({
      models: state => state.model.allModels
    }),
    color() {
      return this.getColorById(this.id)
    }
  },
  methods: {
    ...mapActions([
      'updateColor',
      'getAllModels',
      'getAllColors',
      'uploadImage'
    ]),
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
      if (this.$refs.form.validate() && this.previewFront && this.previewBack) {
        this.updateColor({
          id: this.id,
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
