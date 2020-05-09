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
          <v-text-field
            label="Заголовок"
            v-model="form.title"
            required
            :rules="textField"
          ></v-text-field>
        </v-col>
      </v-row>
      <v-row v-if="form.content">
        <v-col md="8" sm="12" cols="12">
          <tteditor
            @editorChanged="textChanged($event)"
            ref="editor"
            :text="form.content"
          />
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
import loading from '../../mixins/loading'
import { mapActions, mapGetters, mapState } from 'vuex'
import TtEditor from '../TipTapEditor'

export default {
  mixins: [loading],
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
    page() {
      return this.getPageById(this.id)
    }
  },
  methods: {
    ...mapActions(['updatePage', 'getAllPages']),
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
