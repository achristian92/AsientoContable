<template>
    <div class="card app-content-body">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h3 class="text-primary d-flex">Planilla {{ file.name }}
                        <h4 v-if="file.status === 'Abierto'" @click.prevent="destroy(file.id)">
                            <a href="#"  data-toggle="tooltip" title="Eliminar">
                                <i class="fa fa-trash ml-2 text-danger"></i>
                            </a>
                        </h4>

                    </h3>

                </div>
                <div class="col text-right">
                    Estado:
                    <span class="badge badge-success" v-if="file.status === 'Abierto'">Abierto</span>
                    <span class="badge badge-danger" v-else>Cerrado</span>
                    <br>
                    <a href="#" @click.prevent="openPayroll"
                       class=""
                       v-if="file.status === 'Cerrado'">
                        <u>Abrir planilla</u>
                    </a>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-4">
                    <div class="card mb-0">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-block icon-block-floating mr-3 icon-block-lg icon-block-outline-primary  text-primary">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div>
                                    <h6 class="text-uppercase font-size-11">COLABORADORES</h6>
                                    <h4 class="mb-0 font-weight-bold">{{ payrolls.length }} </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-0">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-block icon-block-floating mr-3 icon-block-lg icon-block-outline-info  text-info">
                                    <i class="fa fa-list-ul"></i>
                                </div>
                                <div>
                                    <h6 class="text-uppercase font-size-11">+ CENTRO DE COSTO</h6>
                                    <h4 class="mb-0 font-weight-bold">{{ moreOneCosts }} Col.</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-0">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-block icon-block-floating mr-3 icon-block-lg icon-block-outline-danger  text-danger">
                                    !
                                </div>
                                <div>
                                    <h6 class="text-uppercase font-size-11">SIN CENTRO DE COSTO</h6>
                                    <h4 class="mb-0 font-weight-bold">{{ withoutCosts }} Col.</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row mb-2">
                <loading :active.sync="isLoading" :is-full-page="false"></loading>
                <div class="col-md-12 text-right">
                    <button type="button"
                            @click.prevent="submitSeats"
                            class="btn btn-sm btn-primary"
                            :disabled='!building'>
                        <i class="ti-settings mr-1 ml-1"></i> G.Asiento
                    </button>
                </div>
            </div>
            <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                <table class="table table-striped mb-0">
                    <thead>
                    <tr>
                        <th class="text-center">
                            <input class="form-check-input"
                                   v-model="allSelected"
                                   @click="handleAllChecked"
                                   style="margin-left: 2px;"
                                   type="checkbox">
                            <label class="form-check-label">
                                &nbsp;&nbsp;
                            </label>
                        </th>
                        <th>Nombres</th>
                        <th class="text-center">Ingresos</th>
                        <th class="text-center">Descuentos</th>
                        <th class="text-center">Aportes</th>
                        <th class="text-center">Neto</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="payroll in payrolls">
                        <td class="text-center">
                            <input class="form-check-input"
                                   v-model="payroll.checked"
                                   @change="checkedPayroll($event)"
                                   style="margin-left: 2px;"
                                   type="checkbox"
                                   :value="payroll.id">
                            <label class="form-check-label">
                                &nbsp;&nbsp;
                            </label>
                        </td>
                        <td>
                            {{ payroll.employee }} <span class="badge badge-danger" v-if="payroll.centerCost.length === 0">SIN CENTRO COSTO</span> <br>
                            <small class="text-muted">
                                <a href="#" class="text-muted" data-toggle="tooltip" :title="payroll.workArea+' | '+payroll.position">
                                    <i class="fa fa-id-card-o"></i>
                                </a>
                                <a href="#" class="text-muted" data-toggle="tooltip" :title="'Pension '+payroll.pension">
                                    <span class="ml-2">{{ payroll.pension }} </span>
                                </a>
                                <a href="#" class="text-muted" v-if="payroll.withFamily" data-toggle="tooltip" title="" data-original-title="Asignación familiar">
                                    <i class="fa fa-user-o ml-2"></i>
                                </a>
                                <a href="#" class="text-muted" v-if="payroll.centerCost.length > 1" data-toggle="tooltip" title="" data-original-title="Varios centros costos">
                                    <i class="fa fa-cogs ml-2"></i>
                                </a>
                            </small>
                        </td>
                        <td class="text-primary text-center">{{ payroll.totalIncome }}</td>
                        <td class="text-danger text-center">{{ payroll.totalExpense }}</td>
                        <td class="text-success text-center">{{ payroll.totalContribution }}</td>
                        <td class="text-info text-center">{{ payroll.netToPay }}</td>
                        <td class="text-right">
                            <a :href="`${baseUrl}admin/customer/${currentCustomerID}/payrolls/${payroll.file_id}/detail/${payroll.collaborator_id}`" data-toggle="tooltip" title="Detalle" data-original-title="Detalle">
                                <i class="fa fa-external-link"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</template>

<script>
import Loading from 'vue-loading-overlay'
import 'vue-loading-overlay/dist/vue-loading.css'
export default {
    components: {
        Loading,
    },
    data() {
        return {
            isLoading : false,
            file: '',
            payrolls: [],
            moreOneCosts: 0,
            withoutCosts: 0,
            checkedPayrolls: [],
            allSelected: false,
            showButtonBuild: false,
            errors  : [],
        }
    },
    props : ['p_file','p_payrolls','p_more_one_costs','p_without_costs'],
    created() {
        if (this.p_file)
            this.file = this.p_file
        if (this.p_payrolls)
            this.payrolls = this.p_payrolls
        if (this.p_more_one_costs)
            this.moreOneCosts = this.p_more_one_costs
        if (this.p_without_costs)
            this.withoutCosts = this.p_without_costs

        console.log(this.p_file)
    },
    computed: {
        building: function(){
            return (this.showButtonBuild && this.withoutCosts === 0 && this.file.status === 'Abierto');
        }
    },
    methods: {
        destroy(id) {
            if ( !confirm('Estas seguro de eliminar la planilla?') )
                return false;

            axios.delete(`${this.baseUrl}api/customer/${this.currentCustomerID}/payroll/${id}/destroy`).
            then(res => {
                Vue.$toast.success(res.data.msg)
                setTimeout(() => {
                    window.location.href = res.data.url;
                }, 1000)
            })
        },
        openPayroll() {
            if(confirm("Perderás toda la información cargada del mes si vuelves a cargar la planilla. Estas seguro de continuar?")) {
                axios.post(`${this.baseUrl}api/customer/${this.currentCustomerID}/open-payroll`, {
                    'file_id' : this.payrolls[0].file_id
                })
                .then(res => {
                    Vue.$toast.success(res.data.msg)
                    window.location.href = res.data.url;
                })
            }
          console.log("abrir planilla")
        },
        handleAllChecked() {
            if (!this.allSelected) {
                this.payrolls.map(item => item.checked = true);
                this.showButtonBuild = true
            }else{
                this.payrolls.map(item => item.checked = false);
                this.showButtonBuild = false
            }
        },
        checkedPayroll() {
            this.showButtonBuild = false;
            this.payrolls.map(item => {
                if (item.checked)
                    this.showButtonBuild = true
            });
            this.allSelected = false;
        },
        submitSeats() {
            this.isLoading = true

            let checkedIDS = []
            if (!this.allSelected)
                checkedIDS = this.payrolls.filter(item => item.checked).map(item => item.collaborator_id)

            axios.post(`${this.baseUrl}api/customer/${this.currentCustomerID}/generate-seating`, {
                'all' : this.allSelected,
                'employeeIDS' : checkedIDS,
                'file_id' : this.payrolls[0].file_id
            })
                .then(res => {
                    this.file = res.data.file
                    this.isLoading = false
                    Vue.$toast.success(res.data.msg)
                }).
            catch(error => {
                this.isLoading = false
                if (error.response.status === 422){
                    this.errors = error.response.data.errors;
                    Vue.$toast.error("Información inválida");
                }
                if (error.response.status === 401) {
                    Vue.$toast.error(error.response.data.msg);
                }
            });


        }
    }
}
</script>

<style scoped>

</style>
