<template>
  <v-form lazy-validation v-model="form.valid" ref="form">
    <v-container fluid>
      <v-row>
        <v-col cols="12">
          <h1>О компании</h1>
        </v-col>
      </v-row>
      <v-row>
        <v-col md="8" sm="12" cols="12">
          <v-row>
            <v-col>
              <v-text-field
                label="Заголовок"
                v-model="form.title"
                required
                :rules="textField"
              ></v-text-field>
            </v-col>
          </v-row>
          <v-row v-if="form.content">
            <v-col>
              <tteditor
                @editorChanged="textChanged($event)"
                ref="editor"
                :text="form.content"
              />
            </v-col>
          </v-row>
        </v-col>
        <v-col md="8" sm="12" cols="12">
          <v-btn dark class="w100" to="/lk/page/about/image/create">
            <v-icon>mdi-image</v-icon>
            Добавить изображение
          </v-btn>
          <v-row v-if="images">
            <v-col class="d-flex flex-row flex-wrap">
              <div
                class="about-image-item"
                v-for="image in images"
                :key="image.id"
              >
                <div class="about-image-btn">
                  <v-btn
                    fab
                    text
                    title="Редакитровать"
                    color="primary"
                    :to="'/lk/page/about/image/edit/' + image.id"
                  >
                    <v-icon>mdi-pen</v-icon>
                  </v-btn>
                  <v-btn
                    color="error"
                    fab
                    text
                    @click.prevent="deleteItem(image)"
                  >
                    <v-icon>mdi-delete</v-icon>
                  </v-btn>
                </div>
                <v-img :src="img(image.image)"></v-img>
              </div>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
      <v-row>
        <v-col md="8" sm="12" cols="12" class="d-flex">
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
import config from '../../init/config'
import loading from '../../mixins/loading'
import imageMixin from '../../mixins/image'
import { mapActions, mapGetters, mapState } from 'vuex'
import TtEditor from '../TipTapEditor'
import ConfirmDialogModal from '../Dialog/ConfirmDialog'

export default {
  mixins: [loading, imageMixin],
  components: {
    tteditor: TtEditor
  },
  data: () => ({
    id: 1,
    textField: [v => !!v || 'Обязательное поле'],
    form: {
      valid: true,
      title: '',
      content: '',
      name: ''
    }
  }),
  async created() {
    await this.getAllPages()
    await this.getAllAboutImages()
    this.setLoad(false)
  },
  mounted() {
    if (this.photo) {
      this.form.title = value.title
      this.form.content = value.content
      this.form.name = value.name
    }
  },
  watch: {
    page(value) {
      if (value) {
        this.form.title = value.title
        this.form.content = value.content
        this.form.name = value.name
      }
    }
  },
  computed: {
    ...mapGetters(['getPageById']),
    ...mapState({
      images: state => state.about.allAboutImages,
      confirmDialogResult: state => state.dialog.confirmDialogResult
    }),
    page() {
      return this.getPageById(this.id)
    }
  },
  methods: {
    ...mapActions([
      'updatePage',
      'getAllPages',
      'getAllAboutImages',
      'resetConfirmDialogResult',
      'deleteAboutImage'
    ]),
    deleteItem(item) {
      this.removedItem = item
      this.$modal.show(
        ConfirmDialogModal,
        { question: 'Удалить запись?' },
        config.modalSettings,
        {
          closed: this.confirmDelete
        }
      )
    },
    confirmDelete() {
      if (this.confirmDialogResult === true) {
        this.resetConfirmDialogResult()
        this.deleteAboutImage(this.removedItem)
        this.removedItem = null
      }
    },
    textChanged(event) {
      this.form.content = event
    },
    save() {
      this.setLoad(true)
      if (this.$refs.form.validate() && this.form.content) {
        this.updatePage({
          id: this.id,
          ...this.form
        })
      } else this.setLoad(false)
    }
  }
}
</script>
