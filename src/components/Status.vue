<template>
  <div class="row">
    <div class="col-10">
      <h3>Lista de status</h3>
    </div>
    <div class="col-2">
      <v-btn
        class="btn-criar"
        prepend-icon="mdi mdi-plus"
        v-bind="props"
        color="#5865f2"
        variant="tonal"
        @click="dialog = !dialog"
        >Criar</v-btn
      >
    </div>
  </div>
  <div class="row">
    <div class="col">
      <v-table fixed-header density="compact">
        <thead>
          <tr>
            <th class="text-left">Descrição</th>
            <th class="text-left">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in status" :key="item.id">
            <td>{{ item.description }}</td>
            <td>
              <v-btn
                prepend-icon="mdi mdi-square-edit-outline"
                variant="text"
                color="#fc9905"
                @click="fillTheStore(item)"
              ></v-btn>
              <v-btn
                prepend-icon="mdi mdi-delete-forever"
                variant="text"
                color="#fc0505"
                @click="destroy(item)"
              ></v-btn>
            </td>
          </tr>
        </tbody>
      </v-table>
    </div>
  </div>

  <v-row justify="center">
    <v-dialog v-model="dialog" persistent width="1024">
      <v-card>
        <v-card-title class="titleCard">
          <span class="text-h5">Criar status</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="12">
                <v-text-field
                  label="Descrição*"
                  v-model="this.store.description"
                  required
                ></v-text-field>
              </v-col>
            </v-row>
          </v-container>
          <small>Campos com * são obrigatórios</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue-darken-1" variant="text" @click="dialog = false">
            Fechar
          </v-btn>
          <v-btn
            v-if="!isUpdate"
            color="blue-darken-1"
            variant="text"
            @click="insert()"
          >
            Salvar
          </v-btn>
          <v-btn v-else color="blue-darken-1" variant="text" @click="update()">
            Atualizar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
import axios from 'axios'
import config from '../config/config'

export default {
  created() {
    this.get()
  },
  data: () => ({
    status: [],
    store: { id: '', description: '' },
    isUpdate: false,
    dialog: false
  }),
  methods: {
    fillTheStore(status) {
      this.store.description = status.description
      this.store.id = status.id
      this.dialog = !this.dialog
      this.isUpdate = !this.isUpdate
    },
    get() {
      axios.get(`${config.apiURL}/status`).then((response) => {
        this.status = response.data
      })
    },
    insert() {
      axios
        .post(`${config.apiURL}/status/criar`, this.store)
        .then((response) => {
          this.status.push(response.data)
          this.dialog = false
        })
    },
    update() {
      axios
        .put(`${config.apiURL}/status/atualizar/${this.store.id}`, this.store)
        .then((response) => {
          const indice = this.status.findIndex((s) => s.id === this.store.id)
          this.status.splice(indice, 1, this.store)
          this.dialog = !this.dialog
          this.isUpdate = !this.isUpdate
        })
    },
    destroy(status) {
      axios
        .delete(`${config.apiURL}/status/deletar/${status.id}`)
        .then((response) => {
          const indice = this.status.findIndex((s) => s.id === status.id)
          this.status.splice(indice, 1)
        })
    }
  }
}
</script>
