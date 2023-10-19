<template>
<div class="dialog" v-if="show" @click.stop="hideDialog">
<div @click.stop class="dialog__content">
    <slot>

    </slot>
</div>
</div>
  </template>
  
  <script>
  import toggleMixin from '@/mixins/toggleMixin';
  export default {
   name:'MyDialog',
   mixins: [toggleMixin],
   mounted() {
    console.log("dialog mounted")
   },
  };
  </script>
  
  <style scoped>
  .dialog{
    left: 0;
    top:0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.12);
    position: fixed;
    display: flex;
  }
  .dialog__content{
    padding: 20px 25px;
    margin: auto;
    background-color: white;
    border-radius: 12px;
    min-height: 50px;
    min-width: 300px;
  }
  </style>
  