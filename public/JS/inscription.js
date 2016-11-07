$(function () {

    $.validator.addMethod('regexp', function (value, element, param) {
            return this.optional(element) || value.match(param);
        },
        'Le mot de passe doit contenir 8 caracteres dont une majuscule et un chiffre');


    $('#signup').validate({

        rules: {
            password: {
                regexp: /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[A-Z])[a-zA-Z\d@&#_!?$€-]{8,}$/
            },
            passwordValidate: {
                required: true,
                equalTo: "#password"
            },
            firstname: {
                required : true
            }
        },

        messages: {
            username : {
                required : "Username requis"
            },
            passwordValidate: {
                required: "Confirmez votre mot de passe",
                equalTo: "Mots de passe différents"
            },
            password: {
                required: "Mot de passe requis"
            },
            name: {
                required: "Nom requis"

            },
            firstname: {
                required: 'Prenom requis'
            },
            email: {
                required: "Email requis"
            },
            address: {
                required: "Adresse requise"
            },
            codepostal: {
                required: "Code postal requis",
                number: "Entrez un nombre valide"

            },
            city: {
                required: 'Ville requise'
            },
            birthday: {
                required : 'Date de naissance requise'
            }

        },

        errorClass: 'invalid',
        errorPlacement: function (error, element) {
            element.next("label").attr("data-error", error.contents().text());
            element.addClass('invalid');
        }

    });

    $("signup").submit(function (e) {

        var ref = $(this).find("[required]");

        $(ref).each(function () {
            if ($(this).val() == '') {
                $(this).addClass("invalid");
                $(this).focus();


                e.preventDefault();
                return false;
            }
        });
        return true;
    });


});


