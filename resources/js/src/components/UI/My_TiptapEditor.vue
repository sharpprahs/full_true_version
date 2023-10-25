<template>
    <div class="editor_container">
    <div class="editor_tabs" v-if="editor">
        <button class="code_block" @click="editor.chain().focus().toggleCodeBlock().run()" :class="{ 'is-active': editor.isActive('codeBlock') }">
            <span>code block</span>
        </button>
        <button class="undo undo_reverse" @click="editor.chain().focus().undo().run()" :disabled="!editor.can().chain().focus().undo().run()">
            <img
                src="@/assets/images/undo_right2.svg"
                alt="закрыть панель"
            />
        </button>
        <button  class="undo"  @click="editor.chain().focus().redo().run()" :disabled="!editor.can().chain().focus().redo().run()">
            <img
                src="@/assets/images/undo_right2.svg"
                alt="закрыть панель"
            />
        </button>
        <button class="meta_title_h" @click="editor.chain().focus().toggleHeading({ level: 1 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 1 }) }">
            h1
        </button>
        <button class="meta_title_h" @click="editor.chain().focus().toggleHeading({ level: 2 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 2 }) }">
            h2
        </button>
        <button class="meta_title_h" @click="editor.chain().focus().toggleHeading({ level: 3 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 3 }) }">
            h3
        </button>
        <button class="meta_title_h" @click="editor.chain().focus().toggleHeading({ level: 4 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 4 }) }">
            h4
        </button>
        <button class="meta_title_h" @click="editor.chain().focus().toggleHeading({ level: 5 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 5 }) }">
            h5
        </button>
        <button class="meta_title_h" @click="editor.chain().focus().toggleHeading({ level: 6 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 6 }) }">
            h6
        </button>
        <button @click="editor.chain().focus().toggleBold().run()" :disabled="!editor.can().chain().focus().toggleBold().run()" :class="{ 'is-active': editor.isActive('bold') }">
           Жирный текст <strong>Bold</strong>
        </button>
        <button @click="editor.chain().focus().toggleItalic().run()" :disabled="!editor.can().chain().focus().toggleItalic().run()" :class="{ 'is-active': editor.isActive('italic') }">
          Курсивый текст  <i>Italic</i>
        </button>
        <button @click="editor.chain().focus().toggleStrike().run()" :disabled="!editor.can().chain().focus().toggleStrike().run()" :class="{ 'is-active': editor.isActive('strike') }">
            Зачеркнутый <s>Strike</s>
        </button>
        <button @click="editor.chain().focus().toggleCode().run()" :disabled="!editor.can().chain().focus().toggleCode().run()" :class="{ 'is-active': editor.isActive('code') }">
            code
        </button>
        <button @click="editor.chain().focus().unsetAllMarks().run()">
            Очистить
        </button>
        <button @click="editor.chain().focus().clearNodes().run()">
            clear nodes
        </button>
        <button @click="editor.chain().focus().setParagraph().run()" :class="{ 'is-active': editor.isActive('paragraph') }">
            paragraph
        </button>
        <button @click="editor.chain().focus().toggleBulletList().run()" :class="{ 'is-active': editor.isActive('bulletList') }">
            Список маркированный
        </button>
        <button @click="editor.chain().focus().toggleOrderedList().run()" :class="{ 'is-active': editor.isActive('orderedList') }">
            Список упорядоченный
        </button>

        <button @click="editor.chain().focus().toggleBlockquote().run()" :class="{ 'is-active': editor.isActive('blockquote') }">
            blockquote
        </button>
        <button @click="editor.chain().focus().setHorizontalRule().run()">
            Горизонталь
        </button>
        <button @click="editor.chain().focus().setHardBreak().run()">
            Жёсткий разрыв
        </button>
    </div>
        <div class="editor_content_container">
            <editor-content :editor="editor" class="editor_content"/>
        </div>
    </div>
</template>


<script>
import { Editor, EditorContent } from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'
export default {
    components: {
        EditorContent,
    },
    props: {
        data: Object,
    },
    data() {
        return {
            editor: null,
        }
    },
    emits: ['update'], // Объявление события 'update'
    mounted() {
        this.editor = new Editor({
            content: this.data.value,
            extensions: [
                StarterKit,
            ],
        })
        this.editor.on('update', () => {
            const content = this.editor.getHTML();
            this.$emit('update', content);
        })
    },

    beforeUnmount() {
        this.editor.destroy()
    },
}
</script>

<style scoped>

</style>
