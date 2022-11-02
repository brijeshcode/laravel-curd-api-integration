<template>
  <div class="field column" >
    <form-label v-if="label" :class="lableClass"  v-bind="$attrs" >{{ label }}</form-label>

      <select
        v-bind="$attrs"
        :name="name"
        class="mt-1 focus:ring-indigo-500 capitalize w-full p-2 mt-2 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
        @change="selectChange($event.target.value)"
        :class="inputClass"
        :style="inputStyle"
      >
        <option v-if="placeholder" disabled>{{ placeholder }}</option>
        <option value="" >select</option>
        <option v-if="options == 'week'"
          v-for="weekDay in weeks"
          v-bind:key="weekDay"
          v-text="weekDay"
          :value="weekDay"
          :selected="weekDay == modelValue"
        ></option>
        <option v-else-if="options == 'month'"
          v-for="month in months"
          v-bind:key="month"
          v-text="month"
          :value="month"
          :selected="month == modelValue"
        ></option>
        <option v-else-if="options == 'gender'"
          v-for="gender in genders"
          v-bind:key="gender"
          v-text="gender"
          :value="gender"
          :selected="gender == modelValue"
        ></option>
        <option v-else-if="options == 'yn'"
          v-for="yesno in yn"
          v-bind:key="yesno"
          v-text="yesno"
          :value="yesno"
          :selected="yesno == modelValue"
        ></option>
        <option v-else-if="queryData"
          v-for="(option, index) in options"
          v-bind:key="option.id"
          :value="option[dataKey]"
          :selected="option.id == modelValue"
        >{{formatText(option)}}</option>
        <option v-else-if="Array.isArray(options)"
          v-for="(optionText ,index) in options"
          v-bind:key="snake_case(optionText)"
          v-text="optionText"
          :value="snake_case(optionText)"
          :selected="snake_case(optionText) == modelValue"
        ></option>
        <option v-else
          v-for="(optionText, optionValue ,index) in options"
          v-bind:key="optionValue"
          v-text="optionText"
          :value="optionValue"
          :selected="optionValue == modelValue"
        ></option>
      </select>
    <input-error v-if="error || errmsg" :message="errmsg" class="mt-2" />
  </div>
</template>

<script>
import InputError from '@/Shared/Components/Form/Simple/InputError.vue'
import FormLabel from '@/Shared/Components/Form/Simple/Label.vue'
export default {
  components: {
    InputError,
    FormLabel
  },
  props: {
    name: { type: String, required: false, default: "" },
    value: { type: String, required: false, default: "" },
    modelValue: { type: [String, Number], required: false, default: "" },
    placeholder: { type: String, required: false, default: "" },
    inputClass: { type: String, required: false, default: "" },
    inputStyle: { type: String, required: false, default: "" },
    options: { type: [Array, Object, String], required: true },
    label: { type: String, required: false, default: "" },
    validation: { type: String, default: "" },
    lableClass: { type: String, required: false, default: "" },
    queryData: { type: Boolean, default: false },
    dataKey: { type: String, default: 'id' },
    dataText: { type: [Array, Object, String], default: 'name' },
    error: { type: Boolean, default: false },
    errmsg: { type: String, default: "" }
  },

  data() {
    return {
      show: false ,
      weeks: [ 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday' ],
      months: [ 'january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october','november','december' ],
      yn: [ 'yes', 'no' ],
      genders: [ 'male', 'female' ]
    };
  },
  methods: {
    selectChange(val) {
      this.$emit("update:modelValue", val);
    },
    formatText(option){

      if (typeof this.dataText == 'string') {
        return option[this.dataText];
      }else{
         let text = [];
         for (var i = 1 ; i < this.dataText.length ; i++) {
            text.push(option[this.dataText[i]]);
         }
         return text.join(this.dataText[0]);
      }
    },

    snake_case(text){
      if (text.length == 1) {
        return text;
      }
          return text.trim()
                .toLowerCase()
                .replaceAll('.' , '_')
                .replaceAll('-' , '_')
                .replaceAll(',' , '')
                .replaceAll(')' , '_')
                .replaceAll('(' , '_')
                .replaceAll('/' , '_')
                .replaceAll(' ' , '_')
                .replaceAll('___' , '_')
                .replaceAll('__' , '_')
                ;
        }
    }

    /*
      examples
      for sql data
      queryData
      dataKey="id"
      :dataText="[' - ', 'code', 'name']" or dataText="name"
    */

};
</script>
