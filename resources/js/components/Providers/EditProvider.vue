<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Editar proveedor</h6>
                        <validation-errors :errors="errors" v-if="errors"></validation-errors>
                        <div class="row">
                            <div class="col-md-12">
                                <loading :active.sync="isLoading" :is-full-page="false"></loading>
                                <form @submit.prevent="handleUpdate">
                                    <div class="form-row mb-1">
                                        <div class="form-group col-md-6">
                                            <div class="row col-md-12">
                                                <label for="razonSocial">Razón social o nombre completo</label>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <input type="text"
                                                           v-model="provider.nro_document"
                                                           class="form-control form-control-sm"
                                                           id="razonSocial"
                                                    >
                                                </div>
                                                <div class="col-md-3 pl-0">
                                                    <button type="button"
                                                            @click.prevent="searchContact"
                                                            class="btn btn-outline-primary btn-sm btn-block">
                                                        <i class="ti-search mr-1"></i> Extraer
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="type_document">Tipo de identificación</label>
                                            <select
                                                class="form-control form-control-sm"
                                                v-model="provider.type_document"
                                                id="type_document">
                                                <option disabled value="">Seleccione un elemento</option>
                                                <option value="RUC">RUC - Registro único de contribuyente</option>
                                                <option value="DNI">DNI - Documento nacional de identidad</option>
                                                <option value="CE">CE - Carnet de extranjería</option>
                                                <option value="PP">PP - Pasaporte</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row mb-1">
                                        <div class="form-group col-md-6">
                                            <label for="name">Razón social o nombre completo</label>
                                            <input type="text"
                                                   v-model="provider.name"
                                                   maxlength="255"
                                                   class="form-control form-control-sm"
                                                   id="name"
                                            >
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="emailofCompany">Correo</label>
                                            <input type="email"
                                                   v-model="provider.email"
                                                   class="form-control form-control-sm"
                                                   id="emailofCompany"
                                            >
                                        </div>
                                    </div>
                                    <div class="form-row mb-1">
                                        <div class="form-group col-md-6">
                                            <label for="address">Dirección</label>
                                            <input type="text"
                                                   v-model="provider.address"
                                                   maxlength="255"
                                                   class="form-control form-control-sm"
                                                   id="address"
                                            >
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="phone">Teléfono</label>
                                            <input type="text"
                                                   v-model="provider.phones"
                                                   class="form-control form-control-sm"
                                                   id="phone"
                                            >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="" @click.prevent="addContacts" class="btn btn-outline-light btn-sm">
                                                <small>
                                                    <i data-feather="plus" class="mr-1"></i> Contacto
                                                </small>
                                            </a>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-row mt-2" v-for="(contact, index) in contacts">
                                        <div class="col-md-3">
                                            <input type="text"
                                                   v-model="contact.full_name"
                                                   placeholder="Nombres"
                                                   maxlength="255"
                                                   class="form-control form-control-sm">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text"
                                                   v-model="contact.position"
                                                   placeholder="Posición/Cargo"
                                                   maxlength="255"
                                                   class="form-control form-control-sm">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="email"
                                                   v-model="contact.email"
                                                   placeholder="Correo"
                                                   maxlength="255"
                                                   class="form-control form-control-sm">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text"
                                                   v-model="contact.phone"
                                                   placeholder="Teléfono"
                                                   maxlength="255"
                                                   class="form-control form-control-sm">
                                        </div>
                                        <div class="col">
                                            <a href="" @click.prevent="removeContact(index)" class="btn btn-outline-light btn-sm">
                                                <small>x</small>
                                            </a>
                                        </div>
                                    </div>
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
            provider : {
                           id : '',
                type_document : '',
                nro_document  : '',
                name          : '',
                address       : '',
                email         : '',
                phones        : ''
            },
            contacts: [],
            deleteContacts : [],
            back    : '/admin/commercial/providers',
            apiPeruRUC : 'https://dniruc.apisperu.com/api/v1/ruc/',
            apiPeruDNI : 'https://dniruc.apisperu.com/api/v1/dni/',
            apiToken : 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImNocmlzdGlhbjkyMjAxN0BnbWFpbC5jb20ifQ.yNauheR_85YknM1U2jZFPwt1Q36qaUP6g9_TvaNnSs8',
            errors  : []
        }
    },
    props: ['p_provider', 'p_contacts'],
    created() {
        if (this.p_provider) {
            this.provider = this.p_provider
            this.contacts = this.p_provider.contacts
        }
    },
    methods: {
        searchContact() {
            this.isLoading = true
            let nro_document = this.provider.nro_document
            let url = `${this.apiPeruRUC}${nro_document}?token=${this.apiToken}`
            if ( nro_document.length === 8 ) {
                url = `${this.apiPeruDNI}${nro_document}?token=${this.apiToken}`
            }
            axios.get(url).
            then(res => {
                this.isLoading = false
                if (res.status === 200) {
                    if (res.data !== '') {
                        if ( nro_document.length === 8 ) {
                            this.provider.type_document = 'DNI'
                            this.provider.name = res.data.apellidoPaterno +' '+ res.data.apellidoMaterno +' '+ res.data.nombres
                        } else if (nro_document.length === 11 ) {
                            this.provider.type_document = 'RUC'
                            this.provider.name = res.data.razonSocial
                            this.provider.address = res.data.direccion
                        }
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
        handleUpdate() {
            axios.put(`/api/commercial/providers/${this.provider.id}`, this.sendParams()).
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
        addContacts() {
            this.contacts.push({
                id        : '',
                full_name : '',
                position  : '',
                email     : '',
                phone     : ''
            })
        },
        removeContact(index) {
            if(this.contacts[index].id){
                this.deleteContacts.push(this.contacts[index].id);
            }

            this.contacts.splice(index,1);
        },
        sendParams() {
            return  {
                         name : this.provider.name,
                type_document : this.provider.type_document,
                 nro_document : this.provider.nro_document,
                      address : this.provider.address,
                        email : this.provider.email,
                       phones : this.provider.phones ,
                     contacts : this.contacts,
               deleteContacts : this.deleteContacts
            }
        }
    }
}
</script>

<style scoped>

</style>
