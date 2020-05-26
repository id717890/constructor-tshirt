<template>
  <v-form lazy-validation v-model="form.valid" ref="form">
    <v-container fluid>
      <v-row>
        <v-col cols="12">
          <h1>Новое каталог</h1>
        </v-col>
      </v-row>
      <v-row>
        <v-col lg="6" md="8" sm="12" cols="12">
          <v-text-field
            label="Наименование"
            v-model="form.name"
            required
            :rules="textField"
          ></v-text-field>
        </v-col>
      </v-row>
      <v-row>
        <v-col lg="6" md="8" sm="12" cols="12">
          <v-row>
            <v-col cols="6">
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
            <v-col cols="6">
              <v-btn
                @click="$refs.doc.click()"
                color="blue"
                dark
                class="mb-5 w100"
              >
                <v-icon>mdi-image</v-icon>
                Загрузить файл
              </v-btn>
              <input
                style="display: none"
                ref="doc"
                type="file"
                @change="uploadDoc"
              />
              <div v-if="form.path">{{ form.path }}</div>
            </v-col>
          </v-row>
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
          <v-btn color="secondary" large to="/lk/catalogs">
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
    textField: [v => !!v || 'Обязательное поле'],
    form: {
      valid: true,
      name: '',
      image: '',
      doc: null,
      path: ''
    }
  }),
  mounted() {
    this.setLoad(false)
  },
  methods: {
    ...mapActions(['createCatalog', 'uploadImage']),
    uploadDoc(e) {
      this.form.doc = e.target.files[0]
      this.form.path = e.target.value
    },
    upload(event) {
      const file = event.target.files[0]
      let fd = new FormData()
      fd.append('image', file)
      fd.append('prefix', 'catalog-')
      this.uploadImage(fd).then(x => {
        this.form.image = x.fullname
      })
    },
    save() {
      this.setLoad(true)
      if (this.$refs.form.validate() && this.form.doc && this.form.image) {
        let fd = new FormData()
        fd.append('doc', this.form.doc)
        fd.append('name', this.form.name)
        fd.append('image', this.form.image)
        this.createCatalog(fd)
      } else this.setLoad(false)
    }
  }
}
</script>
