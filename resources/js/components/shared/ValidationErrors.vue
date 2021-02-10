<template>
    <div v-if="validationErrors.length > 0" class="mb-3">
        <ul class="alert alert-danger">
            <li v-for="(value, key, index) in validationErrors" class="m-2">{{ value }}</li>
        </ul>
    </div>
</template>

<script>
export default {
    data() {
        return {

        }
    },
    props: ['errors'],
    computed: {
        validationErrors(){
            let errors = Object.values(this.errors);
            errors = errors.flat();
            console.log(errors)
            return errors;
        }
    }
}
</script>

<style scoped>

</style>
