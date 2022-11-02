<template>
    <admin-layout :breadcrums="breadcrums" title="Type Create">

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-2">
                <form  @submit.prevent=" propertyType ? form.put(route('admin.property_types.update', propertyType.id)) : form.post(route('admin.property_types.store'))">
                    <div class="border-b-4 mb-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-4 ">
                            <c-input type="text" label="Title" required v-model="form.title" :errmsg="form.errors.title" ></c-input>
                            <c-input type="text" label="Description" v-model="form.description" :errmsg="form.errors.description" ></c-input>
                        </div>


                    </div>

                    <div class="mb-4">
                        <simple-button >Save</simple-button>
                    </div>
                </form>
            </div>
        </div>

    </admin-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import { useForm } from '@inertiajs/inertia-vue3'
    import AdminLayout from '@/Layouts/Admin/Layout.vue';
    import SimpleButton from '@/Shared/Components/Form/Simple/Button.vue'
    import cCheck from '@/Shared/Components/Form/Controls/Checkbox.vue'
    import cInput from '@/Shared/Components/Form/Controls/Input.vue'

    export default defineComponent({
        components: {
            AdminLayout,
            SimpleButton,
            cInput,
            cCheck
        },
        props: ['propertyType'],
         data: () => ({
            edit: false,
            breadcrums: []

         }),
        setup () {
            const form = useForm({
              title: null,
              description: null
            })

            return { form  }
        },

        created(){
            if (this.propertyType) {
                Object.keys(this.propertyType).forEach(key => {
                    this.form[key] = this.propertyType[key];
                });

                this.edit = true;
                this.breadcrums = [ {name: 'Properties', route: 'admin.properties.index'}, { route: 'admin.property_types.index', name: 'Type'}, { name:'edit'} ];

            }else{

                this.breadcrums = [ {name: 'Properties', route: 'admin.properties.index'}, { route: 'admin.property_types.index', name: 'type'}, {route: 'admin.property_types.create', name:'Add'} ];
            }
        },
        methods: {

        }

    })
</script>
