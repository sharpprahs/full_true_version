<template>
    <div>
        <label :for="data.name" class="custom-file-upload">{{
                data.placeholder
            }}</label>
        <input
            :name="data.name"
            :id="data.name"
            type="file"
            ref="fileInput"
            style="display:none"
            @change="handleFileChange"
        />
        <div class="input_selected_file">{{ selectedFileName }}</div>
    </div>
</template>

<script>
export default {
    name: "UInput_file",
    props: {
        data: Object,
    },
    data() {
        return {
            base64: null,
            selectedFileName: "",
        };
    },
    methods: {
        // openFileInput() {
        //     this.$refs.fileInput.click();
        // },
        handleFileChange() {
            const fileInput = this.$refs.fileInput;
            if (fileInput.files.length > 0) {
                this.selectedFileName = "Выбранный файл: " + fileInput.files[0].name;
                this.readFile(fileInput.files[0]);
            } else {
                this.selectedFileName = "";
            }
        },
        readFile(file) {
            const reader = new FileReader();
            reader.onload = (event) => {
                // Отправьте base64-код файла в родительский компонент
                const result = {
                    fileName: file.name,
                    base64: event.target.result,
                };
                this.$emit("update", result);
            };
            reader.readAsDataURL(file);
        },
    },
};
</script>

<style scoped>
</style>
