<template>
  <div class="contract--show">
    <div class="contract--show_contract_file">
      <div class="contract--show_contract_title">
        <h5>Contrato Social</h5>
      </div>
      <div class="d-flex justify-content-center mb-3">
        <embed id="contract_file" type="application/pdf" :src="file.src" width="100%" height="500px" />
      </div>
    </div>

    <div class="contract--show_company">
      <div class="contract--show_company-title">
        <h5>Dados da Empresa</h5>
      </div>
      <div class="form-group">
        <label for="corporate_name">Rasão Social</label>
        <input id="corporate_name" class="form-control" type="text" :value="company.corporate_name" disabled>
      </div>
      
      <div class="form-group">
        <label for="cnpj">CNPJ</label>
        <input id="cnpj" class="form-control" type="text" :value="company.cnpj" disabled>
      </div>
    </div>
    <div class="contract--show_responsibles mb-3">
      <h5>
        Responsáveis
      </h5>
      <div role="tablist">
        <b-card v-for="(responsiblePerson, index) in responsible" :key="index" no-body class="mb-1">
          <b-card-header header-tag="header" class="p-1" role="tab">
            <b-button block v-b-toggle="index" variant="info">{{ responsiblePerson.name }}</b-button>
          </b-card-header>
          <b-collapse :id="index" accordion="my-accordion" role="tabpanel">
            <b-card-body>
              <b-card-text><h6>Responsabilidades:</h6></b-card-text>
              <b-card-text>
                <ul class="list-group">
                  <li class="list-group-item"
                    v-for="(responsibility, index) in responsiblePerson.responsibilities"
                    :key="index">
                    {{ getResponsibilityName(responsibility.type) }}
                  </li>
                </ul>
              </b-card-text>
            </b-card-body>
          </b-collapse>
        </b-card>
      </div>
    </div>

    <div class="form-group d-flex flex-wrap flex-lg-nowrap">
      <button type="button" class="btn btn-success mr-lg-2 mb-lg-0 mb-2 w-100" @click="submitValidate">Validar</button>
      <button type="button" class="btn btn-danger w-100" @click="cancel">Cancelar</button>
    </div>
  </div>
</template>

<script>
import { fetch, validate, fetchFile } from "@/api/contract"

export default {
  props: {
    contractId: {
      type: String,
      required: true,
      default: "0"
    }
  },
  data() {
    return {
      responsible: {},
      company: {},
      file: {
        file_path: "",
        src: ""
      }
    }
  },
  mounted() {
    this.getContractData()
  },
  methods: {
    /**
     * Busca os dados referêntes ao contrato social
     */
    getContractData() {
      fetch(this.contractId)
        .then((response) => {
          this.responsible = { ...response.data.responsible }
          this.company = { ...response.data.company }
          this.file.file_path = response.data.file
          // Busca e mostra o arquivo
          this.getContractFile()
        })
        .catch((error) => {
          this.$toasted.error(error.response.data.detail)
        })
    },
    /**
     * Realiza uma requisição AJAX para retornar o arquivo PDF
     * do Contrato Social e o mostrar em uma tag embed
     */
    getContractFile() {
      fetchFile(this.contractId, { isFile: true, file_path: this.file.file_path })
        .then((response) => {
          const url = window.URL.createObjectURL(response.data)
          this.file.src = url
          this.$forceUpdate()
        })
        .catch((error) => {
          this.$toasted.error(error.response.data.detail)
        })

    },
    /**
     * Valida a instância de Contrato Social e seus
     * responsáveis
     */
    submitValidate() {
      validate(this.contractId)
        .then((response) => {
          this.$toasted.success(response.data.message)
          this.$router.push({ path: "/contract" })
        })
        .catch((error) => {
          this.$toasted.error(error.response.data.detail)
        })
    },
    /**
     * Cancela a validação do Contrato Social, voltando para
     * a última página do histórico
     */
    cancel() {
      this.$router.go(-1)
    },
    /**
     * Retorna o nome da responsabilidade de acordo
     * com seu tipo
     */
    getResponsibilityName(type) {
      let name = ""
      switch (type) {
      case "A":
        name = "Administrador"
        break
      case "C":
        name = "Cotista"
        break
      case "S":
        name = "Sócio"
        break
      default:
        name = "Responsável Legal"
        break
      }

      return name
    }
  }
}
</script>

<style>

</style>