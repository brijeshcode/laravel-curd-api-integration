<template>
    <span class="pr-1" v-for="action in actions">
        <!-- <history v-if="action.type == 'history' && data.audits.length > 0" :link="{route:'audits.show', id:data.audits[0].id}" icon /> -->
        <show-link v-if="action.type == 'show'" :link="{route: action.route, id:data[action.key] }" icon />
        <edit-link v-if="action.type == 'edit'" :edit="{route: action.route, to:data[action.key] }" icon />
        <delete-link v-if="action.type == 'destroy'" :link="{route: action.route, id:data[action.key] }" icon />
    </span>
</template>


<script>
    import EditLink from '@/Shared/Components/Links/Edit.vue'
    import ShowLink from '@/Shared/Components/Links/Show.vue'
    import DeleteLink from '@/Shared/Components/Links/Delete.vue'
    import History from '@/Shared/Components/Links/UpdateHistory.vue'
    export default{
        components:{ShowLink,EditLink,DeleteLink,History},
        props: {
            actions: {type: Array, default: null},
            data: {type: Object, default: null},
        },
        /*data: () => ({
        }),
        created(){
        },
        methods:{

        }*/
    }
</script>