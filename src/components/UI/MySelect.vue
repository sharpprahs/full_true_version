<!-- <template>
  <select class="outline-none" v-model="selectedDannie" @change="changeOption">
    <option disabled value="">Выберите из списка</option>
    <option
     v-for="option in options"
     :key="option.value" 
     :value="option.value">
      {{ option.name }}
    </option>
  </select>
</template>

<script>
export default {
  name: "MySelect",
  props: {
    options: {
      type: Array,
      default: () => []
    },
  },
  data() {
      return {
        selectedDannie: this.dannie || "",
      }
    },
  methods:{
  changeOption(){
   this.$emit('update:dannie', this.selectedDannie)
  }
  }
};
</script>

<style scoped></style> -->
