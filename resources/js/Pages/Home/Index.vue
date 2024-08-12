<template>
    <div class="flex w-full justify-center flex-col items-center">
        <NavBar></NavBar>
        <div v-if="$page.props?.cars" class="car-list-container">
            <List></List>
        </div>
        <div class="mt-16 api-buttons mb-6">
            <DxButton
                text="update WebMotors Api"
                type="default"
                styling-mode="contained"
                @click="callWebMotorsApi"
            />
            <DxButton
                text="update RevendaMais Api"
                type="default"
                styling-mode="contained"
                @click="callRevendaMaisApi"
            />
            <DxButton
                text="Resetar Banco de dados"
                type="danger"
                styling-mode="contained"
                @click="resetTableCars"
            />
        </div>
    </div>
</template>

<script>
import NavBar from "@/Components/NavBar.vue";
import List from "@/Components/Cars/List.vue";
import DxButton from 'devextreme-vue/button';
import notify from "devextreme/ui/notify";
export default {
    name: "Index",
    components: {List, NavBar, DxButton},
    methods: {
        callWebMotorsApi(){
            axios.post('api/webmotors/update-listing', {})
                .then(response => {
                    this.reloadCarsList();
                    notify({message: "Atualizado com sucesso", width: 230,}, 'success', 3000);
                })
                .catch(error => {
                    notify({message: "Não foi possível atualizar", width: 230,}, 'error', 3000);
                })
        },
        callRevendaMaisApi(){
            axios.post('api/revendamais/update-listing', {})
                .then(response => {
                    this.reloadCarsList();
                    notify({message: "Atualizado com sucesso", width: 230,}, 'success', 3000);
                })
                .catch(error => {
                    notify({message: "Não foi possível atualizar", width: 230,}, 'error', 3000);
                })
        },
        resetTableCars(){
            axios.post('api/cars/reset', {})
                .then(response => {
                    this.reloadCarsList();
                    notify({message: "Carros resetados com sucesso", width: 230,}, 'success', 3000);
                })
                .catch(error => {
                    notify({message: "Não foi possível resetar o banco de dados", width: 230,}, 'error', 3000);
                })
        },
        reloadCarsList(){
            axios.post('api/cars/reload', {})
                .then(response => {
                    this.$page.props.cars = response.data;
                })
                .catch(error => {
                })
        },
    }
}
</script>

<style scoped>
    .car-list-container{
        margin-top: 50px;
        display: flex;
        justify-content: center;
        width: 80%;
    }
    .api-buttons{
        display: flex;
        justify-content: center;
        gap:15px;
    }
</style>
