<template>
  <div class="contract--show">
    Mostra os dados de um contrato social
    ID: {{ contractId }}
  </div>
</template>

<script>
import { fetch } from "@/api/contract"

export default {
  props: {
    contractId: {
      type: String,
      required: true,
      default: "0"
    }
  },
  mounted() {
    this.getContractData()
  },
  methods: {
    getContractData() {
      fetch({}, this.contractId)
        .then((response) => {
          console.log(response)
        })
        .catch((error) => {
          console.log(error)
        })
    }
  }
}
</script>

<style>

</style>