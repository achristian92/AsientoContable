<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">{{ pageTitle() }}</h6>
                        <validation-errors :errors="errors" v-if="errors"></validation-errors>
                        <div class="row">
                            <div class="col-md-12">
                                <loading :active.sync="isLoading" :is-full-page="false"></loading>
                                <form @submit.prevent="submitAccount">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio"
                                               v-model="formData.category"
                                               id="accountMain"
                                               value="root">
                                        <label class="form-check-label" for="accountMain">
                                            Cuenta principal
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio"
                                               v-model="formData.category"
                                               id="SubAccount"
                                               value="subAccount">
                                        <label class="form-check-label" for="SubAccount">
                                            Sub cuenta
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio"
                                               v-model="formData.category"
                                               id="AccountAnalitica"
                                               value="account">
                                        <label class="form-check-label" for="AccountAnalitica">
                                            Cuenta analítica
                                        </label>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="form-row mb-1">
                                        <div class="form-group col-md-6" v-show="formData.category !== 'root'">
                                            <label for="selectAccount">Cuenta principal</label>
                                            <select
                                                class="form-control form-control-sm"
                                                v-model="selectedAccount"
                                                id="selectAccount">
                                                <option disabled value="">Seleccionar...</option>
                                                <option v-for="account in accounts" :value="account.code">{{account.code}} - {{ account.name}} </option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6" v-show="formData.category === 'account'">
                                            <label for="selectSubAccount">Sub cuenta</label>
                                            <select
                                                class="form-control form-control-sm"
                                                v-model="selectedSubAccount"
                                                id="selectSubAccount">
                                                <option disabled value="">Seleccionar...</option>
                                                <option v-for="subAccount in subAccounts" :value="subAccount.code">{{ subAccount.code}} - {{ subAccount.name}} </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row mb-1">
                                        <div class="form-group col-md-2">
                                            <label for="code">Código cuenta</label>
                                            <input type="text"
                                                   v-model="formData.code"
                                                   maxlength="255"
                                                   class="form-control form-control-sm"
                                                   id="code"
                                            >
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="name">Nombre</label>
                                            <input type="text"
                                                   v-model="formData.name"
                                                   maxlength="255"
                                                   class="form-control form-control-sm"
                                                   id="name"
                                            >
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="type_document">Tipo</label>
                                            <select
                                                class="form-control form-control-sm"
                                                v-model="formData.type"
                                                id="type_document">
                                                <option disabled value="">Seleccione un tipo</option>
                                                <option value="GASTO">GASTO</option>
                                                <option value="PASIVO">PASIVO</option>
                                                <option value="ACTIVO">ACTIVO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               v-model="formData.is_analyzable"
                                               id="analisis">
                                        <label class="form-check-label" for="analisis">
                                            Análisis
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               v-model="formData.has_center_cost"
                                               id="centerCost1">
                                        <label class="form-check-label" for="centerCost1">
                                            Centro de costos
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               v-model="formData.has_center_cost2"
                                               id="centerCost2">
                                        <label class="form-check-label" for="centerCost2">
                                            Centro de costos 2
                                        </label>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="row col-md-12">
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-primary"> Guardar </button>
                                            <a :href="`${this.baseUrl}admin/customer/${currentCustomerID}/accounting-plan`" class="btn btn-sm btn-outline-light ml-2"> Regresar </a>
                                        </div>
                                        <div class="col-md-6 text-right" v-show="isEdit">
                                            <a href="#" @click.prevent="handleDestroy" type="submit" class="btn btn-sm btn-outline-danger"> Eliminar </a>
                                        </div>

                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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
            isLoading   : false,
            formData: {
                id: '',
                category: '',
                code: '',
                name: '',
                type: '',
                is_analyzable: false,
                has_center_cost: false,
                has_center_cost2: false,
            },
            category : 'root',
            accounts    : [],
            selectedAccount : '',
            subAccounts : [],
            selectedSubAccount : '',
            errors      : [],
        }
    },
    props: ['p_model'],
    created() {
        if (this.p_model)
            this.formData.id = this.p_model.id

        this.loadData()
        this.getDataPlanAccount()
    },
    computed: {
        isEdit() {
            return !!this.formData.id;
        },
        backUrl() {
            return `${this.baseUrl}admin/customer/${this.currentCustomerID}/accounting-plan`
        }
    },
    watch: {
        category: function () {
            this.code = ''; this.name = ''; this.type = '';

            if (this.category === 'subAccount')
                this.selectedAccount = ''

            if (this.category === 'account') {
                this.selectedAccount = ''
                this.selectedSubAccount = ''
            }
        },
        selectedAccount: function () {
            this.getDataPlanAccount()
        },
    },

    methods: {
        pageTitle() {
            if (this.isEdit)
                return 'Editar plan de cuentas'
            return 'Crear plan de cuentas'
        },
        loadData() {

            if (this.isEdit) {
                this.formData = this.p_model
                if (this.p_model.category === 'subAccount')
                    this.selectedAccount = this.p_model.parent_id

                else if (this.p_model.category === 'account') {
                    this.selectedAccount = this.p_model.parents.parent_id
                    this.selectedSubAccount = this.p_model.parents.code
                }
            }
        },
        getDataPlanAccount() {
            axios.get(`${this.baseUrl}api/customer/${this.currentCustomerID}/plan-account`,{params: {'root': this.selectedAccount}})
                .then(res => {
                    this.accounts = res.data.accounts
                    this.subAccounts = res.data.subAccounts
                })
        },
        submitAccount() {
            this.isLoading = true
            let url = ''
            let data = this.sendParams()
            if (this.isEdit) {
                url = `${this.baseUrl}api/customer/${this.currentCustomerID}/plan-account/${this.formData.id}`
                data['_method'] = 'PUT'
            }
            else
                url = `${this.baseUrl}api/customer/${this.currentCustomerID}/plan-account`

            axios.post(url, data)
                .then(res => {
                    this.isLoading = false
                    Vue.$toast.success(res.data.msg)
                    setTimeout(() => {
                        window.location.href = this.backUrl;
                    }, 1000)
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
        },
        sendParams() {
            return  {
                ...this.formData,
                selectedAccount : this.selectedAccount,
                selectedSubAccount : this.selectedSubAccount,
            }
        },
        handleDestroy() {
            this.isLoading = true
            axios.delete(`${this.baseUrl}api/customer/${this.currentCustomerID}/plan-account/${this.formData.id}`)
                .then(res => {
                    this.isLoading = false
                    Vue.$toast.success(res.data.msg)
                    setTimeout(() => {
                        window.location.href = this.backUrl;
                    }, 1000)
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
