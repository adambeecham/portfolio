import LocomotiveScroll from 'locomotive-scroll';
import gsap from 'gsap';

let scroll;

scroll = new LocomotiveScroll({
  el: document.querySelector('[data-scroll-container]'),
  smooth: true,
  offset: [0, 0]
});

export function snapToTop() {
  scroll.scrollTo('top', { duration: 0, disableLerp: true } )
}

export default function scrollUpdate() {
  scroll.update();
}