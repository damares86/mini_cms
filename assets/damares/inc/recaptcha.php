<script src="https://www.google.com/recaptcha/api.js?render=6LeaSycfAAAAAMckQf9FeLQzFIdmIJoRsyKFHQEn"> </script>

<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('6LeaSycfAAAAAMckQf9FeLQzFIdmIJoRsyKFHQEn', {
            action: 'submit'
        }).then(function(token) {
            var recaptchaResponse = document.getElementById('recaptchaResponse');
            recaptchaResponse.value = token;
        });
    });
</script>