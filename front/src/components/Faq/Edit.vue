<template>
  <v-form lazy-validation v-model="form.valid" ref="form">
    <v-container fluid>
      <v-row>
        <v-col cols="12">
          <h1>Редактирование вопроса</h1>
        </v-col>
      </v-row>
      <v-row>
        <v-col lg="6" md="8" sm="12" cols="12">
          <v-text-field
            label="Вопрос"
            v-model="form.question"
            required
            :rules="textField"
          ></v-text-field>
        </v-col>
      </v-row>
      <v-row v-if="form.answer">
        <v-col lg="6" md="8" sm="12" cols="12">
          <tteditor @editorChanged="textChanged($event)" :text="form.answer" />
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
          <v-btn color="secondary" large to="/lk/faqs">
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
import TtEditor from '../TipTapEditor'

export default {
  mixins: [loading],
  props: ['id'],
  components: {
    tteditor: TtEditor
  },
  data: () => ({
    textField: [v => !!v || 'Обязательное поле'],
    form: {
      valid: true,
      question: '',
      answer: ''
    }
  }),
  async created() {
    await this.getAllFaqs()
    this.setLoad(false)
  },
  watch: {
    faq(value) {
      if (value) {
        this.form.question = value.question
        this.form.answer = value.answer
      }
    }
  },
  mounted() {
    if (this.video) {
      this.form.question = this.faq.question
      this.form.answer = this.faq.answer
    }
  },
  computed: {
    ...mapGetters(['getFaqById']),
    faq() {
      return this.getFaqById(this.id)
    }
  },
  methods: {
    ...mapActions(['updateFaq', 'getAllFaqs']),
    textChanged(event) {
      this.form.answer = event
    },
    save() {
      this.setLoad(true)
      if (this.$refs.form.validate()) {
        this.updateFaq({
          id: this.id,
          ...this.form
        })
      } else this.setLoad(false)
    }
  }
}
</script>
