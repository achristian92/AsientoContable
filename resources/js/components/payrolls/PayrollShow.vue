<template>
    <div class="card app-content-body">
        <div class="card-body">
            <div class="app-action mb-0">
                <div class="action-left">
                    <ul class="list-inline">
                        <li class="list-inline-item mb-0">
                            <a href="#" class="btn btn-outline-light dropdown-toggle" data-toggle="dropdown">
                                Ordenar por
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Nombres</a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="action-right">
                    <form class="d-flex mr-3">
                        <a href="#" class="app-sidebar-menu-button btn btn-outline-light">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                        </a>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search file" aria-describedby="button-addon1">
                            <div class="input-group-append">
                                <button class="btn btn-outline-light" type="button" id="button-addon1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-12 text-right">
                    <button type="button"
                            @click.prevent="submitSeats"
                            class="btn btn-sm btn-primary"
                            :disabled='isDisabled'>
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
                        <th class="text-center">Egresos</th>
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
                            {{ payroll.employee }} <br>
                            <small>
                                <a href="#" data-toggle="tooltip" :title="payroll.workArea+' | '+payroll.position">
                                    <i class="fa fa-id-card-o"></i>
                                </a>
                                <a href="#" data-toggle="tooltip" :title="'Pension '+payroll.pension">
                                    <span class="ml-2">{{ payroll.pension }} </span>
                                </a>
                                <a href="#" v-if="payroll.withFamily" data-toggle="tooltip" title="" data-original-title="Asignación familiar">
                                    <i class="fa fa-user-o ml-2"></i>
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

export default {
    components: {
        Loading,
    },
    data() {
        return {
            isLoading : false,
            payrolls: [],
            errors  : [],
            checkedPayrolls: [],
            allSelected: false,
            showButtonBuild: false
        }
    },
    props : ['p_payrolls'],
    created() {
        if (this.p_payrolls)
            this.payrolls = this.p_payrolls

        console.log(this.baseUrl)
    },
    computed: {
        isDisabled: function(){
            return !this.showButtonBuild;
        }
    },
    methods: {
        handleAllChecked() {
            if (!this.allSelected) {
                this.payrolls.forEach(function(item) {
                    item.checked = true;
                });
                this.showButtonBuild = true
            }else{
                this.payrolls.forEach(function(item){
                    item.checked = false;
                });
                this.showButtonBuild = false
            }
        },
        checkedPayroll() {
            this.showButtonBuild = false;
            this.payrolls.forEach(item => {
                if(item.checked){
                    this.showButtonBuild = true
                }
            });
            this.allSelected = false;
        },
        submitSeats() {
            let checkedIDS = this.payrolls.filter(item => item.checked)
                                          .map(item => item.id)

        }
    }
}
</script>

<style scoped>

</style>
