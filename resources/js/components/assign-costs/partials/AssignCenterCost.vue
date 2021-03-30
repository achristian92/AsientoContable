<template>
    <div class="modal fade" id="AssignCostModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AssignProviderModalLabel">Asignar Centro de Costo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ti-close"></i>
                    </button>
                </div>
                <form @submit.prevent="submitAssign">
                    <div class="modal-body">
                        <validation-errors :errors="errors" v-if="errors"></validation-errors>
                        <div class="form-group">
                            <label for="AssignProvider" class="col-form-label">Colaborador</label>
                            <select class="form-control form-control-sm"
                                    id="AssignProvider"
                                    v-model="formData.collaborator_id"
                                    required>
                                <option value="" disabled="true">Seleccionar...</option>
                                <option v-for="employee in employees" :value="employee.id">{{employee.full_name}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="currency">Centro de costos</label>
                            <select class="form-control form-control-sm"
                                    id="currency"
                                    v-model="formData.cost_id">
                                <option disabled value="">Seleccione</option>
                                <option v-for="cost in costs" :value="cost.id">{{ cost.code }} - {{ cost.name }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="percentage">Porcentage</label>
                            <input type="text"
                                   id="percentage"
                                   class="form-control form-control-sm"
                                   v-model="formData.percentage"
                                   required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-link" data-dismiss="modal">Cerrar
                        </button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import EventBus from "../../../event-bus";

export default {
    data() {
        return {
            isEdit    : false,
            employees : [],
            costs     : [],

            formData : {
                id          : '',
                collaborator_id : '',
                cost_id    : '',
                percentage : '',
                month_cost_id: ''
            },
            errors        : []
        }
    },
    created() {
        this.loadData()
        EventBus.$on('openAssign',data => this.open(data))
        EventBus.$on('openEditAssignProvider',data => this.edit(data))
    },
    watch: {

    },
    methods: {
        loadData() {
            this.getEmployees()
            this.getCostCenters()
        },
        getEmployees() {
            axios.get(`${this.baseUrl}api/customer/${this.currentCustomerID}/employees`)
                .then(res =>  this.employees = res.data.employees )
        },
        getCostCenters() {
            axios.get(`${this.baseUrl}api/customer/${this.currentCustomerID}/costs`)
                .then(res => this.costs = res.data.costs)
        },

        submitAssign() {
            axios.post(`${this.baseUrl}api/customer/${this.currentCustomerID}/assign-cost`,this.formData)
                .then(res => {
                    $('#AssignCostModal').modal('hide');
                    EventBus.$emit('updateAssign', {assign: res.data.assign});
                    Vue.$toast.success(res.data.msg)
                    this.resetModal()
                })
                .catch(error => {
                    if (error.response.status === 422){
                        this.errors = error.response.data.errors;
                        Vue.$toast.error("Información inválida");
                    }
                    if (error.response.status === 401) {
                        Vue.$toast.error(error.response.data.msg);
                    }
                });
        },
        open(data) {
            this.resetModal()
            this.formData.month_cost_id = data.monthCost.id
            $('#AssignCostModal').modal('show')
        },
        edit(data) {

        },
        resetModal() {
            this.errors   = []
            this.formData = {
                id          : '',
                collaborator_id : '',
                cost_id    : '',
                percentage : '',
            }
        }


    }
}
</script>

<style scoped>

</style>
