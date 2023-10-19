<!-- <template>
  <div class="post bg-black-var p-8 rounded-md">
    <div class="w-9/12 flex flex-col gap-2">
        <div><strong>Название: </strong>{{ post.title }}</div>
    <div><strong>Описание: </strong> {{ post.body }}</div>
    </div>
    <div class="post__btns">
      <MyButton
      class="special_btn"
      style="margin-right: 15px;"
       @click="$router.push(`/posts/${post.id}`)"
       >
        Открыть
       </MyButton>
       <MyButton
       style="background-color: rgb(239 68 68);"
       @click="$emit('remove',post)"
       >
        Удалить
       </MyButton>
    </div>

  </div>
</template>

<script>
export default {
    props: {
        post:{
            type: Object,
            required: true,
        }
    }
};
</script>

<style scoped>
.post {
  margin-top: 15px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.post__btns{
  display: flex;
}
.special_btn{
  background-color: rgb(5 150 105);
}
.special_btn:hover{
  background-color: rgb(5 150 105)!important;
}
</style> -->
