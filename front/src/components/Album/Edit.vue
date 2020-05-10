<template>
  <v-form lazy-validation v-model="form.valid" ref="form">
    <v-container fluid>
      <v-row>
        <v-col cols="12">
          <h1>Редактирование альбома</h1>
        </v-col>
      </v-row>
      <v-row>
        <v-col lg="5" md="6" sm="12" cols="12">
          <v-text-field
            label="Наименование"
            v-model="form.name"
            required
            :rules="textField"
          ></v-text-field>
        </v-col>
      </v-row>
      <v-row>
        <v-col lg="5" md="6" sm="12" cols="12" class="d-flex">
          <v-btn class="mr-6" color="secondary" large to="/lk/albums">
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

export default {
  mixins: [loading],
  props: ['id'],
  data: () => ({
    textField: [v => !!v || 'Обязательное поле'],
    form: {
      valid: true,
      name: ''
    }
  }),
  async created() {
    await this.getAllAlbums()
    this.setLoad(false)
  },
  mounted() {
    if (this.album) {
      this.form.name = this.album.name
    }
  },
  watch: {
    album(value) {
      if (value) this.form.name = value.name
    }
  },
  computed: {
    ...mapGetters(['getAlbumById']),
    album() {
      return this.getAlbumById(this.id)
    }
  },
  methods: {
    ...mapActions(['updateAlbum', 'getAllAlbums']),
    save() {
      this.setLoad(true)
      if (this.$refs.form.validate()) {
        this.updateAlbum({
          id: this.id,
          ...this.form
        })
      } else this.setLoad(false)
    }
  }
}
</script>
