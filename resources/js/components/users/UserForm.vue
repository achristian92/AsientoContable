<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">{{ pageTitle }}</h6>
                        <validation-errors :errors="errors" v-if="errors"></validation-errors>
                        <div class="row">
                            <div class="col-md-12">
                                <loading :active.sync="isLoading" :is-full-page="false"></loading>
                                <form @submit.prevent="submitUser">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="name">Número Documento</label>
                                        </div>
                                    </div>
                                    <div class="row" >
                                        <div class="col-md-3 mr-0">
                                            <input type="text"
                                                   v-model="formData.nro_document"
                                                   class="form-control form-control-sm"
                                            >
                                        </div>
                                        <div class="col-md-3 pl-0">
                                            <button type="button"
                                                    @click.prevent="searchDNI"
                                                    class="btn btn-outline-primary btn-sm">
                                                <i class="ti-search mr-1"></i> Extraer
                                            </button>
                                        </div>
                                    </div >
                                    <div class="form-row mb-1 mt-3">
                                        <div class="form-group col-md-6">
                                            <label>Nombres</label>
                                            <input type="text"
                                                   v-model="formData.name"
                                                   class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Apellidos</label>
                                            <input type="text"
                                                   v-model="formData.last_name"
                                                   class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="form-row mb-1">
                                        <div class="form-group col-md-4">
                                            <label>Correo electronico</label>
                                            <input type="email"
                                                   v-model="formData.email"
                                                   maxlength="255"
                                                   class="form-control form-control-sm"
                                            >
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="phone">Teléfono</label>
                                            <input type="text"
                                                   v-model="formData.phone"
                                                   class="form-control form-control-sm"
                                                   id="phone"
                                            >
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Dirección</label>
                                            <input type="text"
                                                   v-model="formData.address"
                                                   maxlength="255"
                                                   class="form-control form-control-sm"
                                            >
                                        </div>
                                    </div>
                                    <h6>Clientes</h6>
                                    <div class="form-check mb-2" v-if="formData.all_customers">
                                        <input class="form-check-input"
                                               v-model="formData.all_customers"
                                               type="checkbox"
                                               id="asignCustomers">
                                        <label class="form-check-label" for="asignCustomers">Asignar todos clientes</label>
                                    </div>
                                    <label v-if="!formData.all_customers">
                                        Seleccionar los clientes
                                        <a href="#" @click.prevent="formData.all_customers = !formData.all_customers" class="btn btn-light btn-sm">x</a>
                                    </label>
                                    <div class="form-row" v-if="!formData.all_customers">
                                        <div class="form-group col-md-12">
                                            <multiselect v-model="customer"
                                                         :options="customers"
                                                         :multiple="true"
                                                         :close-on-select="false"
                                                         :clear-on-select="false"
                                                         :preserve-search="true"
                                                         placeholder="Seleccionar..."
                                                         label="name"
                                                         track-by="name">
                                                <template slot="selection"
                                                          slot-scope="{ values, search, isOpen }">
                                        <span class="multiselect__single"
                                              v-if="values.length &amp;&amp; !isOpen">
                                            {{ values.length }} seleccionado
                                        </span></template>
                                            </multiselect>
                                        </div>
                                    </div>
                                    <h6>Rol</h6>
                                    <div class="form-check form-check-inline" v-for="(rol,index) in roles">
                                        <input class="form-check-input"
                                               v-model="checkedRoles"
                                               type="checkbox"
                                               :id="'rol_'+rol.id"
                                               :value="rol.id">
                                        <label class="form-check-label" :for="'rol_'+rol.id">{{ rol.name }}</label>
                                    </div>
                                    <br>
                                    <br>
                                    <button type="submit" class="btn btn-primary"> Guardar </button>
                                    <a :href="back" class="btn btn-sm btn-outline-light ml-2"> Regresar </a>
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
import { Multiselect } from 'vue-multiselect';

export default {
    components: {
        Loading,
        Multiselect
    },
    data() {
        return {
            isLoading : false,
            formData : {
                id: '',
                nro_document : '',
                name         : '',
                last_name    : '',
                address      : '',
                phone        : '',
                email        : '',
                all_customers: true
            },
            roles : [],
            checkedRoles : [],
            customers: [],
            customer: [],
            apiPeru : 'https://dniruc.apisperu.com/api/v1/dni/',
            apiToken : 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImNocmlzdGlhbjkyMjAxN0BnbWFpbC5jb20ifQ.yNauheR_85YknM1U2jZFPwt1Q36qaUP6g9_TvaNnSs8',
            back    : '/admin/users',
            errors  : []
        }
    },
    props : ['p_roles','p_user','p_customers','p_user_roles_ids'],
    created() {
        if (this.p_user)
            this.formData.id = this.p_user.id

        this.loadData()
    },
    computed: {
        isEdit() {
            return !!this.formData.id;
        },
        pageTitle() {
            if (this.isEdit)
                return 'Editar usuario'
            return 'Crear usuario'
        }
    },
    methods: {
        loadData() {
          if (this.isEdit) {
              this.formData = this.p_user
              this.checkedRoles = this.p_user_roles_ids
              this.customer = this.p_user.customers
          }

        this.roles = this.p_roles;
        this.customers = this.p_customers;
        },
        submitUser() {
            this.isLoading = true
            let url = ''
            let data = this.sendParams()
            if (this.isEdit) {
                url = `/api/users/${this.formData.id}`
                data['_method'] = 'PUT'
            }
            else
                url = `/api/users`

            axios.post(url, data).
            then(res => {
                this.isLoading = false
                Vue.$toast.success(res.data.msg)
                setTimeout(() => { window.location.href = this.back;}, 1000)
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
            let customer_ids = this.customer.map(function(a) {return a.id;});

            return  {
                name         : this.formData.name,
                last_name    : this.formData.last_name,
                nro_document : this.formData.nro_document,
                phone        : this.formData.phone,
                address      : this.formData.address,
                email        : this.formData.email,
                roles        : this.checkedRoles,
                all_customers: this.formData.all_customers,
                customers_ids: customer_ids
            }
        },
        searchDNI () {
            this.isLoading = true
            axios.get(`${this.apiPeru}${this.user.nro_document}?token=${this.apiToken}`).
            then(res => {
                this.isLoading = false
                if (res.status === 200) {
                    if (res.data !== '') {
                        this.user.name = res.data.nombres
                        this.user.last_name = res.data.apellidoPaterno +' '+ res.data.apellidoMaterno
                    } else {
                        Vue.$toast.error("No se encontraron resultados");
                    }
                }
            }).
            catch(error => {
                this.isLoading = false
                Vue.$toast.error("No se encontraron resultados");
            });

        },
    }
}
</script>


<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>


<style>
.multiselect__tag {
    background-color: #bfbfbf;
}
.multiselect__option--highlight {
    background: #bfbfbf;
}

.multiselect__content {
    background: #f5f5f5;
}
</style>
