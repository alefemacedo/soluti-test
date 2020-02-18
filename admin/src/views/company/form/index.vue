<template>
  <div class="container company--form">
    <div class="company--form_title">
      <h1 v-if="parseInt(companyId) > 0" class="display-4">
        Alterar Empresa
      </h1>
      <h1 v-else class="display-4">
        Cadastro de Empresa
      </h1>
    </div>
    <form class="border rounded p-2" @submit.prevent="submit">
      <s-validated-input
        v-model="form.name"
        :messages="error"
        label="Nome Fantasia"
        id="name"
        placeholder="Por favor informe o nome fantasia da empresa"/>
      
      <s-validated-input
        v-model="form.corporate_name"
        :messages="error"
        label="Rasão Social"
        id="corporate_name"
        placeholder="Por favor informe a rasão social da empresa"/>
      
      <s-validated-input
        v-model="form.cnpj"
        :messages="error"
        label="CNPJ"
        id="cnpj"
        placeholder="Por favor informe o CNPJ da empresa"/>      

      <div class="social-contract--form_title mb-2">
        <h4>Cadastro do Contrato Social</h4>
      </div>

      <s-social-contract-form :error="error" v-model="socialContractComputed" />

      <div class="form-group d-flex justify-content-end mt-3">
        <button type="submit" class="btn btn-primary mr-1">Registrar</button>
        <button @click="cancel" type="button" class="btn btn-danger">Cancelar</button>
      </div>
    </form>
  </div>
</template>

<script>
import ValidatedInput from "@/components/ValidatedInput"
import SocialContractForm from "@/components/SocialContractForm"
import { create, fetch, update } from "@/api/company"

export default {
  props: {
    companyId: {
      type: String,
      required: false,
      default: "0"
    }
  },
  components: {
    "s-validated-input": ValidatedInput,
    "s-social-contract-form": SocialContractForm
  },
  data() {
    return {
      form: {},
      error: {}
    }
  },
  beforeMount() {
    if (parseInt(this.companyId) !== 0) {
      this.getCompanyData()
    } else {
      this.initializeForm()
    }
  },
  computed: {
    socialContractComputed: {
      get() {
        return this.form.social_contract
      },
      set(value) {
        this.form.social_contract = value
      }
    }
  },
  methods: {
    /**
     * Inicializa o objeto que representa o formulário
     */
    initializeForm() {
      this.form = {
        name: "",
        corporate_name: "",
        cnpj: "",
        social_contract: {
          file: "",
          userFile: "",
          responsible: {}
        }
      }
    },
    /**
     * Busca os dados de uma empresa no backend
     * de acordo com o ID passado no prop da rota
     */
    getCompanyData() {
      fetch(this.companyId)
        .then((response) => {
          if(Object.prototype.hasOwnProperty.call(response.data, "_embedded")) {
            this.form = {
              name: response.data._embedded.company.name,
              corporate_name: response.data._embedded.company.corporateName,
              cnpj: response.data._embedded.company.cnpj,
              social_contract: {
                file: "",
                userFile: "",
                responsible: {}
              }
            }

            // Verifica se a instância retornada possui definições
            // dos responsáveis descritos no contrato social
            if (Object.prototype.hasOwnProperty.call(response.data, "responsible")) {
              this.form.social_contract.responsible = { ...response.data.responsible }
            }
          }          
        })
        .catch((error) => {
          this.$toasted.error(error.response.data.detail)
        })
    },
    /**
     * Limpa o formulário e redireciona para a página
     * anterior
     */
    cancel() {
      this.initializeForm()
      this.$router.go(-1)
    },
    /**
     * Realiza submit do formulário para cadastrar
     * a empresa
     */
    submit() {
      let formData = new FormData()
      formData.append("name", this.form.name)
      formData.append("corporate_name", this.form.corporate_name)
      formData.append("cnpj", this.form.cnpj)
      formData.append("responsible", JSON.stringify(this.form.social_contract.responsible))
      formData.append("file", this.form.social_contract.file)
      formData.append("userFile", this.form.social_contract.userFile)

      if (parseInt(this.companyId) == 0) {
        create(formData)
          .then((response) => {
            this.$toasted.success(response.data.message)
            this.$router.go(-1)
          })
          .catch((error) => {
            if (error.response.status === 422) {
              this.error = { ...error.response.data.validation_messages }
              this.$toasted.error("Por favor corrija os erros no formulário!")
            } else {
              this.$toasted.error(error.response.data.detail)
            }
          })
      } else {
        update(formData, this.companyId)
          .then((response) => {
            this.$toasted.success(response.data.message)
            this.$router.go(-1)
          })
          .catch((error) => {
            if (error.response.status === 422) {
              this.error = { ...error.response.data.validation_messages }
              this.$toasted.error("Por favor corrija os erros no formulário!")
            } else {
              this.$toasted.error(error.response.data.detail)
            }
          })
      }
    }
  }
}
</script>

<style>
 .company--form {
   height: 100%;
 }
</style>