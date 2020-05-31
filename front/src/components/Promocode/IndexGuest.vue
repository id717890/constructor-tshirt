<template>
  <v-row>
    <v-col md="10" offset-md="1" sm="12" cols="12" style="min-height: 80vh">
      <v-card height="100%" flat v-if="faqs">
        <v-card-title class="px-10">
          <h2 class="mb-6">Часто задаваемые вопросы</h2>
        </v-card-title>
        <v-card-text>
          <v-expansion-panels multiple popout v-if="faqs">
            <v-expansion-panel v-for="(item, i) in faqs" :key="i">
              <v-expansion-panel-header>
                {{ item.question }}
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <div v-html="item.answer"></div>
              </v-expansion-panel-content>
            </v-expansion-panel>
          </v-expansion-panels>
        </v-card-text>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
import { mapState, mapActions } from 'vuex'
export default {
  async created() {
    await this.getAllFaqs()
  },
  methods: {
    ...mapActions(['getAllFaqs'])
  },
  computed: {
    ...mapState({
      faqs: state => state.faq.allFaqs
    })
  }
}
</script>
