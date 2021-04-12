<template>
    <div class="modal fade" id="AssignCostModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AssignProviderModalLabel">Asignación</h5>
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
                                    v-model="collaborator_id"
                                    required>
                                <option value="" disabled="true">Seleccionar...</option>
                                <option v-for="employee in employees" :value="employee.id">{{employee.full_name}}</option>
                            </select>
                        </div>
                        <div class="col-md-12 text-right">
                            <a href="" @click.prevent="add" class="font-size-12">
                                + Agregar Centro Costo
                            </a>
                        </div>

                        <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                            <table class="table table-striped">
                                <thead>
                                <tr class="text-uppercase font-size-11 text-muted">
                                    <th>Centro Costo</th>
                                    <th>Porcentaje</th>
                                    <th class="text-right"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(value,index) in assigns">
                                    <td>
                                        <select
                                            class="form-control form-control-sm"
                                            v-model="value.cost_id">
                                            <option disabled value="">Seleccionar...</option>
                                            <option v-for="cost in costs" :value="cost.id">{{ cost.code }} - {{ cost.name }}</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text"
                                               min="1"
                                               class="form-control form-control-sm"
                                               v-model="value.percentage">
                                    </td>
                                    <td>
                                        <a href="" @click.prevent="remove(index)" class="btn btn-outline-light btn-sm">
                                            <small>x</small>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td class="text-right"><a href="">Total</a> </td>
                                    <td class="text-left">{{ total }}%</td>
                                    <td></td>
                                </tr>
                                </tfoot>
                            </table>
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-link" data-dismiss="modal">Cerrar
                            </button>
                            <button type="submit" class="btn btn-primary" :disabled="total !== 100">Guardar</button>
                        </div>
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
            assigns   : [],
      collaborator_id : '',
            file_id   : '',
            errors    : []
        }
    },
    computed: {
        total() {
            let total = 0
            if (this.assigns.length > 0)
                total = this.assigns.reduce(function (prev, next) {
                    return prev + parseFloat(next.percentage)
                },0)
            return this.redondearDecimales(total,2)
        }
    },
    created() {
        this.loadData()
        EventBus.$on('openAssign',data => this.open(data))
        EventBus.$on('editAssign',data => this.edit(data))
    },
    methods: {
        remove(index) {
            this.assigns.splice(index,1);
        },
        add() {
            this.assigns.push({
                id         : '',
                cost_id    : '',
                percentage : 0,
            })
        },
        loadData() {
            this.getCostCenters()
            this.add()
        },
        getEmployees(file) {
            axios.get(`${this.baseUrl}api/customer/${this.currentCustomerID}/file/${file}/employees-without-costs`)
                .then(res =>  this.employees = res.data.employees )
        },
        getCostCenters() {
            axios.get(`${this.baseUrl}api/customer/${this.currentCustomerID}/costs`)
                .then(res => this.costs = res.data.costs)
        },
        submitAssign() {
            let data = {
                'costs' : {...this.assigns},
                'collaborator_id': this.collaborator_id,
                'file_id'    : this.file_id
            }
            axios.post(`${this.baseUrl}api/customer/${this.currentCustomerID}/assign-cost`,data)
                .then(res => {
                    if (res.data.status === false) {
                        Vue.$toast.error(res.data.msg)
                        return '';
                    }

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
            this.getEmployees(data.fileCost.id)
            this.resetModal()
            this.file_id = data.fileCost.id
            $('#AssignCostModal').modal('show')
        },
        edit(data) {
            this.getEmployees(data.file_id)
            this.resetModal()
            this.collaborator_id = data.collaborator_id
            this.file_id = data.file_id
            this.assigns = data.assigns
            $('#AssignCostModal').modal('show')
        },
        resetModal() {
            this.errors   = []
            this.collaborator_id = ''
            this.file_id = ''
        },
        redondearDecimales(numero, decimales) {
            let numeroRegexp = new RegExp('\\d\\.(\\d){' + decimales + ',}');
            if (numeroRegexp.test(numero))
                return Number(numero.toFixed(decimales));
             else
                return Number(numero.toFixed(decimales)) === 0 ? 0 : numero;

        }
    }

}
</script>

<style scoped>

</style>
