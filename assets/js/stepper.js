(function($){

    $(document).ready(function () {

        var payment_form = $('#payment-form');
        payment_form.on('submit', function (e) {
            e.preventDefault();
            Stripe.setPublishableKey('pk_test_r4OKXzDWyOYZhWl86lhZTrlA');

            Stripe.card.createToken( document.getElementById('payment-form'), function (status, response) {

                console.log( status );
                console.log( response );

                if ( response.error ) {
                    document.getElementById('payment-error').innerHTML = response.error.message;
                } else {
                    var tokenInput = document.createElement("input");
                    tokenInput.type = "hidden";
                    tokenInput.name = "stripeToken";
                    tokenInput.value = response.id;

                    var paymentForm = document.getElementById('payment-form');
                    paymentForm.appendChild(tokenInput);

                    //paymentForm.submit();

                    var data = paymentForm.serialize();

                    $.ajax({
                        url: cppay.ajaxurl,
                        method: 'POST',
                        beforeSend: function(xhr) {
                            xhr.setRequestHeader('X-WP-Nonce', cppay.nonce);
                        },
                        data: data
                    }).done(function(response) {
                        sessionStorage.setItem('social_name', social_name);
                        sessionStorage.setItem('social_name', social_price);
                        console.log( response );
                    }).fail(function(response) {

                        console.log(response);

                    }).always(function() {

                    });

                }
            } );
        })

        var social_card = $('.card-list__item');
        var social_channel = $('.button-card__item');
        var blog_posts = $('#blog-posts');
        var full_name = $('#full-name');
        var email_address = $('#email-address');
        var phone_number = $('#phone-number');
        var shippping_address = $('#shipping-address');
        var shipping_apartment = $('#shipping-apartment');
        var shipping_city = $('#shipping-city');
        var  state = $('#state');
        var zipcode = $('#zipcode');


        full_name.on('change', function (e){
            sessionStorage.setItem('full_name', $(this).val());
        });
        email_address.on('change', function (e){
            sessionStorage.setItem('email_address', $(this).val());
        });
        phone_number.on('change', function (e){
            sessionStorage.setItem('phone_number', $(this).val());
        });
        shippping_address.on('change', function (e){
            sessionStorage.setItem('shippping_address', $(this).val());
        });
        shipping_apartment.on('change', function (e){
            sessionStorage.setItem('shipping_apartment', $(this).val());
        });
        shipping_city.on('change', function (e){
            sessionStorage.setItem('shipping_city', $(this).val());
        });
        state.on('change', function (e){
            sessionStorage.setItem('state', $(this).val());
        });
        zipcode.on('change', function (e){
            sessionStorage.setItem('zipcode', $(this).val());
        });


        var next = $('.step-navigation__next');
        var prev = $('.step-navigation__prev');


        $(document).on('input change', '#blog_posts_word', function() {
            console.log( $(this).val() );
            $('#blog_posts_word_value').html( $(this).val() + ' words/post' );
            sessionStorage.setItem('blog_posts_word', $(this).val());
        });

        blog_posts.on('change', function (e){
            sessionStorage.setItem('blog_posts', $(this).val());
        });


        social_channel.on('click', function (){

            $(this).addClass('active').siblings().removeClass('active');
            var social_channel = $(this).data('social-channel');
            sessionStorage.setItem('social_channel', social_channel);
        });

        social_card.on('click', function (){

            $(this).addClass('current').siblings().removeClass('current');
            var social_name = $(this).find('#social').data('name');
            var social_price = $(this).find('#social').data('price');
            sessionStorage.setItem('social_name', social_name);
            sessionStorage.setItem('social_price', social_price);

            //var data = {social_name: social_name, social_price: social_price, action: 'set_session'};

            // $.ajax({
            //     url: cppay.ajaxurl,
            //     method: 'POST',
            //     beforeSend: function(xhr) {
            //         xhr.setRequestHeader('X-WP-Nonce', cppay.nonce);
            //     },
            //     data: data
            // }).done(function(response) {
            //     sessionStorage.setItem('social_name', social_name);
            //     sessionStorage.setItem('social_name', social_price);
            //     console.log( response );
            // }).fail(function(response) {
            //
            //     console.log(response);
            //
            // }).always(function() {
            //
            // });

        });

    });

})(jQuery);