<template>
    <div>
        <ModalShowCar ref="modal-show-car"/>
        <DxDataGrid
            :data-source="$page.props.cars"
            key-expr="id"
            :show-borders="true"
            :show-row-lines="true"
            :show-column-lines="true"
            :allow-column-resizing="true"
            :column-min-width="50"
            :column-auto-width="true"
            @selection-changed="onSelectionChanged"
        >

            <DxPaging :page-size="10" />
            <DxPager
                :visible="true"
                :allowed-page-sizes="[5,10,15,25,50,100]"
                :display-mode="'full'"
                :show-page-size-selector="true"
                :show-info="true"
                :show-navigation-buttons="true"
            />

            <DxSelection
                mode="single"
            />

            <DxHeaderFilter :visible="true" />
            <DxFilterRow :visible="true"/>

            <dx-export
                :enabled="true"
                :allow-export-selected-data="true"
                file-name="cars-list"
            />

            <DxColumn
                data-field="id"
                caption="ID"
            />
            <DxColumn
                data-field="brand"
                caption="Marca"
            />
            <DxColumn
                data-field="model"
                caption="Modelo"
            />
            <DxColumn
                data-field="year"
                caption="Ano"
            />
            <DxColumn
                data-field="price"
                caption="Preço"
                data-type="number"
                :format="{
                            style: 'currency',
                            precision: 2,
                            currency: 'BRL'
                        }"
            />
            <DxColumn
                data-field="km"
                data-type="number"
                caption="Quilometragem"
            />
        </DxDataGrid>
    </div>
</template>

<script>
import {
    DxDataGrid,
    DxExport,
    DxColumn,
    DxPaging,
    DxSelection,
    DxScrolling,
    DxFilterRow,
    DxColumnFixing,
    DxHeaderFilter,
    DxMasterDetail,
    DxSearchPanel,
    DxPager,
} from 'devextreme-vue/data-grid';
import DxSelectBox from "devextreme-vue/select-box";
import ModalShowCar from "@/Components/Cars/ModalShowCar.vue";
export default {
    name: "List",
    components:
        {
            ModalShowCar,
            DxSelectBox,
            DxDataGrid,
            DxColumn,
            DxPaging,
            DxSelection,
            DxFilterRow,
            DxScrolling,
            DxColumnFixing,
            DxExport,
            DxHeaderFilter,
            DxMasterDetail,
            DxSearchPanel,
            DxPager,
        },
    methods: {
        onSelectionChanged({ selectedRowsData: row }){
            if(row[0]){
                this.$refs['modal-show-car'].open()
                this.$refs['modal-show-car'].setCar(row[0])
            }
          console.log('hi', row[0].km)
        },
    }
}
</script>

<style scoped>

</style>
