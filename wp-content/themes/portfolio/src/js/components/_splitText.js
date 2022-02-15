import SplitText from '../libraries/SplitText.min.js'

export default function initSplitText() {

  const wordsToSplit = document.querySelectorAll('[data-split-words]'),
        charsToSplit = document.querySelectorAll('[data-split-chars]'),
        linesToSplit = document.querySelectorAll('[data-split-lines]')

  document.fonts.ready.then(() => {

    const wordSplit = new SplitText(wordsToSplit, { type: 'words', wordsClass: 'word' }),
          lineSplit = new SplitText(linesToSplit, { type: 'lines', linesClass: 'line' }),
          charSplit = new SplitText(charsToSplit, { type: 'chars', charsClass: 'char' })

    wordSplit.words.forEach(el => {
      const text = el.innerHTML
      const wrap = document.createElement('div')
      wrap.classList.add('word__wrap')
      wrap.innerHTML = text
      el.innerHTML = ''
      el.appendChild(wrap)
    })
    
  })
}