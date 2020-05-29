<template>
  <v-row>
    <v-col cols="12">
      <v-card class="pa-1">
        <v-card-title>
          <span>Блок №4</span>
          <v-btn
            @click.prevent="save"
            class="mt-1"
            fab
            text
            x-large
            color="success"
            title="Сохранить высоту"
          >
            <v-icon>mdi-content-save</v-icon>
          </v-btn>
        </v-card-title>
        <v-row>
          <v-col
            cols="12"
            lg="6"
            offset-lg="3"
            md="10"
            offset-md="1"
            sm="12"
            class="text-center"
          >
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="4">
            <v-card>
              <v-card-title>
                Рисунок и текст
              </v-card-title>
              <v-card-text>
                <div v-if="form.image">
                  <img
                    :src="img(form.image)"
                    style="width: 100%; border-radius: 5px"
                  />
                </div>
                <v-btn
                  color="red"
                  dark
                  class="w100 my-3"
                  @click="$refs.image.click()"
                >
                  <v-icon class="mr-3">mdi-image</v-icon>
                  Загрузить изображение
                </v-btn>
                <input
                  style="display: none"
                  ref="image"
                  type="file"
                  accept="image/*"
                  @change="uploadImageBlock4"
                />
                <v-text-field
                  outlined
                  v-model="form.title"
                  label="Заголовок (не обязательно)"
                ></v-text-field>
                <tteditor
                  v-if="showEditor"
                  ref="editor1"
                  @editorChanged="textChanged($event)"
                  :text="form.text"
                />
              </v-card-text>
            </v-card>
          </v-col>
          <v-col cols="4">
            <v-card>
              <v-card-title>
                Кнопка №1
              </v-card-title>
              <v-card-text>
                <v-text-field
                  outlined
                  v-model="form.button1Text"
                  label="Текст (не обязательно)"
                ></v-text-field>
                <v-text-field
                  outlined
                  v-model="form.button1Url"
                  label="Ссылка"
                ></v-text-field>
              </v-card-text>
            </v-card>
          </v-col>
          <v-col cols="4">
            <v-card>
              <v-card-title>
                Кнопка №2
              </v-card-title>
              <v-card-text>
                <v-text-field
                  outlined
                  v-model="form.button2Text"
                  label="Текст (не обязательно)"
                ></v-text-field>
                <v-textarea
                  outlined
                  v-model="form.button2Iframe"
                  label="YouTube видео"
                ></v-textarea>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
import imageMixin from '../../mixins/image'
import TtEditor from '../TipTapEditor'
import { mapActions, mapGetters } from 'vuex'

export default {
  mixins: [imageMixin],
  components: {
    tteditor: TtEditor
  },
  data: () => ({
    showEditor: false,
    configKey: 'home_block4',
    form: {
      button1Text: '',
      button1Url: '',
      button2Text: '',
      button2Iframe: '',
      image: null,
      title: '',
      text: ''
    }
  }),
  computed: {
    ...mapGetters(['getConfigByKey']),
    block4() {
      return this.getConfigByKey(this.configKey)
    }
  },
  methods: {
    ...mapActions(['uploadImage', 'setConfig']),
    uploadImageBlock4(event) {
      const file = event.target.files[0]
      let fd = new FormData()
      fd.append('image', file)
      fd.append('prefix', 'home-block4-')
      this.uploadImage(fd).then(x => {
        this.form.image = x.fullname
      })
    },
    textChanged(event) {
      this.form.text = event
    },
    save() {
      const data = JSON.stringify(this.form)
      this.setConfig({ key: this.configKey, value: data })
    }
  },
  mounted() {
    setTimeout(() => {
      if (this.block4) {
        const obj = JSON.parse(this.block4.value)
        this.form = obj
        // if (obj && obj.text) this.form.text = obj.text
        this.showEditor = true
      }
    }, 900)
  },
  watch: {
    block4(value) {
      if (value) {
        const obj = JSON.parse(value.value)
        this.form = obj
        // if (obj && obj.text) this.form.text = obj.text
        this.showEditor = true
      }
    }
  }
}
</script>
