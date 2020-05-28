<template>
  <v-form lazy-validation v-model="form.valid" ref="form">
    <v-container fluid>
      <v-row>
        <v-col cols="12">
          <h1>Редактирование каталога</h1>
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
                accept="image/*"
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
                accept=".csv, .pdf, .xls, .xlsx"
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
import { mapActions, mapGetters } from 'vuex'
import imageMixin from '../../mixins/image'

export default {
  mixins: [loading, imageMixin],
  props: ['id'],
  data: () => ({
    textField: [v => !!v || 'Обязательное поле'],
    form: {
      valid: true,
      name: '',
      image: '',
      doc: null,
      path: '',
      docName: ''
    }
  }),
  async created() {
    await this.getAllCatalogs()
    this.setLoad(false)
  },
  watch: {
    catalog(value) {
      if (value) {
        this.form.name = value.name
        this.form.image = value.image
        this.form.docName = value.file
      }
    }
  },
  mounted() {
    if (this.catalog) {
      this.form.name = this.catalog.name
      this.form.image = this.catalog.image
      this.form.docName = this.catalog.file
    }
  },
  computed: {
    ...mapGetters(['getCatalogById']),
    catalog() {
      return this.getCatalogById(this.id)
    }
  },
  methods: {
    ...mapActions(['updateCatalog', 'getAllCatalogs', 'uploadImage']),
    upload(event) {
      const file = event.target.files[0]
      let fd = new FormData()
      fd.append('image', file)
      fd.append('prefix', 'catalog-')
      this.uploadImage(fd).then(x => {
        this.form.image = x.fullname
      })
    },
    uploadDoc(e) {
      this.form.doc = e.target.files[0]
      this.form.docName = e.target.value
      this.form.path = e.target.value
    },
    save() {
      this.setLoad(true)
      if (this.$refs.form.validate() && this.form.image && this.form.docName) {
        let fd = new FormData()
        fd.append('id', this.id)
        fd.append('doc', this.form.doc)
        fd.append('name', this.form.name)
        fd.append('image', this.form.image)
        fd.append('file_name', this.form.docName)
        this.updateCatalog({
          id: this.id,
          data: fd
        })
      } else this.setLoad(false)
    }
  }
}
</script>
