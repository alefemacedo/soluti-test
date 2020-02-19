<template>
  <div class="contracts--list">
    <div class="contracts--list_title">
      <h1 class="display-4">Contratos Sociais</h1>
    </div>

    <div class="contracts--list_filter-form">
			<div class="form-group">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <select v-model="filter.type" class="custom-select" @change.prevent="handleFilter">
              <option value="cnpj">CNPJ</option>
              <option value="corporate_name">Rasão Social</option>
            </select>
          </div>

          <input
            v-model="filter.value"
            @input="handleFilter"
            type="text"
            class="form-control"/>
        </div>
			</div>
		</div>

    <s-paginated-table
      v-model="tableData"
      :fields="tableFields"
      :actions="tableActions"
      :pagination="pagination"
      @show="showContract"/>
  </div>
</template>

<script>
import PaginatedTable from "@/components/PaginatedTable"
import { fetchAll } from "@/api/contract"

export default {
  components: {
    "s-paginated-table": PaginatedTable
  },
  data() {
    return {
      pagination: {
        totalRows: 0,
        currentPage: 1,
        perPage: 25
      },
      filter: {
        type: "cnpj",
        value: ""
      },
      delayFilter: null,
      tableData: [],
      tableFields: [
        { key: "filename", label: "Arquivo" },
        { key: "size", label: "Tamanho" },
        {
          key: "user_name",
          label: "Usuário",
          formatter: (value, key, item) => {
            return item._embedded.user._embedded.person.name
          }
        },
        { 
          key: "corporate_name", 
          label: "Rasão Social",
          formatter: (value, key, item) => {
            return item._embedded.company.corporateName
          }
        },
        { 
          key: "cnpj", 
          label: "CNPJ",
          formatter: (value, key, item) => {
            return item._embedded.company.cnpj
          }
        },
        { key: "actions", label: "Ações" }
      ],
      tableActions: [
        { event: "show", icon: "far fa-eye" }
      ]
    }
  },
  mounted() {
    this.getPaginatedContracts()
  },
  watch: {
    "pagination.currentPage": function () {
      this.handleCurrentChange()
    }
  },
  methods: {
    async getPaginatedContracts() {
      const params = {
        page: this.pagination.currentPage,
        cnpj: this.filter.type === "cnpj" ? this.filter.value : "",
        corporate_name: this.filter.type === "corporate_name" ? this.filter.value : ""
      }

      await fetchAll(params)
        .then((response) => {
          if (Object.prototype.hasOwnProperty.call(response.data, "_embedded")) {
            this.pagination.totalRows = response.data.total_items
            this.pagination.perPage = response.data.page_size
            this.tableData = [...response.data._embedded.contracts]
          }
        })
        .catch((error) => {
          this.$toasted.error(error.response.data.detail)
        })
    },
    /**
     * Redireciona para a view que irá mostrar os dados
     * do contrato social, como o arquivo PDF renderizado
     * e os responsáveis descrito neste
     */
    showContract(contract) {
      this.$router.push({ path: "/contract/show/" + contract.id })
    },
    /**
     * Identifica uma mudança de paginação
     */
    handleCurrentChange() {
      this.getPaginatedContracts()
    },
    /**
     * Identifica uma filtragem dos dados
     */
    handleFilter() {
      this.pagination.currentPage = 1
      clearTimeout(this.delayFilter)
      this.delayFilter = setTimeout(() => {
        this.handleCurrentChange()
      }, 500)
    }
  }
}
</script>

<style>

</style>