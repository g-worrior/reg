Query.validator.addMethod(
    "noSpace",
    function (value, element) {
        return value == "" || value.trim().length != 0;
    },
    "No space please and don't leave it empty"
);
jQuery.validator.addMethod(
    "customEmail",
    function (value, element) {
        return (
            this.optional(element) ||
            /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(
                value
            )
        );
    },
    "Please enter valid email address!"
);
$.validator.addMethod(
    "alphanumeric",
    function (value, element) {
        return this.optional(element) || /^\w+$/i.test(value);
    },
    "Letters, numbers, and underscores only please"
);
var $registrationForm = $("#form");
if ($registrationForm.length) {
    $registrationForm.validate({
        rules: {
            fullname: {
                required: true,
                alphanumeric: true,
            },
            phonenumber: {
                required: true,
            },
            gender_id: {
                required: true,
            },
            district_id: {
                required: true,
                noSpace: true,
            },
            email: {
                required: true,
                customEmail: true,
            },
            password: {
                required: true,
            },
            password_confirmation: {
                required: true,
                equalTo: "#password",
            },
            business_name: {
                required: true,
                noSpace: true,
            },
            business_type_id: {
                required: true,
                noSpace: true,
            },
            category_id: {
                required: true,
                noSpace: true,
            },
            tax: {
                required: true,
            },
            certificate: {
                required: true,
            },
        },
        messages: {
            fullname: {
                required: "Please enter username!",
            },
            phonenumber: {
                required: "Please enter phonenumber",
            },
            gender_id: {
                required: "Please select your gender!",
            },
            district_id: {
                required: "Please select location of operation!",
            },
            email: {
                required: "Please enter email!",
                email: "Please enter valid email!",
            },
            password: {
                required: "Please enter password!",
            },
            password_confirmation: {
                required: "Please enter confirm password!",
                equalTo: "Please enter same password!",
            },
            business_name: {
                required: "Please enter the name of your business!",
            },
            business_type_id: {
                required: "Please select the type of business!",
            },
            category_id: {
                required: "Please select business category!",
            },
            tax: {
                required: "Please upload your business tax clearance certificate",
            },
            certificate: {
                required: "Please upload your business certificate"
            },
        },
        errorPlacement: function (error, element) {
            if (element.is(":radio")) {
                error.appendTo(element.parents(".gender"));
            } else if (element.is(":checkbox")) {
                error.appendTo(element.parents(".hobbies"));
            } else {
                error.insertAfter(element);
            }
        },
    });
}
