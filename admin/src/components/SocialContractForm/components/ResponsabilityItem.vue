<template>
  <div class="reponsability--item form-inline w-100 h-100 p-2 justify-content-between">
    <div class="form-group mb-2">
      <label class="mr-2" for="pessoa">Pessoa</label>
      <select v-model="value.pessoaId" class="form-control" id="pessoa">
        <option value="" selected>Selecione o responsável</option>
        <option
          v-for="(person, index) in people"
          :key="index" :value="person.value">
          {{ person.text }}
        </option>
      </select>
    </div>

    <div class="form-group mx-lg-3 mb-2">
      <label class="mr-2" for="responsabilidade">Responsabilidade</label>
      <select v-model="value.tipo" class="form-control" id="responsabilidade">
        <option value="" selected>Selecione a responsabilidade</option>
        <option
          v-for="(responsability, index) in responsabilities"
          :key="index" :value="responsability.value">
          {{ responsability.text }}
        </option>
      </select>
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
  components: {
  },
  props: {
    value: {
      type: Object,
      required: true,
      default() {
        return {
          id: "",
          pessoaId: "",
          type: "",
          posicao: 0
        }
      }
    },
    people: {
      type: Array,
      required: true,
      default() {
        return []
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
    }
  }
}
</script>

<style lang="scss" scoped>
  .reponsability--item {
    box-shadow: 0 2px 12px 0 rgba(0,0,0,.1);
  }
</style>
