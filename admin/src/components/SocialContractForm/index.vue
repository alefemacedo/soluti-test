<template>
  <div class="social-contract--form border rounded p-2">
    <div class="social-contract--form_upload">
      <div class="form-group">
        <label for="file">Importar contrato social</label>
        <input
          id="file"
          :class="{ 'is-invalid':  hasError('file') }"
          @change="handleFile"
          type="file"
          accept="application/pdf"
          class="form-control-file"/>
        <div v-for="(message, index) in getErrorMessages('file')" :key="index" class="invalid-feedback">
          {{ message }}
        </div>
      </div>
    </div>

    <div class="social-contract--form_responsible">
      <div class="responsible--title">
        Responsáveis
      </div>
      <s-responsibility-manager :error="error" v-model="responsibleCollection" />
    </div>
  </div>
</template>

<script>
import ResponsibilityManager from "./components/ResponsibilityManager"

export default {
  components: {
    "s-responsibility-manager": ResponsibilityManager
  },
  props: {
    value: {
      type: Object,
      required: true,
      default() {
        return {
          file: "",
          userFile: "",
          responsible: {}
        }
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
    return {}
  },
  computed: {
    /**
     * Computed property para permitir alteração
     * do prop value de modo indireto
     */
    responsibleCollection: {
      get() {
        return this.value.responsible
      },
      set(value) {
        const form = {...this.value }
        form.responsible = value
        this.$emit("input", form)
      }
    }
  },
  methods: {
    /**
     * Trata o evento de quando o arquivo do contrato
     * social é selecionado
     */
    handleFile(input) {
      const form = { ...this.value }
      form.file = input.target.files[0]
      form.userFile = this.$store.getters.userId
      this.$emit("input", form)
    },
    /**
     * Verifica se há mensagens de erro para a propriedade
     * a qual o input está vinculada
     */
    hasError(property) {
      return Object.prototype.hasOwnProperty.call(this.error, property)
    },
    /**
     * Retorna as mensagens de erro da propriedade em questão
     */
    getErrorMessages(property) {
      return this.error[property]
    }
  }
}
</script>

<style>

</style>