<template>
    <div class="modal fade" id="importCostCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Importar Distribución</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="submitImport">
                    <loading :active.sync="isLoading" :is-full-page="false"></loading>
                    <div class="modal-body">
                        <validation-errors :errors="errors" v-if="errors"></validation-errors>
                        <div class="form-group" v-if="!uploadedImage">
                            <label class="btn btn-outline-facebook" for="my-file-selector">
                                <input type="file" id="my-file-selector"  ref="fileInput" @change="previewImage" class="d-none">
                                <i class="fa fa-upload mr-2"></i> Subir archivo
                            </label>
                        </div>
                        <div class="form-group" v-else>
                            <a href="" @click.prevent="remove" class="btn btn-outline-danger text-danger">
                                <i class="fa fa-trash mr-2"></i> Remover archivo
                            </a>
                        </div>
                        <div class="row" v-show="uploadedImage">
                            <div class="col-md-6">
                                <div class="card app-file-list">
                                    <div class="app-file-icon">
                                        <i class="fa fa-file-excel-o text-success"></i>
                                    </div>
                                    <div class="p-2 small">
                                        <div>{{ name }}</div>
                                        <div class="text-muted">{{ size }}kb</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <a href="" @click.prevent="downloadTemplate" class="text-primary font-size-15"><u>Descargar plantilla</u></a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</template>

<script>
import Loading from "vue-loading-overlay";

export default {
    components: {
        Loading,
    },
    data() {
        return {
            isLoading     : false,
            uploadedImage : false,
            fileObject    : '',
            name          : '',
            size          : '',
            errors        : []
        }
    },
    props: {
      file_id: ''
    },
    methods: {
        downloadTemplate() {
            window.location =  `${this.baseUrl}api/customer/${this.currentCustomerID}/template/assign-cost`
        },
        submitImport() {
            this.isLoading = true
            let data = new FormData;
            data.append('file_upload', this.fileObject)
            data.append('file_id', this.file_id)

            axios.post(`${this.baseUrl}api/customer/${this.currentCustomerID}/import/assign-cost`, data,{
                headers: { 'content-type': 'multipart/form-data' }
            }).
            then(res => {
                this.isLoading = false
                if (res.data.status === false) {
                    Vue.$toast.error(res.data.msg)
                    return '';
                }
                Vue.$toast.success(res.data.msg)
                setTimeout(() => {
                    location.reload();
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
        previewImage: function(event) {
            let input = event.target;
            if (input.files && input.files[0]) {
                let name = input.files[0].name
                let extension = name.substring(name.lastIndexOf('.')+1, name.length) || name;
                if (extension !== 'xlsx' && extension !== 'xls') {
                    Vue.$toast.error("Formato incorrecto(solo: xlsx o xls)")
                    return ''
                }
                if (name.length > 25)
                    this.name = input.files[0].name.substr(0,25)+'...'
                else
                    this.name = input.files[0].name

                this.uploadedImage = true
                this.size = input.files[0].size
                this.fileObject = input.files[0];
            }
        },
        remove() {
            this.uploadedImage = false
            this.name = ''
            this.size = ''
            this.fileObject = ''
            this.errors = []
        }
    }
}
</script>

<style scoped>

</style>
