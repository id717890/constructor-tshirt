<template>
  <v-form lazy-validation v-model="form.valid" ref="form">
    <v-container fluid>
      <v-row>
        <v-col cols="12">
          <h1>Новый модель</h1>
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
          <v-text-field
            label="Описание"
            v-model="form.description"
            required
            :rules="textField"
          ></v-text-field>
        </v-col>
      </v-row>
      <v-row>
        <v-col lg="6" md="8" sm="12" cols="12">
          <v-text-field
            type="number"
            label="Скидка %"
            min="0"
            max="100"
            v-model="form.discount"
          ></v-text-field>
        </v-col>
      </v-row>
      <v-row>
        <v-col lg="6" md="8" sm="12" cols="12">
          <v-text-field
            type="number"
            label="Очередность"
            v-model="form.order"
          ></v-text-field>
        </v-col>
      </v-row>
      <v-row>
        <v-col lg="6" md="8" sm="12" cols="12">
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
import { mapActions, mapState } from 'vuex'
import config from '../../init/config'

export default {
  mixins: [loading],
  data: () => ({
    textField: [v => !!v || 'Обязательное поле'],
    form: {
      valid: true,
      name: '',
      description: '',
      discount: 0,
      order: null,
      type: null
    },
    preview: null
  }),
  async mounted() {
    await this.getAllTypes()
    this.setLoad(false)
    setTimeout(() => {
      this.form.type = this.types[0]
    }, 800)
  },
  computed: {
    ...mapState({
      types: state => state.type.allTypes
    })
  },
  methods: {
    ...mapActions(['createModel', 'getAllTypes', 'uploadImage']),
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
      if (this.$refs.form.validate() && this.preview && this.form.type) {
        this.createModel({
          name: this.form.name,
          description: this.form.description,
          discount: this.form.discount,
          type_id: this.form.type.id,
          image: this.preview,
          order: this.form.order
        })
      } else this.setLoad(false)
    }
  }
}
</script>
