<template>
  <div class="social-contract--form m-2">
    <s-responsability-item
      v-for="(item, index) in responsableComputed"
      :key="index"
      :value="item"
      :people="people"
      @delete="handleRemove"/>
    
    <div class="form-group d-flex justify-content-end mt-3">
      <button @click="handleAdd" type="submit" class="btn btn-success mr-1">Novo Item</button>
    </div>
  </div>
</template>

<script>
import ResponsabilityItem from "./ResponsabilityItem"
import { fetchAll } from "@/api/person"

export default {
  components: {
    "s-responsability-item": ResponsabilityItem
  },
  props: {
    value: {
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
  computed: {
    responsableComputed: {
      get() {
        // Cria posições para os itens de modelo e ordena-os
        let count = 0
        return Object.values(this.value)
          .map(obj => {
            if (typeof obj.posicao === "undefined") {
              obj.posicao = count
              count += 1
            }
            return obj
          })
          .sort((a, b) => a.posicao - b.posicao)
      }
    }
  },
  methods: {
    fetchAllPeople() {
      fetchAll()
        .then((response) => {
          if (Object.prototype.hasOwnProperty.call(response.data, "_embedded")) {
            this.people = [...response.data._embedded.pessoas]
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
      const responsable = { ...this.value }
      const id = Math.floor((Math.random() * 10000000) + 1)
      responsable[id] = {
        id,
        pessoaId: "",
        tipo: "",
        posicao: Object.keys(this.value).length + 1
      }

      return responsable
    },
    /**
     * Chama a função que cria um novo modelo e atualiza o prop value
     * que é a coleção de modelos criados
     */
    handleAdd() {
      const responsableUpdated = this.createEmptyItem()
      this.$emit("input", responsableUpdated)
    },
    /**
     * Identifica que um modelo deve ser removido da coleção de modelos,
     * assim realiza o procedimento de remoção
     */
    handleRemove(item) {
      const responsableUpdated = { ...this.value }

      // Remove o modelo da coleção
      delete responsableUpdated[item.id]
      // Emite um evento alterando os dados do formulário
      this.$emit("input", responsableUpdated)
    }
  }
}
</script>

<style>

</style>