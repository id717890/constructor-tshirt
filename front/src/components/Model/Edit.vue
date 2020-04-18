<template>
  <v-form lazy-validation v-model="form.valid" ref="form">
    <v-container fluid>
      <v-row>
        <v-col cols="12">
          <h1>Редактирование модели</h1>
        </v-col>
      </v-row>
      <v-row>
        <v-col lg="6" md="8" sm="12" cols="12">
          <v-select
            :items="types"
            label="Тип"
            return-object
            item-text="name"
            v-model="form.type"
          ></v-select>

          <v-text-field
            label="Наименование"
            v-model="form.name"
            required
            :rules="textField"
          ></v-text-field>

          <v-text-field
            label="Описание"
            v-model="form.description"
            required
            :rules="textField"
          ></v-text-field>
        </v-col>
        <v-col lg="6" md="4" sm="12" cols="12" class="pl-6">
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
          <div v-if="preview">
            <img
              :src="img(preview)"
              alt=""
              style="max-height: 300px; border-radius: 10px"
            />
          </div>
        </v-col>
      </v-row>
      <v-row>
        <v-col md="8" sm="12" cols="12">
          <color-table
            v-if="model && colors"
            :rows="colors"
            :model_id="model.id"
          />
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
          <v-btn color="secondary" large to="/lk/models">
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
import { mapActions, mapGetters, mapState } from 'vuex'
import config from '../../init/config'
import ColorTable from './ColorTable'

export default {
  mixins: [loading],
  components: {
    ColorTable
  },
  props: ['id'],
  data: () => ({
    textField: [v => !!v || 'Обязательное поле'],
    form: {
      valid: true,
      name: '',
      description: '',
      type: null
    },
    preview: null
  }),
  async created() {
    await this.getAllTypes()
    await this.getAllModels()
    await this.getAllColors()
    this.setLoad(false)
  },
  mounted() {
    setTimeout(() => {
      this.form.type = this.types[0]
      if (this.model) {
        this.form.name = this.model.name
        this.form.description = this.model.description
        this.form.type = this.model.type
        this.preview = this.model.image
      }
    }, 800)
  },
  computed: {
    ...mapGetters(['getModelById', 'getColorosByModelId']),
    ...mapState({
      types: state => state.type.allTypes
    }),
    model() {
      return this.getModelById(this.id)
    },
    colors() {
      return this.getColorosByModelId(this.id)
    }
  },
  methods: {
    ...mapActions([
      'updateModel',
      'getAllTypes',
      'getAllModels',
      'uploadImage',
      'getAllColors'
    ]),
    img(url) {
      return config.apiAddress + 'api/image/' + url
    },
    upload(event) {
      const file = event.target.files[0]
      let fd = new FormData()
      fd.append('image', file)
      fd.append('prefix', 'model-')
      this.uploadImage(fd).then(x => {
        this.preview = x.fullname
      })
    },
    save() {
      this.setLoad(true)
      if (this.$refs.form.validate() && this.preview) {
        this.updateModel({
          id: this.id,
          name: this.form.name,
          description: this.form.description,
          type_id: this.form.type.id,
          image: this.preview
        })
      } else this.setLoad(false)
    }
  }
}
</script>
