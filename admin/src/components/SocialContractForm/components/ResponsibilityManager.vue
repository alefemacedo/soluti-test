<template>
  <div class="social-contract--form m-2">
    <s-responsibility-item
      v-for="(item, index) in responsibleComputed"
      :key="index"
      :value="item"
      :people="people"
      :error="error"
      :prop="'responsible[' + item.id + ']'"
      @delete="handleRemove"/>
    
    <div class="form-group d-flex justify-content-end mt-3">
      <button @click="handleAdd" type="button" class="btn btn-success mr-1">Novo Item</button>
    </div>
  </div>
</template>

<script>
import ResponsibilityItem from "./ResponsibilityItem"
import { fetchAll } from "@/api/person"

export default {
  components: {
    "s-responsibility-item": ResponsibilityItem
  },
  props: {
    value: {
      type: Object,
      required: true,
      default() {
        return {}
      }
    },
    error: {
      type: Object,
      required: true,
      default() {
        return {}
      }
    }
  },
  data() {
    return {
      people: []
    }
  },
  beforeMount() {
    this.fetchAllPeople()
  },
  mounted() {
    // Inicializa o formulário com um item vazio
    if (Object.keys(this.value).length === 0) {
      this.handleAdd()
    }
  },
  updated() {
    // Inicializa o formulário com um item vazio
    if (Object.keys(this.value).length === 0) {
      this.handleAdd()
    }
  },
  computed: {
    /**
     * Computed property para ordenar os itens inseridos
     * dinamicamente
     */
    responsibleComputed: {
      get() {
        // Cria posições para os itens de modelo e ordena-os
        let count = 0
        return Object.values(this.value)
          .map(obj => {
            if (typeof obj.position === "undefined") {
              obj.position = count
              count += 1
            }
            return obj
          })
          .sort((a, b) => a.position - b.position)
      }
    }
  },
  methods: {
    /**
     * Busca todas as pessoas cadastradas no banco
     * como um array formatado
     */
    fetchAllPeople() {
      fetchAll()
        .then((response) => {
          if (Object.prototype.hasOwnProperty.call(response.data, "_embedded")) {
            this.people = [...response.data._embedded.people]
          }
        })
        .catch((error) => {
          this.$toasted.error(error.response.data.detail)
        })
    },
    /**
     * Insere um novo modelo de prova no objeto que representa a coleção
     * de modelos
     */
    createEmptyItem() {
      const responsible = { ...this.value }
      const id = Math.floor((Math.random() * 10000000) + 1)
      responsible[id] = {
        id,
        person_id: "",
        type: "",
        position: Object.keys(this.value).length + 1
      }

      return responsible
    },
    /**
     * Chama a função que cria um novo modelo e atualiza o prop value
     * que é a coleção de modelos criados
     */
    handleAdd() {
      const responsibleUpdated = this.createEmptyItem()
      this.$emit("input", responsibleUpdated)
    },
    /**
     * Identifica que um modelo deve ser removido da coleção de modelos,
     * assim realiza o procedimento de remoção
     */
    handleRemove(item) {
      const responsibleUpdated = { ...this.value }

      // Remove o modelo da coleção
      delete responsibleUpdated[item.id]
      // Emite um evento alterando os dados do formulário
      this.$emit("input", responsibleUpdated)
    }
  }
}
</script>

<style>

</style>