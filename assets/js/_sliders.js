import $ from 'jquery';
import 'owl.carousel';

$(document)
	.ready(() =>{

		const $objectsSlider = $('.b-objects-slider__slider');
		/* objects */
		if($objectsSlider.length) {
			$objectsSlider.owlCarousel({
				items: 1,
				loop: true,
				dotsContainer: '.b-objects-slider__dots',
				margin: 126,
				stagePadding: 126,
				autoplay: true,
				autoplaySpeed: $objectsSlider.attr('data-speed'),
				responsive: {
					0 : {
						stagePadding: 20
					},
					768 : {
						stagePadding: 126
					}
				}
			});
		}
	})
	/* Arrow */
	.on('click', '.b-slider-arrow', e => {
		e.preventDefault();

		let $target = $(e.target).closest('.b-slider-arrow'),
			owlSelector = $target.attr('data-slider'),
			delay = $(owlSelector).attr('data-delay'),
			speed = $(owlSelector).attr('data-speed');

		if ($target.hasClass('b-slider-arrow__next')) {
			$(owlSelector).trigger('next.owl.carousel', [speed]);
		} else if ($target.hasClass('b-slider-arrow__prev')) {
			$(owlSelector).trigger('prev.owl.carousel', [speed]);
		}

		$(owlSelector).trigger('stop.owl.autoplay');
		$(owlSelector).trigger('play.owl.autoplay', [delay, speed]);

	})
	/* projects */
	.on('click', '.b-project-slider__img', e => {
		let $target = $(e.target).closest('.b-project-slider__img'),
			url = $target.css('background-image').replace('url(','').replace(')','').replace(/\"/gi, ""),
			$hero = $target.parents('.b-project-slider__content').siblings('.b-project-slider__hero');

		$hero.css('background-image', `url("${url}")`);
	});
