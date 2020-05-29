<template>
  <v-row>
    <v-col md="10" offset-md="1" sm="12" cols="12" style="min-height: 90vh">
      <v-card height="100%" flat>
        <v-card-title class="mb-6">
          <h2>Раздел отзывы и пожелания</h2>
        </v-card-title>
        <v-card-text>
          <v-rating
            v-model="form.rating"
            background-color="primary"
            large
            :color="ratingColor()"
          ></v-rating>
          <textarea-emoji-picker v-model="form.text" />
        </v-card-text>
        <v-card-text>
          <v-btn style="float: right" large color="success" tile outlined>
            <v-icon>mdi-check</v-icon>
            Отправить отзыв
          </v-btn>
        </v-card-text>
        <v-card-text>
          <v-card v-for="feedback in feedbacks" :key="feedback.id">
            {{ feedback }}
          </v-card>
        </v-card-text>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
import { mapActions, mapState } from 'vuex'
import TextareaEmojiPicker from '../components/TextareaEmojiPicker'

export default {
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
        return state.feedback.allFeedbacks.map(x => {
          if (x.show === 1 || x.show === true) return x
        })
      }
    })
  },
  async created() {
    await this.getAllFeedbacks()
  },
  methods: {
    ...mapActions(['getAllFeedbacks']),
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
