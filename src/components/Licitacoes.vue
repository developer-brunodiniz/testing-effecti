<template>
  <div class="row">
    <div class="col-10">
      <h3>Lista de licitações</h3>
    </div>
    <div class="col-2">
      <v-btn
        prepend-icon="mdi mdi-plus"
        v-bind="props"
        color="#5865f2"
        class="float-right"
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
            <th class="text-left">Empresa</th>
            <th class="text-left">Modalidade</th>
            <th class="text-left">Descrição</th>
            <th class="text-left">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in licitacoes" :key="item.id">
            <td>{{ item.empresa_nomefantasia }}</td>
            <td>{{ item.modalidade_description }}</td>
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
          <span class="text-h5">Enviar uma Licitação</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="6">
                <v-autocomplete
                  v-model="this.store.modalidade"
                  :items="modalidades"
                  item-title="description"
                  item-value="id"
                  density="compact"
                  label="Modalidade*"
                ></v-autocomplete>
              </v-col>
              <v-col cols="6">
                <v-autocomplete
                  v-model="this.store.empresa"
                  :items="empresas"
                  item-title="name_fantasy"
                  item-value="id"
                  density="compact"
                  label="Empresa*"
                ></v-autocomplete>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12">
                <v-textarea
                  label="Descreva a sua licitação:*"
                  v-model="this.store.description"
                  required
                ></v-textarea>
              </v-col>
            </v-row>
          </v-container>
          <small>Campos com * são obrigatórios</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue-darken-1" variant="text" @click="closeDialog()">
            Fechar
          </v-btn>
          <v-btn
            v-if="!isUpdate"
            color="blue-darken-1"
            variant="text"
            @click="insert()"
          >
            Enviar
          </v-btn>
          <v-btn v-else color="blue-darken-1" variant="text" @click="update()">
            Reenviar
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
    this.get(), this.getEmpresas(), this.getModalidades()
  },
  data: () => ({
    licitacoes: [],
    empresas: [],
    modalidades: [],
    store: { id: '', empresa: '', modalidade: '', description: '' },
    isUpdate: false,
    dialog: false
  }),
  methods: {
    fillTheStore(licitacoes) {
      this.store.empresa = licitacoes.empresa_id
      this.store.modalidade = licitacoes.modalidade_id
      this.store.description = licitacoes.description
      this.store.id = licitacoes.id
      this.dialog = !this.dialog
      this.isUpdate = !this.isUpdate
    },
    closeDialog() {
      this.store.empresa = ''
      this.store.modalidade = ''
      this.store.description = ''
      this.dialog = false
      setTimeout(() => (this.isUpdate = false), 100)
    },
    getEmpresas() {
      axios.get(`${config.apiURL}/empresas`).then((response) => {
        this.empresas = response.data
      })
    },
    getModalidades() {
      axios.get(`${config.apiURL}/modalidades`).then((response) => {
        this.modalidades = response.data
      })
    },
    get() {
      axios.get(`${config.apiURL}/licitacoes`).then((response) => {
        this.licitacoes = response.data
      })
    },
    insert() {
      axios
        .post(`${config.apiURL}/licitacao/criar`, this.store)
        .then((response) => {
          this.licitacoes.push(response.data)
          this.get()
          this.dialog = false
        })
    },
    update() {
      axios
        .put(
          `${config.apiURL}/licitacao/atualizar/${this.store.id}`,
          this.store
        )
        .then((response) => {
          const indice = this.licitacoes.findIndex(
            (s) => s.id === this.store.id
          )
          this.licitacoes.splice(indice, 1, this.store)
          this.dialog = !this.dialog
          this.isUpdate = !this.isUpdate
        })
    },
    destroy(licitacoes) {
      axios
        .put(`${config.apiURL}/licitacao/deletar/${licitacoes.id}`)
        .then((response) => {
          const indice = this.licitacoes.findIndex(
            (s) => s.id === licitacoes.id
          )
          this.licitacoes.splice(indice, 1)
        })
    }
  }
}
</script>
