<template>
  <v-card>
    <v-card-text>
      <v-simple-table dense>
        <template v-slot:default>
          <thead>
            <tr>
              <th class="">Размер</th>
              <th class="">Вкл\Выкл</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(row, index) in sizes" :key="index">
              <td>{{ row.size }}</td>
              <td>
                <v-icon
                  large
                  color="success"
                  v-if="row.is_show === 1"
                  @click="row.is_show = 0"
                  >mdi-toggle-switch</v-icon
                >
                <v-icon large color="red" v-else @click="row.is_show = 1"
                  >mdi-toggle-switch-off</v-icon
                >
              </td>
            </tr>
          </tbody>
        </template>
      </v-simple-table>
    </v-card-text>
    <v-card-text class="d-flex">
      <v-spacer></v-spacer>
      <v-btn color="success" @click="saveSizesOfModel">
        <v-icon class="mr-2">mdi-content-save</v-icon>
        Сохрантиь
      </v-btn>
    </v-card-text>
  </v-card>
</template>

<script>
import config from '../../init/config'
import { mapActions, mapState } from 'vuex'
import ConfirmDialogModal from '../Dialog/ConfirmDialog'
export default {
  props: ['model_id', 'sizes'],
  data: () => ({}),
  async created() {},
  computed: {},
  methods: {
    ...mapActions(['updateModelSize']),
    saveSizesOfModel() {
      this.updateModelSize({
        id: this.model_id,
        sizes: this.sizes
      })
    }
  }
}
</script>
