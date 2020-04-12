<template>
  <v-form lazy-validation v-model="form.valid" ref="form">
    <v-container fluid>
      <v-row v-if="color">
        <v-col cols="12">
          <h1>Размеры и цены</h1>
        </v-col>
        <v-col cols="12" md="4">
          <p>
            <strong>Модель:</strong>
            {{ color.model.name }}
          </p>
          <p>
            <strong>Цвет:</strong>
            {{ color.name }}
          </p>
          <p>
            <strong>Артикул:</strong>
            {{ color.article }}
          </p>
        </v-col>
        <v-col cols="12" md="4">
          <p>
            <strong>Вид спереди</strong>
          </p>
          <img
            :src="img(color.image_front)"
            style="max-height: 200px; border-radius: 10px"
          />
        </v-col>
        <v-col cols="12" md="4">
          <p>
            <strong>Вид сзади</strong>
          </p>
          <img
            :src="img(color.image_back)"
            style="max-height: 200px; border-radius: 10px"
          />
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12" md="8" lg="6">
          <size-table v-if="color" :rows="sizes" :color_id="color.id" />
        </v-col>
      </v-row>
      <v-row>
        <v-col lg="6" md="8" sm="12" cols="12" class="d-flex">
          <v-btn color="secondary" large to="/lk/colors" class="mr-6">
            <v-icon class="mr-2">mdi-arrow-left</v-icon>Назад
          </v-btn>
          <!-- <v-btn
            color="primary"
            large
            :loading="loading"
            @click.prevent="save"
            :disabled="!form.valid"
          >
            <v-icon class="mr-2">mdi-content-save</v-icon>Сохранить
          </v-btn> -->
        </v-col>
      </v-row>
    </v-container>
  </v-form>
</template>

<script>
import loading from '../../mixins/loading'
import { mapActions, mapGetters, mapState } from 'vuex'
import config from '../../init/config'
import SizeTable from './SizeTable'

export default {
  mixins: [loading],
  props: ['id'],
  components: {
    SizeTable
  },
  data: () => ({
    textField: [v => !!v || 'Обязательное поле'],
    form: {
      valid: true,
      name: '',
      article: '',
      model: null
    },
    previewFront: null,
    previewBack: null
  }),
  async created() {
    await this.getAllColors()
    await this.getSizes(this.id)
    this.setLoad(false)
  },
  async beforeMount() {},
  async mounted() {},
  computed: {
    ...mapGetters(['getColorById']),
    ...mapState({
      sizes: state => state.size.sizesOfColor
    }),
    color() {
      return this.getColorById(this.id)
    }
  },
  methods: {
    ...mapActions(['getSizes', 'getAllColors']),
    img(url) {
      return config.apiAddress + 'api/image/' + url
    },
    save() {
      this.setLoad(true)
      if (this.$refs.form.validate() && this.previewFront && this.previewBack) {
        this.updateColor({
          id: this.id,
          name: this.form.name,
          article: this.form.article,
          model_id: this.form.model.id,
          image_front: this.previewFront,
          image_back: this.previewBack
        })
      } else this.setLoad(false)
    }
  }
}
</script>
