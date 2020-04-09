<template>
  <div class="dialog-body-wrapper">
    <v-card>
      <v-card-title class="headline grey lighten-2" primary-title>
        Подтверждение
      </v-card-title>

      <v-card-text class="display-1 mt-5">
        {{ question }}
      </v-card-text>

      <v-divider></v-divider>

      <v-card-actions>
        <v-btn text @click="cancel">
          Отмена
        </v-btn>
        <v-spacer></v-spacer>
        <v-btn color="success" text @click="confirm">
          Ok
        </v-btn>
      </v-card-actions>
    </v-card>

    <!-- <b-container>
    <b-row>
      <b-col class="pt-4 pl-3 pr-3 pb-4">
        <b-container>
          <b-row>
            <b-col class="text-center">
              <h4 class="text-danger"><fai size="2x" icon="question"/></h4>
              <h4>{{question}}</h4>
            </b-col>
          </b-row>
          <b-row>
            <b-col class="text-right">
              <b-button size="lg" variant="secondary" @click="cancel"><fai icon="redo"/> Cancel</b-button>
              <b-button size="lg" variant="primary" @click="confirm"><fai icon="check"/> Ok</b-button>
            </b-col>
          </b-row>
        </b-container>
      </b-col>
    </b-row>
  </b-container> -->
  </div>
</template>

<script>
import { mapActions } from 'vuex'

export default {
  props: ['question'],
  methods: {
    confirm() {
      this.acceptConfirmDialog()
      this.$emit('close')
    },
    cancel() {
      this.$emit('close')
    },
    ...mapActions(['acceptConfirmDialog'])
  }
}
</script>
