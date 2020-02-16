<template>
  <div class="reponsability--item form-inline w-100 h-100 p-2 justify-content-between">
    <div class="form-group mb-2">
      <label class="mr-2" :for="prop + '[person_id]'">Pessoa</label>
      <select
        v-model="value.person_id"
        :class="{ 'is-invalid':  hasError('person_id') }"
        class="form-control"
        :id="prop + '[person_id]'">
        <option value="" selected>Selecione o responsável</option>
        <option
          v-for="(person, index) in people"
          :key="index" :value="person.value">
          {{ person.text }}
        </option>
      </select>
      <div v-for="(message, index) in getErrorMessages('person_id')" :key="index" class="invalid-feedback">
        {{ message }}
      </div>
    </div>

    <div class="form-group mx-lg-3 mb-2">
      <label class="mr-2" :for="prop + '[type]'">Responsabilidade</label>
      <select
        v-model="value.type"
        :class="{ 'is-invalid':  hasError('type') }"
        class="form-control"
        :id="prop + '[type]'">
        <option value="" selected>Selecione a responsabilidade</option>
        <option
          v-for="(responsability, index) in responsabilities"
          :key="index" :value="responsability.value">
          {{ responsability.text }}
        </option>
      </select>
      <div v-for="(message, index) in getErrorMessages('type')" :key="index" class="invalid-feedback">
        {{ message }}
      </div>
    </div>

    <div class="form-group mx-xl-3 mb-2">
      <button @click="emitRemove" type="button" class="btn btn-danger">
        <i class="fas fa-trash-alt"></i>
      </button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    prop: {
      type: String,
      required: true,
      default: "identifier"
    },
    value: {
      type: Object,
      required: true,
      default() {
        return {
          id: "",
          person_id: "",
          type: "",
          position: 0
        }
      }
    },
    people: {
      type: Array,
      required: true,
      default() {
        return []
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
      responsabilities: [
        { value: "S", text: "Sócio" },
        { value: "C", text: "Cotista" },
        { value: "A", text: "Administrador" },
        { value: "RL", text: "Responsável Legal" }
      ]
    }
  },
  methods: {
    emitRemove() {
      this.$emit("delete", this.value)
    },
    /**
     * Verifica se há mensagens de erro para a propriedade
     * a qual o input está vinculada
     */
    hasError(property) {
      return Object.prototype.hasOwnProperty.call(this.error, this.prop)
        && Object.prototype.hasOwnProperty.call(this.error[this.prop], property)
    },
    /**
     * Retorna as mensagens de erro da propriedade em questão
     */
    getErrorMessages(property) {
      return Object.prototype.hasOwnProperty.call(this.error, this.prop)
        ? this.error[this.prop][property] : {}
    }
  }
}
</script>

<style lang="scss" scoped>
  .reponsability--item {
    box-shadow: 0 2px 12px 0 rgba(0,0,0,.1);
  }
</style>
