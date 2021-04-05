<template>
    <div class="card app-content-body">
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-12 text-right">
                    <button type="button"
                            @click.prevent="openAssign"
                            class="btn btn-sm btn-primary">
                        <i class="ti-plus mr-1 ml-1"></i> Asignar
                    </button>
                </div>
            </div>
            <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                <table class="table table-striped mb-0">
                    <thead>
                    <tr>
                        <th>Trabajador</th>
                        <th class="text-center"># costos</th>
                        <th class="text-center">Porcentaje</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="assign in assigns">
                        <td>
                            {{ assign.worked }} <br>
                        </td>
                        <td class="text-center">{{ assign.qtyCosts }}</td>
                        <td class="text-center">{{ assign.totalFormat }}</td>
                        <td class="text-right">
                            <a href="" @click.prevent="show(assign.employeeID)" data-toggle="tooltip" title="" data-original-title="Detalle">
                                <i class="fa fa-search ml-2"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <add-cost-to-employee></add-cost-to-employee>
                <show-cost-from-employee></show-cost-from-employee>
            </div>
        </div>

    </div>
</template>

<script>
import Loading from 'vue-loading-overlay'
import EventBus from "../../event-bus";

export default {
    components: {
        Loading,
    },
    data() {
        return {
            isLoading : false,
            assigns: [],
            file: '',
            errors  : [],
        }
    },
    props : ['p_assigns','p_file'],
    created() {
        if (this.p_assigns)
            this.assigns = this.p_assigns

        if (this.p_file)
            this.file = this.p_file
        EventBus.$on('updateAssign',data => this.updateAssign(data))
    },
    methods: {
        show(employee) {
            axios.get(`${this.baseUrl}api/customer/${this.currentCustomerID}/assign-cost/${employee}`,{
                params: { file_id : this.file.id}
            })
            .then(res => {
                EventBus.$emit('showAssign', res.data.assigns);
            })
        },
        openAssign() {
            EventBus.$emit('openAssign', {fileCost: this.file});
        },
        updateAssign(data) {
            let search = this.assigns.find(value => value.employeeID === data.assign.employeeID)
            if (!search)
                this.assigns.push(data.assign)
            else
                this.assigns = this.assigns.map(value => value.employeeID === data.assign.employeeID ? { ...value, ...data.assign } : value )
        }
    }
}
</script>

<style scoped>

</style>
