<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Editar cliente</h6>
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
                                                           v-model="customer.nro_document"
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
                                                v-model="customer.type_document"
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
                                                   v-model="customer.name"
                                                   maxlength="255"
                                                   class="form-control form-control-sm"
                                                   id="name"
                                            >
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="emailofCompany">Correo</label>
                                            <input type="email"
                                                   v-model="customer.email"
                                                   class="form-control form-control-sm"
                                                   id="emailofCompany"
                                            >
                                        </div>
                                    </div>
                                    <div class="form-row mb-1">
                                        <div class="form-group col-md-6">
                                            <label for="address">Dirección</label>
                                            <input type="text"
                                                   v-model="customer.address"
                                                   maxlength="255"
                                                   class="form-control form-control-sm"
                                                   id="address"
                                            >
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="phone">Teléfono</label>
                                            <input type="text"
                                                   v-model="customer.phones"
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
            customer : {
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
            back    : '/admin/commercial/customers',
            apiPeruRUC : 'https://dniruc.apisperu.com/api/v1/ruc/',
            apiPeruDNI : 'https://dniruc.apisperu.com/api/v1/dni/',
            apiToken : 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImNocmlzdGlhbjkyMjAxN0BnbWFpbC5jb20ifQ.yNauheR_85YknM1U2jZFPwt1Q36qaUP6g9_TvaNnSs8',
            errors  : []
        }
    },
    props: ['p_customer', 'p_contacts'],
    created() {
        if (this.p_customer) {
            this.customer = this.p_customer
            this.contacts    = this.p_customer.contacts
        }
    },
    methods: {
        searchContact() {
            this.isLoading = true
            let nro_document = this.customer.nro_document
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
                            this.customer.type_document = 'DNI'
                            this.customer.name = res.data.apellidoPaterno +' '+ res.data.apellidoMaterno +' '+ res.data.nombres
                        } else if (nro_document.length === 11 ) {
                            this.customer.type_document = 'RUC'
                            this.customer.name = res.data.razonSocial
                            this.customer.address = res.data.direccion
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
            axios.put(`/api/commercial/customers/${this.customer.id}`, this.sendParams()).
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
                          name : this.customer.name,
                 type_document : this.customer.type_document,
                  nro_document : this.customer.nro_document,
                       address : this.customer.address,
                         email : this.customer.email,
                        phones : this.customer.phones ,
                      contacts : this.contacts,
                deleteContacts : this.deleteContacts
            }
        }
    }
}
</script>

<style scoped>

</style>
