import $ from 'jquery';

$(document)
    .on('submit', e => {
        e.preventDefault();
        const $target = $(e.target).closest('form');
        $.ajax({
            url: '/ajax/sendform',
            data: $target.serialize(),
            type: "POST",
            success: data => {
                const $error = $target.find('.b-error');
                const $flashes = $target.find('.b-flashes');
                $error.find('.b-wrapper').empty();
                $flashes.find('.b-wrapper').empty();

                if (data.status) {
                    $('#get-flash').iziModal('open', {
                        transition: 'fadeInDown'
                    });
                    $target.get(0).reset();
                } else {
                    for (let e in data.errors) {
                        $error
                            .find('.b-wrapper')
                            .append(
                                `<div class="b-error__item">${
                                    data.errors[e]
                                    }</div>`
                            );
                    }
                }
            }
        });
    });
