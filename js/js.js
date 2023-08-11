$(document).ready(function() {


    $("#regform").on("submit", function(e) {
        e.preventDefault();
        let name = $("#name").val();
        let email = $("#email").val();
        let pass = $("#pass").val();
        let passRepeat = $("#passRepeat").val();
        let regex = /^[a-zA-Z0-9\s]+$/;
        if (regex.test(name)) {
            if (pass !== passRepeat) {
                $(".err").html("Passwords dont match");
            } else {
                $.ajax({
                    url: "server.php",
                    method: "post",
                    dataType: "html",
                    data: {
                        name: name,
                        email: email,
                        pass: pass,
                        passRepeat: passRepeat,
                        action: "ajax"
                    },
                    success: function(r) {
                        console.log(r);
                        if (r === "oldemail") {
                            $(".err").html("email alredy in use");
                        }
                    }
                })
                $(".err").html("sccessfully registered");

            }
        } else {
            $(".err").html("enter corect simbols");
        }

    });



    $("#logform").on("submit", function(e1) {
        e1.preventDefault();
        let logemail = $("#logemail").val();
        let logpass = $("#logpass").val();
        $.ajax({
            url: "server.php",
            method: "post",
            dataType: "html",
            data: { logemail: logemail, logpass: logpass, action: 'ajax1' },
            success: function(r1) {
                console.log(r1);
                if (r1 === "welcome") {
                    window.location.href = "page.php";
                } else {
                    $(".welcome").html("uncorect email or password");
                }
            }
        })

    })



    $("#sendmessage").on("submit", function(e2) {
        e2.preventDefault();
        let send = $("#send").val();
        let num1 = Math.floor(Math.random() * 10);
        let num2 = Math.floor(Math.random() * 10);
        let num3 = Math.floor(Math.random() * 10);
        let num4 = Math.floor(Math.random() * 10);
        let code = num1.toString() + num2.toString() + num3.toString() + num4.toString();
        console.log(code);
        let text = code;
        $.ajax({
            url: 'server.php',
            type: 'post',
            data: { send: send, text: text, action: 'ajax2' },
            success: function(r2) {
                console.log(r2);

                $(".err").html("now enter code from your email");


            }
        })

    })


    $("#confirm").on("submit", function(e3) {
        e3.preventDefault();
        let forget = $("#forget").val();
        $.ajax({
            url: 'server.php',
            type: 'post',
            data: { forget: forget, action: 'ajax3' },
            success: function(r3) {
                console.log(r3);
                if (r3 === "chisht kod") {
                    window.location.href = "newpass.php";
                    $(".err1").html("well now create new password");
                }
            }
        })

    })



    $("#newpassword").on("submit", function(e4) {
        e4.preventDefault();
        let newpass = $("#newpass").val();
        let newpassrep = $("#newpassrep").val();

        if (newpass !== newpassrep) {
            $(".err3").html("Passwords dont match");
        } else {
            $.ajax({
                url: 'server.php',
                type: 'post',
                data: { newpass: newpass, action: 'ajax4' },
                success: function(r4) {
                    console.log(r4);
                    $(".err3").html("Password changed");

                }
            })
        }

    })


    $.ajax({
        type: 'POST',
        url: 'image.php',
        data: { action: 'get_image_path' },
        success: function(response) {
            if (response !== '') {
                $('#imagecontainer').html(response);
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    })




    $('#uploadform').on('submit', function(e14) {
        e14.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: 'image.php',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
                $('#imagecontainer').html(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        })
    })




    $("#admine").on("submit", function(e6) {
        e6.preventDefault();
        let newname = $("#adminenewname").val();
        let regex = /^[a-zA-Z0-9\s]+$/;
        if (regex.test(newname)) {
            if (newname === '') {
                $('.changename').html("name cant be null");
            } else {

                $.ajax({
                    url: "server.php",
                    type: "post",
                    data: { newname: newname, action: 'ajax6' },
                    success: function(r6) {
                        console.log(r6);
                        if (r6 === "good") {
                            $('.changename').html("Your name changed. Please refresh page");
                        }
                    }
                })
            }
        } else {
            $('.changename').html("enter correct symbols");

        }

    })



    $("#phoneform").on("submit", function(e11) {
        e11.preventDefault();
        let phone = $("#phone").val();

        $.ajax({
            url: "server.php",
            type: "post",
            data: { phone: phone, action: 'ajax11' },
            success: function(r11) {
                console.log(r11);

            }
        })

    })







    $('.description-view').on('click', function() {
        let descView = $(this);
        let descEdit = descView.next('.description-edit');
        let textarea = descEdit.find('.edit-textarea');
        descView.hide();
        descEdit.show();
        textarea.focus();
    });

    $('.save-description-btn').on('click', function() {
        let saveBtn = $(this);
        let descEdit = saveBtn.closest('.description-edit');
        let descView = descEdit.prev('.description-view');
        let textarea = descEdit.find('.edit-textarea');
        let productId = saveBtn.data('id');
        let newDescription = textarea.val();

        $.ajax({
            type: 'POST',
            url: 'products.php',
            data: {
                product_id: productId,
                product_description: newDescription
            },
            success: function(response7) {
                descView.text(newDescription);
            },
            error: function(xhr, status, error) {
                console.error('Failed to update description:', error);
            },
            complete: function() {
                descView.show();
                descEdit.hide();
            }
        });
    });




    $('.edit-image-btn').click(function() {
        const productId = $(this).data('id');
        const newImage = prompt('enter URL address for new image:');

        if (newImage) {

            if (newImage.startsWith('images/') && (newImage.endsWith('.jpg') || newImage.endsWith('.png') || newImage.endsWith('.jpeg'))) {
                $.ajax({
                    type: 'POST',
                    url: 'update_image.php',
                    data: {
                        product_id: productId,
                        product_image: newImage
                    },
                    success: function(response) {
                        alert(response);

                        const imgElement = $(this).closest('tr').find('img');
                        imgElement.attr('src', newImage);
                    },
                    error: function(xhr, status, error) {
                        alert('cant change image: ' + error);
                    }
                });
            } else {
                alert('enter correct URL (example, images/1.jpg)');
            }
        }
    })

    $('.product_quantity').on('submit', function(e12) {
        e12.preventDefault();

        let form = $(this);
        let count = form.find('.qtyform').val();
        let cartId = form.find('input[name="cart_id"]').val();

        $.ajax({
            url: 'count.php',
            type: 'post',
            data: { count: count, cart_id: cartId },
            dataType: 'json',
            success: function(response12) {
                console.log(response12);

                form.closest('.cart_item').find('.cart_item_price').html(response12.price + ' ' + 'USD');
            },
            error: function(error) {
                console.log(error);
            }
        });
    });




    $(".payment").submit(function(e13) {
        e13.preventDefault();

        let form = $(this);
        let payprid = form.find('input[name="payprid"]').val();
        let paymentMethod = form.find('input[name="paymentMethod"]:checked').attr("class");
        let payemail = $('.payemail').val();

        if (paymentMethod === "cash") {
            let card = $('.cash:checked').val();
            $.ajax({
                url: 'payment.php',
                type: 'post',
                data: { payprid: payprid, card: card, payemail: payemail },
                success: function(response13) {
                    console.log(response13);
                    if (response13 === "success") {
                        $('.conf').html("Your order successfully registered.");
                    }
                }
            });
        } else if (paymentMethod === "creditCard") {
            let card = $('.creditCard:checked').val();

            window.location.href = 'bank.php?payprid=' + payprid + '&card=' + card + '&payemail=' + payemail;
        }
    });



})
