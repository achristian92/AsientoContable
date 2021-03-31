<template>
    <div class="modal fade" id="showCostAssign" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Centro de costos asignados</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ti-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row col-12">
                        <h5>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                            <span class="text-primary" v-if="assigns.length > 0">"{{ assigns[0].worked }}"</span>
                        </h5>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                                <table class="table table-striped mb-0">
                                    <thead>
                                    <tr>
                                        <th>Centro de costo</th>
                                        <th>Porcentage</th>
                                        <th class="text-right">Acción</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="assign in assigns">
                                        <td>{{  assign.cost }}</td>
                                        <td>{{ assign.percentage }}%</td>
                                        <td class="text-right">
                                            <a href=""
                                               class="btn btn-outline-light btn-sm mr-1"
                                               @click.prevent="destroy(assign.id)">
                                                <small>
                                                    <i class="ti-close"></i>
                                                </small>
                                            </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td class="text-right"><strong>Total</strong></td>
                                        <td> {{ total }}%</td>
                                        <td class="text-right"></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-link" data-dismiss="modal">Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import EventBus from "../../../event-bus";

export default {
    data() {
        return {
            assigns: '',
            total: '',
        }
    },
    created() {
        EventBus.$on('showAssign',data => this.open(data))
    },
    methods: {
        open(data) {
            this.assigns = data
            if (data.length > 0) {
                let total = data.reduce(function (total, currentValue) {
                    return total + currentValue.percentage;
                }, 0);
                this.total = total.toFixed(2)
                $('#showCostAssign').modal('show')
            }
            else
                alert('No tiene centro de costos asignados')
        },
        destroy(id) {
            let isConfirmed = confirm("Estas seguro de eliminar este vínculo?")
            if(!isConfirmed) {return false;}

            axios.delete(`${this.baseUrl}api/customer/${this.currentCustomerID}/assign-cost/${id}`)
                .then(res => {
                    location.reload();
                })
        }
    }
}
</script>

<style scoped>

</style>
