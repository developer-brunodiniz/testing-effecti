<template>
  <div class="row">
    <div class="col-10">
      <h3>Lista de empresas</h3>
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
            <th class="text-left">CNPJ</th>
            <th class="text-left">Nome fantasia</th>
            <th class="text-left">Razão social</th>
            <th class="text-left">Endereço</th>
            <th class="text-left">Telefone celular</th>
            <th class="text-left">E-mail</th>
            <th class="text-left">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in empresas" :key="item.id">
            <td>{{ item.cnpj }}</td>
            <td>{{ item.name_fantasy }}</td>
            <td>{{ item.corporate_reason }}</td>
            <td>{{ item.address }}</td>
            <td>{{ item.cell_phone }}</td>
            <td>{{ item.email }}</td>
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
          <span class="text-h5">Cadastrar Empresa</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="4">
                <v-text-field
                  label="CNPJ"
                  v-model="this.store.cnpj"
                  v-mask="'##.###.###/####-##'"
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="4">
                <v-text-field
                  label="Nome Fantasia*"
                  v-model="this.store.name_fantasy"
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="4">
                <v-text-field
                  label="Razão Social"
                  v-model="this.store.corporate_reason"
                  required
                ></v-text-field>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12">
                <v-text-field
                  label="Endereço"
                  v-model="this.store.address"
                  required
                ></v-text-field>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="6">
                <v-text-field
                  label="Telefone Celular"
                  v-model="this.store.cell_phone"
                  v-mask="'(##) #####-####'"
                  type="tel"
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="6">
                <v-text-field
                  label="E-mail*"
                  v-model="this.store.email"
                  @keyup="validateEmail()"
                  type="email"
                  required
                ></v-text-field>
                <p v-if="emailValidade" class="success">
                  {{ messageEmail }}
                </p>
                <p v-if="!emailValidade" class="error">
                  {{ messageEmail }}
                </p>
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
import { mask } from 'vue-the-mask'

export default {
  directives: { mask },
  created() {
    this.get()
  },
  data: () => ({
    empresas: [],
    messageEmail: '',
    emailValidade: false,
    store: {
      id: '',
      cnpj: '',
      name_fantasy: '',
      corporate_reason: '',
      address: '',
      cell_phone: '',
      email: ''
    },
    isUpdate: false,
    dialog: false
  }),
  methods: {
    fillTheStore(empresas) {
      this.store.cnpj = empresas.cnpj
      this.store.name_fantasy = empresas.name_fantasy
      this.store.corporate_reason = empresas.corporate_reason
      this.store.address = empresas.address
      this.store.cell_phone = empresas.cell_phone
      this.store.email = empresas.email
      this.store.id = empresas.id
      this.dialog = !this.dialog
      this.isUpdate = !this.isUpdate
    },
    closeDialog() {
      this.store.cnpj = ''
      this.store.name_fantasy = ''
      this.store.corporate_reason = ''
      this.store.address = ''
      this.store.cell_phone = ''
      this.store.email = ''
      this.dialog = false
      setTimeout(() => (this.isUpdate = false), 100)
    },
    validateEmail() {
      if (
        /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.store.email)
      ) {
        this.emailValidade = true
        this.messageEmail = 'E-mail Ok!'
      } else {
        this.emailValidade = false
        this.messageEmail = 'E-mail inválido!'
      }
    },
    get() {
      axios.get(`${config.apiURL}/empresas`).then((response) => {
        this.empresas = response.data
      })
    },
    insert() {
      if (this.validateEmail) {
        axios
          .post(`${config.apiURL}/empresa/criar`, this.store)
          .then((response) => {
            this.empresas.push(response.data)
            this.dialog = false
          })
      }
    },
    update() {
      axios
        .put(`${config.apiURL}/empresa/atualizar/${this.store.id}`, this.store)
        .then((response) => {
          const indice = this.empresas.findIndex((s) => s.id === this.store.id)
          this.empresas.splice(indice, 1, this.store)
          this.dialog = !this.dialog
          this.isUpdate = !this.isUpdate
        })
    },
    destroy(empresas) {
      axios
        .put(`${config.apiURL}/empresa/deletar/${empresas.id}`)
        .then((response) => {
          const indice = this.empresas.findIndex((s) => s.id === empresas.id)
          this.empresas.splice(indice, 1)
        })
    }
  }
}
</script>
