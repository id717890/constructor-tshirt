<template>
  <v-row>
    <v-col
      md="10"
      offset-md="1"
      sm="12"
      cols="12"
      style="min-height: 83vh"
      class="py-12"
    >
      <v-expansion-panels multiple popout>
        <v-expansion-panel v-for="(item, i) in 17" :key="i">
          <v-expansion-panel-header
            >Вопрос №{{ i + 1 }}</v-expansion-panel-header
          >
          <v-expansion-panel-content>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
            eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
            ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
            aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet,
            consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
            exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat.
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-expansion-panels>
    </v-col>
  </v-row>
</template>

<script>
export default {}
</script>

<style></style>
