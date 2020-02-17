<template>
	<div class="custom--table">
		<b-table
			:items="value"
			:fields="fields"
			responsive>

			<template v-if="actions.length > 0" v-slot:cell(actions)="row">
				<button
					v-for="(action, index) in actions"
					:key="index"
					@click="emitAction(action.event, row)"
					type="button"
					class="btn btn-danger">
					<i :class="action.icon"></i>
				</button>
      </template>
		</b-table>

		<div class="form-group">
			<b-pagination
				v-model="pagination.currentPage"
				:total-rows="pagination.totalRows"
				:per-page="pagination.perPage"
				align="fill"
				size="sm"
				class="my-0"/>
		</div>
	</div>
</template>

<script>
export default {
  props: {
    value: {
      type: Array,
      required: true,
      default () {
        return []
      }
    },
    fields: {
      type: Array,
      required: true,
      default() {
        return []
      }
    },
    pagination:{
      type: Object,
      required: true,
      default() {
        return {
          totalRows: 0,
          currentPage: 1,
          perPage: 25
        }
      }
    },
    actions: {
      type: Array,
      required: false,
      default() {
        return []
      }
    }
  },
  data() {
    return {}
  },
  methods: {
    /**
		 * Emite uma ação de acordo com os objetos
		 * contidos dentro do prop actions
		 */
    emitAction(action, tableRow) {
      this.$emit(action, tableRow.item)
    }
  }
}
</script>

<style>

</style>