<template>
  <v-form lazy-validation v-model="form.valid" ref="form">
    <v-container fluid>
      <v-row>
        <v-col cols="12">
          <h1>Новый тип логотипа</h1>
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
          <v-select
            :items="logoSizes"
            label="Размер"
            return-object
            item-text="name"
            v-model="form.logo_size"
          ></v-select>
        </v-col>
      </v-row>
      <v-row>
        <v-col lg="6" md="8" sm="12" cols="12">
          <v-text-field
            label="Цена (руб)"
            v-model="form.price"
            required
            type="number"
            :rules="textField"
          ></v-text-field>
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
          <v-btn color="secondary" large to="/lk/logo_types">
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
import { mapActions, mapState } from 'vuex'
import config from '../../init/config'

export default {
  mixins: [loading],
  data: () => ({
    textField: [v => !!v || 'Обязательное поле'],
    form: {
      valid: true,
      name: '',
      price: 0,
      logo_size: null
    }
  }),
  created() {},
  computed: {
    ...mapState({
      logoSizes: state => state.logoSize.allLogoSizes
    })
  },
  async mounted() {
    await this.getAllLogoSizes()
    this.setLoad(false)
    setTimeout(() => {
      this.form.logo_size = this.logoSizes[0]
    }, 800)
  },
  methods: {
    ...mapActions(['createLogoType', 'getAllLogoSizes']),
    save() {
      this.setLoad(true)
      if (this.$refs.form.validate() && this.form.logo_size) {
        this.createLogoType({
          logo_size_id: this.form.logo_size.id,
          ...this.form
        })
      } else this.setLoad(false)
    }
  }
}
</script>
