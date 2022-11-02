<template>
    <admin-layout :breadcrums="breadcrums" title="Property Create">

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-2">
                <form  @submit.prevent="submitData">
                    <div  class="border-b-4 mb-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-4 ">
                            <c-input type="text" label="County" required v-model="form.county" :errmsg="form.errors.county" ></c-input>
                            <c-input type="text" label="Country" required v-model="form.country" :errmsg="form.errors.country" ></c-input>
                            <c-input type="text" label="Town" required v-model="form.town" :errmsg="form.errors.town" ></c-input>
                            <c-input type="text" label="Postcode" required v-model="form.postcode" :errmsg="form.errors.postcode" ></c-input>
                            <c-area type="text" class="col-span-2" label="Description" required v-model="form.description" :errmsg="form.errors.description" ></c-area>
                            <c-input type="text" label="Displayable Address" required v-model="form.address" :errmsg="form.errors.address" ></c-input>
                            <c-select label="Number of bedrooms" v-model="form.num_bedrooms" required  :options="['1','2','3','4','5','6']"></c-select>
                            <c-select label="Number of bathrooms" v-model="form.num_bathrooms"  required :options="['1','2','3','4','5','6']"></c-select>
                            <c-input type="number" label="Price" required v-model="form.price" :errmsg="form.errors.price" ></c-input>
                            <c-select label="Property Type" required v-model="form.property_type_id" queryData dataText='title' :options="propertyTypes"></c-select>
                            <c-radio label="For" v-model="form.for" name="for"  required :radios="{sale:'sale', rent: 'rent'}"></c-radio>
                        </div>
                        <div class="grid grid-cols-6 gap-4">
                            <div class="col-span-2 mb-3">
                            <a v-if="property" :href="property.image_full" target="_blank"> <img :src="property.image_thumbnail" class="m-2 hover:cursor-zoom-in"></a>
                            <input type="file" @input="form.image_full = $event.target.files[0]" class="  w-full border-[1.5px] border-form-stroke rounded-lg font-medium text-body-color placeholder-body-color outline-none focus:border-primary active:border-primary transition  disabled:bg-[#F5F7FD] disabled:cursor-default cursor-pointer file:bg-[#F5F7FD] file:border-0 file:border-solid file:border-r file:border-collapse file:border-form-stroke file:py-2 file:px-5 file:mr-5 file:text-body-color file:cursor-pointer file:hover:bg-primary file:hover:bg-opacity-10" accept="image/*" />
                            </div>
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
    import cInput from '@/Shared/Components/Form/Controls/Input.vue'
    import cArea from '@/Shared/Components/Form/Controls/Textarea.vue'
    import cSelect from '@/Shared/Components/Form/Controls/Select.vue'
    import cRadio from '@/Shared/Components/Form/Controls/Radio.vue'

    export default defineComponent({
        components: {
            AdminLayout,
            SimpleButton,
            cInput,
            cSelect,
            cRadio,
            cArea
        },
        props: ['property', 'propertyTypes'],
         data: () => ({
            edit: false,
            breadcrums: []

         }),
        setup () {
            const form = useForm({
                _method: 'PUT',
                property_type_id: null,
                county: null,
                country: null,
                postcode: null,
                town: null,
                description: null,
                address: null,
                num_bedrooms: null,
                num_bathrooms: null,
                price: null,
                for: 'sale',
                image_full: null

            })

            function submitData(){
                if (this.property) {
                    form.post(route('admin.properties.update', this.property.uuid));
                }else{
                    delete form._method;
                    form.post(route('admin.properties.store'));
                }
            }

            return { form, submitData  }
        },

        created(){
            if (this.property) {
                Object.keys(this.property).forEach(key => {
                    this.form[key] = this.property[key];
                });
                this.edit = true;
                this.breadcrums = [ {name: 'Setup'}, { route: 'admin.properties.index', name: 'Property'}, { name:'edit'} ];

            }else{ ;
                this.breadcrums = [ { route: 'admin.properties.index', name: 'Property'}, {route: 'admin.properties.create', name:'Add'} ];
            }
        },
        methods: {

        }

    })
</script>
