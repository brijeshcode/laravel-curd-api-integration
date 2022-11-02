<template>
	<thead class="bg-gray-50  text-gray-500 text-xs font-medium  uppercase tracking-wider dark:bg-gray-700 dark:text-gray-200">
        <tr>
          <th scope="col" v-for="(th, index) in tableHeads" class="p-1 font-medium " :class="tableHeads.length - 1 == index ? 'text-right': 'text-left' " >
            <abbr v-if="th.detail" :title="th.detail" class="cursor-help" >{{ th.label }}</abbr>
            <span v-else-if="th.label" >{{ th.label }}</span>
            <span v-else >{{ th }}</span>
          </th>
        </tr>
      </thead>
</template>

<script>
	export default{
        props: {
            tableHeads: {type: [Array, Object], default: null},
        }
    }
</script>