<template>
    <admin-layout title="Property Type" :breadcrums="breadcrums" :actionsLinks="actionsLinks">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Property Type
            </h2>
        </template>

        <div class="py-2">

                <div class="bg-white overflow-hidden shadow-lg p-2 sm:rounded-lg">
                    <d-table :theaders="tableHeads" :trdata="types" :tdkeys="tdkeys" :actions="table_actions" pageof=" Types" />
                </div>
        </div>
    </admin-layout>
</template>


<script>
    import { defineComponent } from 'vue'
    import { useForm } from '@inertiajs/inertia-vue3'
    import AdminLayout from '@/Layouts/Admin/Layout.vue';
    import DTable from '@/Shared/Components/Tables/DataTable1/Table.vue'

    export default defineComponent({
        components: {
            AdminLayout,DTable

        },
        props:['types'],
         data: () => ({
            edit: false,
            tdkeys: ['#','title', 'description'],
            table_actions: [
                { type:'history'},
                { type:'edit', route: 'admin.property_types.edit', key: 'id' },
                { type:'destroy', route: 'admin.property_types.destroy', key: 'id'}
            ],
            breadcrums: [ {name: 'Properties', route: 'admin.properties.index'}, { route: 'admin.property_types.index', name: 'Types'} ],
            tableHeads : ['#', 'Title', 'Description', 'Action' ],
            actionsLinks: [
              {title: 'Add', route: 'admin.property_types.create', icon: 'add', color:'red', bg:'green'}
            ]
         }),

         created(){
            console.log(this.types);
         },
    })
</script>