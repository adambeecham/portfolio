import gsap from 'gsap'
import barba from '@barba/core'
import { scrollUpdate, snapToTop } from './locomotiveScroll.js';

const initBarba = () => {

  barba.init({
    debug: true,
    prevent: ({ el }) => el.classList.contains('ab-item'),
    transitions: [{
      name: 'basic-transition',
      once(data) {

      },
      leave(data) {
        const done = this.async()
        setTimeout(function() {
          done()
        }, 800)
        return gsap.to(data.current.container, { duration: 0.3, opacity: 0 })
      },
      after(data) {
        return gsap.from(data.next.container, { duration: 0.3, opacity: 0 })
      }
    }]
  })

  barba.hooks.after((data) => { })

}

export default initBarba