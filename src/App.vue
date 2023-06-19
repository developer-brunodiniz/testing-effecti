<template>
  <v-card>
    <v-layout>
      <navigation-drawer />
      <app-bar />
      <v-main class="main">
        <v-container>
          <v-responsive>
            <router-view />
          </v-responsive>
        </v-container>
        <footer />
      </v-main>
    </v-layout>
  </v-card>
</template>

<script>
import NavigationDrawer from './components/Layout/NavigationDrawer.vue'
import AppBar from './components/Layout/AppBar.vue'
import Footer from './components/Layout/Footer.vue'

export default {
  components: { NavigationDrawer, AppBar, Footer }
}
</script>

<style scoped>
.main {
  margin-top: 1.5rem;
}
</style>
