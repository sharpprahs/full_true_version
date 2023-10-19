<template>
  <div class="quill_container">
    <div ref="quillEditor"></div>
  </div>
</template>

<script>
import Quill from 'quill';
import 'quill/dist/quill.snow.css';

export default {
    props: {
        data: Object,
    },
    mounted() {

        const quill = new Quill(this.$refs.quillEditor, {
            theme: 'snow',
            direction: 'rtl',
            modules: {
                toolbar: [
                    [{ font: [] }],
                    [{ align: [] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ color: [] }, { background: [] }],
                    [{ list: 'ordered' }, { list: 'bullet' }],
                    ['blockquote', 'code-block'],
                    ['link', 'image'],
                    [{ header: '1' }, { header: '2' }],
                    ['clean'],
                ],
            },
        });

        quill.on('text-change', () => {
            const html = this.$refs.quillEditor.children[0].innerHTML;
            this.$emit('update', html);
        });

        // Set the initial value from props.data.value
        quill.root.innerHTML = this.data.value || '';
        // quill.format('direction', 'rtl');
        this.quill = quill;
    },
    watch: {
        'data.value': function (newVal) {
            // Update the Quill Editor's value when props.data.value changes
            this.quill.root.innerHTML = newVal || '';
        },
    },
};
</script>

<style scoped>
</style>
