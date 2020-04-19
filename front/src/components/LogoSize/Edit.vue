<template>
  <v-form lazy-validation v-model="form.valid" ref="form">
    <v-container fluid>
      <v-row>
        <v-col cols="12">
          <h1>Редактирование размера логотипа</h1>
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
            label="Размер (мм)"
            v-model="form.size"
            required
            type="number"
            :rules="textField"
          ></v-text-field>
        </v-col>
      </v-row>
      <v-row>
        <v-col md="10" sm="12" cols="12">
          <h2>Типы логотипов</h2>
          <type-table
            v-if="logoSize && logoTypes"
            :rows="logoTypes"
            :logo_size_id="logoSize.id"
          />
        </v-col>
      </v-row>
      <v-row>
        <v-col lg="6" md="8" sm="12" cols="12" class="d-flex">
          <v-btn class="mr-6" color="secondary" large to="/lk/logo_sizes">
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
import config from '../../init/config'
import TypeTable from './TypeTable'

export default {
  mixins: [loading],
  props: ['id'],
  components: {
    TypeTable
  },
  data: () => ({
    textField: [v => !!v || 'Обязательное поле'],
    form: {
      valid: true,
      name: '',
      size: 0
    }
  }),
  async created() {
    await this.getAllLogoTypes()
  },
  async mounted() {
    await this.getAllLogoSizes()
    this.setLoad(false)
    setTimeout(() => {
      if (this.logoSize) {
        this.form.name = this.logoSize.name
        this.form.size = this.logoSize.size
      }
    }, 800)
  },
  computed: {
    ...mapGetters(['getLogoSizeById', 'getTypesBySizeId']),
    logoSize() {
      return this.getLogoSizeById(this.id)
    },
    logoTypes() {
      return this.getTypesBySizeId(this.id)
    }
  },
  methods: {
    ...mapActions(['updateLogoSize', 'getAllLogoSizes', 'getAllLogoTypes']),
    save() {
      this.setLoad(true)
      if (this.$refs.form.validate()) {
        this.updateLogoSize({
          id: this.id,
          ...this.form
        })
      } else this.setLoad(false)
    }
  }
}
</script>
