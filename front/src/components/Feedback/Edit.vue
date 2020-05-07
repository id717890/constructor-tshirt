<template>
  <v-form lazy-validation v-model="form.valid" ref="form">
    <v-container fluid v-if="feedback">
      <v-row>
        <v-col cols="12">
          <h1>Редактирование отзыва</h1>
        </v-col>
      </v-row>
      <v-row>
        <v-col lg="6" md="8" sm="12" cols="12">
          <v-rating
            x-large
            v-model="form.rating"
            :color="ratingColor(form.rating)"
          ></v-rating>
        </v-col>
      </v-row>
      <v-row>
        <v-col lg="6" md="8" sm="12" cols="12">
          <textarea-emoji-picker v-model="form.text" />
        </v-col>
      </v-row>
      <v-row>
        <v-col lg="6" md="8" sm="12" cols="12">
          <v-icon
            x-large
            v-if="form.show === 1"
            color="success"
            @click="form.show = 0"
            >mdi-toggle-switch</v-icon
          >
          <v-icon x-large v-else color="red" @click="form.show = 1"
            >mdi-toggle-switch-off</v-icon
          >
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
          <v-btn color="secondary" large to="/lk/feedbacks">
            <v-icon class="mr-2">mdi-arrow-left</v-icon>
            Отмена
          </v-btn>
        </v-col>
      </v-row>
    </v-container>
  </v-form>
</template>

<script>
import imageMixin from '../../mixins/image'
import loading from '../../mixins/loading'
import { mapActions, mapGetters } from 'vuex'
import TextareaEmojiPicker from '../../components/TextareaEmojiPicker'

export default {
  mixins: [loading, imageMixin],
  props: ['id'],
  components: {
    TextareaEmojiPicker
  },
  components: { TextareaEmojiPicker },
  data: () => ({
    textField: [v => !!v || 'Обязательное поле'],
    form: {
      valid: true,
      text: '',
      rating: 0,
      show: false
    }
  }),
  async created() {
    await this.getAllFeedbacks()
    this.setLoad(false)
  },
  mounted() {
    if (this.feedback) {
      this.form.rating = this.feedback.rating
      this.form.text = this.feedback.text
      this.form.show = this.feedback.show
    }
  },
  watch: {
    feedback(value) {
      if (value) {
        this.form.rating = this.feedback.rating
        this.form.text = this.feedback.text
        this.form.show = this.feedback.show
      }
    }
  },
  computed: {
    ...mapGetters(['getFeedbackById']),
    feedback() {
      return this.getFeedbackById(this.id)
    }
  },
  methods: {
    ...mapActions(['updateFeedback', 'getAllFeedbacks']),
    ratingColor(rating) {
      switch (rating) {
        case 1:
          return 'red'
        case 2:
          return 'orange'
        case 3:
          return 'yellow'
        case 4:
          return 'lime'
        case 5:
          return 'success'
      }
    },
    save() {
      this.setLoad(true)
      if (this.$refs.form.validate()) {
        this.updateFeedback({
          id: this.id,
          ...this.form
        })
      } else this.setLoad(false)
    }
  }
}
</script>
