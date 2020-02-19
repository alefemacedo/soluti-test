<template>
  <b-modal v-model="valueComputed" hide-footer id="person-modal" title="Cadastro de Pessoa">
    <form @submit.prevent="submit">
      <div class="form-group">
        <s-validated-input
          v-model="form.name"
          :messages="error"
          id="name"
          label="Nome"
          placeholder="Por favor informe o nome da pessoa"/>
      </div>
      <div class="form-group">
        <s-validated-input
          v-model="form.cpf"
          :messages="error"
          id="cpf"
          label="CPF"
          placeholder="Por favor informe o cpf da pessoa"/>
      </div>
      <div slot="modal-footer" class="form-group d-flex justify-content-end">
        <button type="submit" class="btn btn-success mr-2">Salvar</button>
        <button type="button" class="btn btn-danger" @click.prevent="cancel">Cancelar</button>
      </div>
    </form>
  </b-modal>
</template>

<script>
import ValidatedInput from "@/components/ValidatedInput"
import { create } from "@/api/person"

export default {
  components: {
    "s-validated-input": ValidatedInput
  },
  props: {
    value: {
      type: Boolean,
      required: true,
      default: false
    }
  },
  data() {
    return {
      error: {},
      form: {
        name: "",
        cpf: ""
      }
    }
  },
  computed: {
    valueComputed: {
      get() {
        return this.value
      },
      set(value) {
        this.$emit("input", value)
      }
    }
  },
  methods: {
    /**
     * Limpa o formulário e as mensagens de erro
     */
    clear() {
      this.form = {
        name: "",
        cpf: ""
      }
      this.error = {}
    },
    /**
     * Submita os dados do formulário, criando uma
     * nova instância de Pessoa no banco de dados
     */
    submit() {
      console.log("submit")
      create(this.form)
        .then((response) => {
          this.$toasted.success(response.data.message)
          this.clear()
          this.valueComputed = false
        })
        .catch((error) => {
          if (error.response.status === 422) {
            this.error = { ... error.response.data.validation_messages }
            this.$toasted.error("Por favor corrija os erros no formulário")
          } else {
            this.$toasted.error(error.response.data.detail)
          }
        })
    },
    /**
     * Cancela o cadastro de Pessoa, limpando o
     * formulário e fechando o modal
     */
    cancel() {
      this.clear()
      this.valueComputed = false
    }
  }
}
</script>

<style>

</style>