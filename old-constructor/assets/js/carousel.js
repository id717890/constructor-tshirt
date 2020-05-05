'use strict';
// класс карусели
class Carousel {
    constructor(slides, options = {
        "slideWidth": 400,
        "slideNumber": 1,
        "slideDelay": 2000,
        "sliderTimer": false,
        "sliderTimerDelay": 3000
    }) {
        this.slides = slides;
        this.options = options;
    }

    print() {
    	alert(this.slides);
    	alert(this.options);
    }
}

let carouselModels = new Carousel(["1", "2", "3"]);
carouselModels.print();