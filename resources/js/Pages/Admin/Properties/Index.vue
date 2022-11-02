<template>
    <admin-layout title="Properties" :breadcrums="breadcrums" :actionsLinks="actionsLinks">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Properties
            </h2>
        </template>

        <template #filtersData>
          <filterPanel showFilter="true">
            <c-input type="text" label="County"  v-model="filter.county"  ></c-input>
            <c-input type="text" label="Country"  v-model="filter.country"  ></c-input>
            <c-input type="text" label="Town"  v-model="filter.town"  ></c-input>
            <c-input type="text" label="Postcode"  v-model="filter.postcode"  ></c-input>
            <!-- <c-area type="text" class="col-span-2" label="Description"  v-model="filter.description"  ></c-area> -->
            <c-input type="text" label="Address"  v-model="filter.address"  ></c-input>
            <c-select label="Number of bedrooms" v-model="filter.num_bedrooms"   :options="['1','2','3','4','5','6']"></c-select>
            <c-select label="Number of bathrooms" v-model="filter.num_bathrooms"   :options="['1','2','3','4','5','6']"></c-select>
            <c-input type="number" label="Price"  v-model="filter.price"  ></c-input>
            <c-select label="Property Type"  v-model="filter.property_type_id" queryData dataText='title' :options="propertyTypes"></c-select>
            <c-radio label="For" v-model="filter.for" name="for"   :radios="{sale:'sale', rent: 'rent'}"></c-radio>

            <div class="filter-control p-4">
              <simple-button @click="filterData" class="ml-4 hover:bg-indigo-800 bg-blue-500" type="button">Filter</simple-button>
            </div>
          </filterPanel>
        </template>


        <div class="py-2">

                <div class="bg-white overflow-hidden shadow-lg p-2 sm:rounded-lg">
                    <table class="table-auto min-w-full divide-y divide-gray-200">
                        <t-header :tableHeads="tableHeads" />
                        <tbody class="bg-white divide-y divide-gray-200 text-xs text-gray-500">
                            <tr v-for="(property, index ) in  properties.data" :key="property.uuid">
                                <td>{{ properties.from + index }}</td>
                                <td><a :href="property.image_full" target="_blank"> <img :src="property.image_thumbnail" class="m-2 hover:cursor-zoom-in"></a> {{ property.county }}</td>
                                <td>{{ property.country }}</td>
                                <td>{{ property.town }}</td>
                                <td>{{ property.address }}</td>
                                <td>{{ property.postcode }}</td>
                                <td>{{ property.num_bedrooms }}</td>
                                <td>{{ property.num_bathrooms }}</td>
                                <td>{{ property.price }}</td>
                                <td class="capitalize">{{ property.for }}</td>
                                <td class="capitalize">{{ property.property_type.title }}</td>
                                <td  class="whitespace-nowrap  flex justify-end text-right  font-medium">
                                    <table-actions :actions="table_actions" :data="property" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <Pagination :pageData="properties" pageof=" Properties" />
                </div>
        </div>
    </admin-layout>
</template>


<script>
    import { defineComponent } from 'vue'
    import { Inertia } from '@inertiajs/inertia'
    import { useForm } from '@inertiajs/inertia-vue3'
    import AdminLayout from '@/Layouts/Admin/Layout.vue';
    import Pagination from '@/Shared/Components/Pagination/Simple.vue'
    import TableActions from '@/Shared/Components/Tables/Partials/TableActions.vue';
    import THeader from '@/Shared/Components/Tables/Partials/TableHeader.vue'

    import FilterIcon from '@/Shared/Components/Icons/svg/Filter.vue'
    import FilterPanel from '@/Shared/Components/Filters/FilterPanel.vue'
    import SimpleButton from '@/Shared/Components/Form/Simple/Button.vue'

     import cInput from '@/Shared/Components/Form/Controls/Input.vue'
    import cArea from '@/Shared/Components/Form/Controls/Textarea.vue'
    import cSelect from '@/Shared/Components/Form/Controls/Select.vue'
    import cRadio from '@/Shared/Components/Form/Controls/Radio.vue'
    export default defineComponent({
        components: {
            AdminLayout,Pagination, THeader, TableActions, FilterPanel,FilterIcon,SimpleButton,cInput, cSelect, cRadio, cArea
        },

        props:['properties', 'propertyTypes'],
         data: () => ({
            edit: false,
            tdkeys: ['#','name', 'note', 'active'],
            table_actions: [
                { type:'edit', route: 'admin.properties.edit', key: 'uuid' },
                { type:'destroy', route: 'admin.properties.destroy', key: 'uuid'}
            ],
            breadcrums: [ {name: 'Properties'} ],
            tableHeads : ['#', 'County', 'Country', 'Town', 'Address', 'Postalcode', 'bedrooms','bathrooms', 'price', 'for', 'type', 'Action' ],
            actionsLinks: [
              {title: 'Add', route: 'admin.properties.create', icon: 'add', color:'red', bg:'green'}
            ],
            filter:{
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
            },
         }),

         created(){
            if (route().params.filter == 1) {
              Object.keys(this.filter).forEach((key) => {this.filter[key] = route().params[key]})
              this.filter.filter = route().params.filter;
            }
         },
         methods:{
          filterData(){
            Inertia.get(route('admin.properties.index'), this.filter ,{
                  preserveState: true,
                  replace: true
              });
          }
        }
    })
</script>