import $ from 'jquery';
import './vendor/iziModal';
import Inputmask from "inputmask/dist/inputmask/inputmask.numeric.extensions";
import './_sliders';
import './_menu';
import './_forms'

$(document)
    .ready(() => {
        /* map */
        ymaps.ready(mapInit);
        /* modals */
        $('.b-modal').iziModal({
            width: 'auto',
            overlayColor: 'rgba(0, 0, 0, 0.58)',
            padding: 0,
			focusInput: false
        });
		/* Active */
		const $field = $('.js-field');
		if ($field.length) {
			$field.each(function () {
				isActive($(this));
			});
		}
		/* Mask */
		const $phone = $('input[type="tel"]');
		if ($phone.length) {
			const im = new Inputmask('+7(999)999-99-99');
			$phone.each((index, elem) => im.mask(elem));
		}

    })
    /* info */
    .on('click', '.b-info__btn', e => {
        e.preventDefault();
        $.ajax({
            url: e.currentTarget.pathname,
            success: data => {
                if (data){
                    $('.content-modal').html(data);
                    $('#get-project').iziModal('open', {
                        transition: 'fadeInDown'
                    });
                }
            }
        });

    })

    /* Show more projects */
    .on('click', '.b-projects-more__btn', e => {
        e.preventDefault();
        $.ajax({
            url: e.currentTarget.pathname,
            success: data => {
                if (data.projects.length > 0) {
                    let timeout = 0;
                    for (let project in data.projects) {
                        setTimeout(() => { $('.projects-wrapper').append(data.projects[project]); }, timeout);
                        timeout += 100;
                    }
                    if (data.projects.length < 5) {
                        $(e.target).hide();
                    }
                    $(e.target).attr('href', 'projects/more/' + data.page);
                } else {
                    $(e.target).hide();
                }
            }
        })
    })

	/* menu btn */
    .on('click', '.b-hamburger', e => {
        let $target = $(e.target).closest('.b-hamburger'),
            elem = $target.attr('data-elem');

		$target.toggleClass('is-active');
		$(elem).toggleClass('is-active');
    })
	/* menu links */
    .on('click', 'a[href^="#"]:not([href="#"])', e => {
		e.preventDefault();
		const href = $(e.target).closest('a[href^="#"]:not([href="#"])').attr('href');

		$('html, body').animate(
			{ scrollTop: $(href).offset().top },
			500,
			() => (window.location.hash = href),
		)
    })
	/* Active */
	.on('input change', '.js-field', e => isActive($(e.target).closest('.js-field')))
    /* project slider */
    .on('opening', '.b-project-modal', e => {
        let $projectSlider = $(e.target).closest('.b-project-modal').find('.b-project-slider__slider');

        if( $projectSlider.length ) {
			$projectSlider.owlCarousel({
				items: 4,
				loop: true,
				dots: false,
				margin: 27,
				stagePadding: 50,
				autoplay: true,
				autoplaySpeed: $projectSlider.attr('data-speed'),
				responsive: {
					0 : {
						items: 2,
						margin: 20
					},
					768 : {
						items: 4,
						margin: 27
					}
				}
			});
        }
    });
/* Active */
const isActive = $field => {
	const $input = $field.parent('.b-form__elem');
	$field.val().length ? $input.addClass('is-active') : $input.removeClass('is-active');
};
/* map */
const mapInit = () => {
    let myMap = new ymaps.Map(
        'map',
        {
            center: window.matchMedia('(min-width: 769px)').matches ? [59.961390, 30.304433] : [59.961215, 30.292943], // Порядок по умолчнию: «широта, долгота».
            zoom: 15, // от 0 (весь мир) до 19.
            controls: [],
        },
        {
            searchControlProvider: 'yandex#search',
        }
        ),
        //метки
        spasskaya = new ymaps.Placemark([59.961215, 30.292943], {}, {
            iconLayout: 'default#image',
            iconImageHref: 'assets/images/map-marker.png',
            iconImageSize: [49, 69],
            iconImageOffset: [-24, -69]
        });

    myMap.geoObjects.add(spasskaya);
    myMap.behaviors.disable('scrollZoom');
};

