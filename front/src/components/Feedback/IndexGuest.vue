<template>
  <v-row class="v-application">
    <v-col md="10" offset-md="1" sm="12" cols="12" style="min-height: 90vh">
      <v-card height="100%" flat>
        <v-card-title>
          <h3>Раздел отзывы и пожелания</h3>
        </v-card-title>
        <v-card-text>
          <v-form lazy-validation v-model="form.valid" ref="form">
            <v-rating
              v-model="form.rating"
              background-color="primary"
              large
              :color="ratingColor()"
            ></v-rating>
            <textarea-emoji-picker v-model="form.text" />
          </v-form>
        </v-card-text>
        <v-card-text class="d-flex flex-row">
          <v-btn
            large
            color="primary"
            tile
            outlined
            @click.prevent="ideaDialog"
          >
            <v-icon class="mr-6">mdi-lightbulb-on</v-icon>
            предложение
          </v-btn>
          <v-spacer></v-spacer>
          <v-btn
            large
            color="success"
            tile
            outlined
            :loading="loading"
            @click.prevent="newFeedback"
            :disabled="allowCreateFeedback"
          >
            <v-icon>mdi-check</v-icon>
            Отправить отзыв
          </v-btn>
        </v-card-text>
        <v-card-text class="pt-12 mt-6">
          <v-card v-for="feedback in feedbacks" :key="feedback.id" class="mb-6">
            <v-card-text class="text-right d-flex">
              <span class="news-date">{{ date(feedback.created_at) }}</span>
              <v-spacer></v-spacer>
              <v-rating
                readonly
                dense
                v-model="feedback.rating"
                :color="ratingColor2(feedback.rating)"
              ></v-rating>
            </v-card-text>
            <v-card-text>
              {{ feedback.text }}
            </v-card-text>
          </v-card>
        </v-card-text>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
import { mapActions, mapState } from 'vuex'
import moment from 'moment'
import config from '../../init/config'
import TextareaEmojiPicker from '../../components/TextareaEmojiPicker'
import loading from '../../mixins/loading'
import IdeaDialog from '@/components/Dialog/IdeaDialog'

export default {
  mixins: [loading],
  components: { TextareaEmojiPicker },
  data: () => ({
    form: {
      text: '',
      rating: 5
    }
  }),
  computed: {
    ...mapState({
      feedbacks: state => {
        return state.feedback.allFeedbacks.filter(
          x => x.show === 1 || x.show === true
        )
      }
    }),
    allowCreateFeedback() {
      return !this.form.text
    }
  },
  async created() {
    await this.getAllFeedbacks()
    this.setLoad(false)
  },
  methods: {
    ...mapActions(['getAllFeedbacks', 'createFeedback']),
    ideaDialog() {
      this.$modal.show(
        IdeaDialog,
        {},
        { ...config.modalSettings, clickToClose: true },
        {}
      )
    },
    date(value) {
      moment.locale('ru')
      return (
        moment(value).format('DD') +
        ' ' +
        moment(value).format('MMMM') +
        ' ' +
        moment(value).format('YYYY')
      )
    },
    newFeedback() {
      this.setLoad(true)
      this.createFeedback(this.form)
        .then(x => {
          this.form.text = ''
          alert('Отзыв успешно отправлен!')
          this.setLoad(false)
        })
        .catch(x => {
          console.log(x)
          this.setLoad(false)
        })
    },
    ratingColor2(rating) {
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
    ratingColor() {
      switch (this.form.rating) {
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
    }
  }
}
</script>

<style></style>
