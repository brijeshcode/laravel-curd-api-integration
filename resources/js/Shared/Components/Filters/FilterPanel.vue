<template>
	<div v-if="showFilter" class="bg-white rounded-lg shadow-md p-2 grid grid-cols-6 gap-4"><slot></slot></div>
</template>

<script>
    export default{
        props: {
            showFilter: Boolean, Default: false
        },
    };
</script>