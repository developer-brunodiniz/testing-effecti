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
        <v-footer class="d-flex flex-column">
          <div class="px-4 py-2 bg-black text-center w-100">
            {{ new Date().getFullYear() }} —
            <strong>Effecti - Bruno Diniz</strong>
          </div>
        </v-footer>
      </v-main>
    </v-layout>
  </v-card>
</template>

<script>
import NavigationDrawer from './components/Layout/NavigationDrawer.vue'
import AppBar from './components/Layout/AppBar.vue'

export default {
  components: { NavigationDrawer, AppBar }
}
</script>

<style scoped>
.main {
  margin-top: 1.5rem;
}
</style>
