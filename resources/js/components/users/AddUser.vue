<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Crear usuario</h6>
                        <validation-errors :errors="errors" v-if="errors"></validation-errors>
                        <div class="row">
                            <div class="col-md-12">
                                <loading :active.sync="isLoading" :is-full-page="false"></loading>
                                <form @submit.prevent="handleStore">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="name">Número Documento</label>
                                        </div>
                                    </div>
                                    <div class="row" >
                                        <div class="col-md-3 mr-0">
                                            <input type="text"
                                                   v-model="user.dni"
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
                                                   v-model="user.name"
                                                   class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Apellidos</label>
                                            <input type="text"
                                                   v-model="user.last_name"
                                                   class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="form-row mb-1">
                                        <div class="form-group col-md-4">
                                            <label>Correo electronico</label>
                                            <input type="email"
                                                   v-model="user.email"
                                                   maxlength="255"
                                                   class="form-control form-control-sm"
                                            >
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Dirección</label>
                                            <input type="text"
                                                   v-model="user.address"
                                                   maxlength="255"
                                                   class="form-control form-control-sm"
                                            >
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="phone">Teléfono</label>
                                            <input type="text"
                                                   v-model="user.phone"
                                                   class="form-control form-control-sm"
                                                   id="phone"
                                            >
                                        </div>
                                    </div>
                                    <h5>Rol</h5>
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
                                    <button type="submit" class="btn btn-sm btn-primary"> Guardar </button>
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

export default {
    components: {
        Loading,
    },
    data() {
        return {
            isLoading : false,
            user : {
                dni       : '',
                name      : '',
                last_name : '',
                address   : '',
                phone     : '',
                email     : ''
            },
            roles : [],
            checkedRoles : [],
            apiPeru : 'https://dniruc.apisperu.com/api/v1/dni/',
            apiToken : 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImNocmlzdGlhbjkyMjAxN0BnbWFpbC5jb20ifQ.yNauheR_85YknM1U2jZFPwt1Q36qaUP6g9_TvaNnSs8',
            back    : '/admin/accesses/users',
            errors  : []
        }
    },
    props : ['p_roles'],
    created() {
        if (this.p_roles) {
            this.roles = this.p_roles;
        }
    },
    methods: {
        searchDNI () {
            this.isLoading = true
            axios.get(`${this.apiPeru}${this.user.dni}?token=${this.apiToken}`).
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
        handleStore() {
            axios.post('/api/accesses/users', this.sendParams()).
            then(res => {
                Vue.$toast.success(res.data.msg)
                setTimeout(() => {
                    window.location.href = this.back;
                }, 1000)
            }).
            catch(error => {
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
                name         : this.user.name,
                last_name    : this.user.last_name,
                nro_document : this.user.dni,
                phone        : this.user.phone,
                email        : this.user.email,
                roles        : this.checkedRoles
            }
        }
    }
}
</script>

<style scoped>

</style>
