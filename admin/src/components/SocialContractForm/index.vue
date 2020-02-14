<template>
  <div class="social-contract--form border rounded p-2">
    <div class="social-contract--form_upload">
      <div class="form-group">
        <label for="exampleFormControlFile1">Importar contrato social</label>
        <input type="file" class="form-control-file" id="exampleFormControlFile1">
      </div>
    </div>

    <div class="social-contract--form_responsable">
      <div class="responsable--title">
        Responsáveis
      </div>

      <s-responsability-manager v-model="responsableCollection" />
    </div>
  </div>
</template>

<script>
import ResponsabilityManager from "./components/ResponsabilityManager"

export default {
  components: {
    "s-responsability-manager": ResponsabilityManager
  },
  props: {
    value: {
      type: Object,
      required: true,
      default() {
        return {
          arquivo: "",
          responsaveis: {}
        }
      }
    }
  },
  data() {
    return {
      responsaveis: {}
    }
  },
  computed: {
    responsableCollection: {
      get() {
        return this.value.responsaveis
      },
      set(value) {
        const form = {...this.value }
        form.responsaveis = value
        this.$emit("input", form)
      }
    }
  }
}
</script>

<style>

</style>