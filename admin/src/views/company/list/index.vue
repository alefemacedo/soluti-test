<template>
  <div class="container">
    <div class="companies--list_title">
      <h1 class="display-4">Empresas</h1>
    </div>

    <div class="companies--list_filter-form">
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
      @edit="editCompany"/>
  </div>
</template>

<script>
import PaginatedTable from "@/components/PaginatedTable"
import { fetchAll } from "@/api/company"

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
        { key: "corporateName", label: "Rasão Social" },
        { key: "name", label: "Nome Fantasia" },
        { key: "cnpj", label: "CNPJ" },
        { key: "actions", label: "Ações" }
      ],
      tableActions: [
        { event: "edit", icon: "far fa-edit" }
      ]
    }
  },
  mounted() {
    this.getPaginatedCompanies()
  },
  watch: {
    "pagination.currentPage": function () {
      this.handleCurrentChange()
    }
  },
  methods: {
    async getPaginatedCompanies() {
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
            this.tableData = [...response.data._embedded.companies]
          }
        })
        .catch((error) => {
          this.$toasted.error(error.response.data.detail)
        })
    },
    /**
     * Redireciona para a view que irá permitir alterar
     * os dados da empresa
     */
    editCompany(company) {
      this.$router.push({ path: "/company/edit/" + company.id })
    },
    /**
     * Identifica uma mudança de paginação
     */
    handleCurrentChange() {
      this.getPaginatedCompanies()
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