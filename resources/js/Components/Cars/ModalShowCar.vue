<template>
    <Modal :show="show" ref="modal">
        <div class="container-modal">
            <template v-if="car">
                <p class="title-car">{{ car.brand }} - {{ car.model }} - {{ car.year }}</p>
                <hr>
                <div>
                    <p><strong v-if="car.version">Versão:</strong> {{ car.version }}</p>
                    <p><strong v-if="car.color">Cor:</strong> {{ car.color }}</p>
                    <p><strong v-if="car.km != undefined">Km:</strong> {{ car.km }}</p>
                    <p><strong v-if="car.fuel">Combustivel:</strong> {{ car.fuel }}</p>
                    <p><strong v-if="car.gear">Câmbio:</strong> {{ car.gear }}</p>
                    <p><strong v-if="car.doors">Portas:</strong> {{ car.doors }}</p>
                    <p><strong v-if="car.price">Preço:</strong> {{ car.price }}</p>
                </div>
            </template>
            <div class="modal-footer">
                <DxButton
                    :width="120"
                    text="Fechar"
                    type="danger"
                    styling-mode="contained"
                    @click="close"
                />
            </div>
        </div>
    </Modal>
</template>

<script>
import Modal from "@/Components/Modal.vue"
import DxButton from 'devextreme-vue/button';
export default {
    name: "ModalShowCar",
    components: {Modal, DxButton},
    data() {
        return {
            show: false,
            car: {}
        }
    },
    methods:{
        open(){
            this.show = true;
            this.reset();
        },
        close(){
            this.show = false;
            this.reset();
        },
        reset(){
          this.car = {}
        },
        setCar(car){
            console.log('car', car)
            this.car = car
        }
    }
}
</script>

<style scoped>
.title-car{
    font-size: 1.2em;
    font-weight: bold;
}
.modal-footer{
    display: flex;
    justify-content: right;
}
.container-modal{
    padding: 20px 20px 35px 20px;
    display: flex;
    gap: 15px;
    flex-direction: column;
    justify-content: center;
}
</style>
