<template>
  <v-navigation-drawer>
    <v-list>
      <v-list-item
        prepend-avatar="https://randomuser.me/api/portraits/men/85.jpg"
        title="Bruno Diniz - Effecti"
        nav
      ></v-list-item>
      <v-divider></v-divider>
      <v-list-item
        v-for="(menu, i) in menus"
        :key="i"
        :prepend-icon="menu.icon"
        :title="menu.title"
        :to="menu.link"
      ></v-list-item>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
export default {
  data: () => ({
    menus: [
      { title: 'Página Inicial', icon: 'mdi-home', link: '/' },
      {
        title: 'Licitações',
        icon: 'mdi mdi-application-edit-outline',
        link: '/licitacoes'
      },
      {
        title: 'Modalidades',
        icon: 'mdi mdi-book-open',
        link: '/modalidades'
      },
      { title: 'Empresas', icon: 'mdi mdi-domain', link: '/empresas' },
      { title: 'Status', icon: 'mdi mdi-list-status', link: '/status' }
    ]
  })
}
</script>
