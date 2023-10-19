<template>
  <div>
    <br><br><br><br><br>
    <span id="typed-text" class="printed">{{ typedText }}</span>
    <br><br><br><br><br>
    <img src="../assets/images/blog.svg" alt="">
  </div>
</template>
   
<script>
export default {
  data() {
    return {
      texts: ["Работа над менюшкой в процессе..", "Идёт полным ходом..", "Скоро будет готово.."], // Массив с текстами
      textIndex: 0,
      charIndex: 0,
      isTyping: true,
      durationFirst: 6000, // Задержка перед стиранием текста (6 секунд)
      durationLast: 200, // Задержка перед печатью следующего текста (0.2 секунды)
      typedText: "", // Здесь будет отображаться перепечатываемый текст
    };
  },
  methods: {
    typeAndEraseText() {
      const currentText = this.texts[this.textIndex];
      const currentChar = currentText.charAt(this.charIndex);

      if (this.isTyping) {
        this.typedText += currentChar;
        this.charIndex++;
      } else {
        this.typedText = currentText.substring(0, this.charIndex);
        this.charIndex--;
      }

      if (this.charIndex === currentText.length) {
        this.isTyping = false;
        setTimeout(this.typeAndEraseText, this.durationFirst);
      } else if (this.charIndex === -1) {
        this.isTyping = true;
        this.textIndex = (this.textIndex + 1) % this.texts.length; // Переход к следующему тексту
        setTimeout(this.typeAndEraseText, this.durationLast);
      } else {
        setTimeout(this.typeAndEraseText, 100); // Интервал в миллисекундах между символами
      }
    },
  },
  mounted() {
    this.typeAndEraseText(); // Начнем печать и стирание текста при монтировании компонента
  },
};
</script>
   
<style scoped>
.printed {
  font-size: 22px;
  position: absolute;

}
</style>
   