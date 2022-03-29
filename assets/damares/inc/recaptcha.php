<script src="https://www.google.com/recaptcha/api.js?render=YOUR_PUBLIC_RECAPTCHA_HERE"> </script>

<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('YOUR_PUBLIC_RECAPTCHA_HERE', {
            action: 'submit'
        }).then(function(token) {
            var recaptchaResponse = document.getElementById('recaptchaResponse');
            recaptchaResponse.value = token;
        });
    });
</script>