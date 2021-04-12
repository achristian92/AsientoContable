<template>
    <div class="card app-content-body">
        <loading :active.sync="isLoading" :is-full-page="false"></loading>
        <div class="card-body">
            <H4>Boletas  {{ file.name }}</H4>
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
                                    <h4 class="mb-0 font-weight-bold">{{ employees.length }} </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                <table class="table table-striped mb-0">
                    <thead>
                    <tr>
                        <th>Nombres</th>
                        <th>Nro Documento</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="employee in employees">
                        <td>{{ employee.worked }}</td>
                        <td>{{ employee.nroDoc }}</td>
                        <td class="text-right">
                            <a :href="`${baseUrl}api/customer/${currentCustomerID}/vouchers/${employee.file}/download/${employee.id}`" data-toggle="tooltip" title="Descargar boleta" data-original-title="Descargar boleta">
                                <i class="fa fa-download"></i>
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
            file : '',
            employees: [],
            errors  : [],
        }
    },
    props : ['p_employees','p_file'],
    created() {
        if (this.p_employees)
            this.employees = this.p_employees
        if (this.p_file)
            this.file = this.p_file
    },
    methods: {

    }
}
</script>

<style scoped>

</style>
