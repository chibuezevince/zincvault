$(function () {
    $('#adminLocalTransfer').submit(function (e) { 
        e.preventDefault();
        var formData =  new FormData(this);
        $.ajax({
            type: "post",
            url: "/admin/transfer/local",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            beforeSend:function(){
                $("#done").hide();
                $("#loading").show();
            },
            success: function (response) {
                $("#done").show();
                $("#loading").hide();
                $.each(response.errors, function (key, value) 
                { 
                    iziToast.error({
                        message: value,
                        position: 'topRight',
                    });
                });
                if (response.success) {
                    iziToast.success({
                        message: response.success,
                        position: 'topRight',
                    });
                }
            }
        });
    });
    $('#settingsForm').submit(function (e) { 
        e.preventDefault();
        var formData =  new FormData(this);
        $.ajax({
            type: "post",
            url: "/admin/site_settings/update",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            beforeSend:function(){
                $("#done").hide();
                $("#loading").show();
            },
            success: function (response) {
                $("#done").show();
                $("#loading").hide();

                $.each(response.errors, function (key, value) 
                { 
                    iziToast.error({
                        message: value,
                        position: 'topRight',
                    });
                });

                if (response.success) {
                    iziToast.success({
                        message: response.success,
                        position: 'topRight',
                    });
                }
            }
        });
    });
    $('#credDebForm').submit(function (e) { 
        e.preventDefault();
        var formData =  $('#credDebForm').serializeArray();
        $.ajax({
            type: "POST",
            url: "/admin/user/cred_deb",
            data: formData,
            dataType: "json",
            beforeSend:function(){
                $("#creddeb_done").hide();
                $("#creddeb_loading").show();
            },
            success: function (response) {
                $("#creddeb_done").show();
                $("#creddeb_loading").hide();

                $.each(response.errors, function (key, value) { 

                    $('#credDebError').show();
                    $('#credDebError').append('<span>'+value+'</span>'+'<br>');
                    $('#credDebError').fadeOut(2000, 'swing');

                    setTimeout(function() {
                       $('#credDebError').empty();
                   }, 3000);
                });

                if (response.success) 
                {
                  iziToast.success({
                      message: response.success,
                      position: 'topRight',
                  });
                  $("#creddeb_done").show();
                  $("#creddeb_loading").hide();
                  setTimeout(function() {
                    location.reload();
                }, 1000);
                }
            },
            error:function(){
                alert('error')
            }
        });
    });
    $('#adminPasswordForm').submit(function (e) { 
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: "/admin/user/password",
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            beforeSend:function(){
                $("#pass_done").hide();
                $("#pass_loading").show();
            },
            success: function (response) {
                $.each(response.errors, function (key, value) { 
                 $('#passwordError').show();
                 $("#pass_done").show();
                $("#pass_loading").hide();
                 $('#passwordError').append('<span>'+value+'</span>'+'<br>');
                 setTimeout(function() {                                $('#passwordError').fadeOut(3000, 'swing');
                 $('#passwordError').fadeOut(1000, 'swing');
                }, 2000);
                setTimeout(function()
                {
                    $('#passwordError').empty();
                }, 5000);
                 
               });
               if (response.password_changed) 
               {
                 iziToast.success({
                     message: response.password_changed,
                     position: 'topRight',
                 });
                 $("#pass_done").show();
                 $("#pass_loading").hide();
               }
            },
            error: function (response) {
                $("#pass_loading").hide();
                $("#pass_done").show();
                alert('No');
            }
        });
    });
    $('#adminBasicInfoForm').submit(function(e){
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: "/admin/user/basic_info",
            dataType: 'json',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend:function(){
                $("#done").hide();
                $("#loading").show();
            },
            success: function(response){
               $.each(response.errors, function (key, value) { 
                 $('#basicInfoError').show();
                 $("#done").show();
                 $("#loading").hide();
                 $('#basicInfoError').append('<span>'+value+'</span>'+'<br>');
                 $('#basicInfoError').fadeOut(2000, 'swing');
                 setTimeout(function() {
                    $('#basicInfoError').empty();
                }, 3000);
                 
               });

               if (response.success) 
               {
                iziToast.success({
                    message: response.success,
                    position: 'topRight',
                });
                $("#done").show();
                $("#loading").hide();
               }
            },
            error: function(data){
                alert('error');
            }
        });
    });

    $("#avatar").change(function(){
        $('#submitButton').show();
        $('#adminAvatarUpload').submit(function(e){
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: "/admin/user/avatar",
            dataType: 'json',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){
                iziToast.success({
                message: data.avatar,
                position: 'topRight',
            });
            setTimeout(function() {
                location.reload();
            }, 1000);
            },
            error: function(data){
                iziToast.error({
                title: 'Upload Error',
                message: data.avatar,
                position: 'topRight'
            });
            }
        });
    });
});

    $('#internationalTransferForm').submit(function (e) { 
        e.preventDefault();
        var formData =  $('#internationalTransferForm').serializeArray();
        $.ajax({
            type: "post",
            url: "/dashboard/transfer/international",
            data: formData,
            dataType: "json",
            beforeSend: function(){
                $('#transferDone').hide();
                $('#transferLoading').show();
            },
            success: function (response) {
                $.each(response.errors, function (key, value) { 
                    $('#transferError').show();
                    $('#transferError').append('<span>'+value+'</span>'+'<br>');
                    $('#transferError').fadeOut(4000, 'swing');
                    setTimeout(() => {
                        $('#transferError').empty();
                    }, 4500);
                    $('#transferDone').show();
                    $('#transferLoading').hide();
                }); 

                if (response.insufficient_amount) {
                    $('#transferError').fadeIn(100);
                    $('#transferError').append(response.insufficient_amount);
                    $('#transferError').fadeOut(3000);
                    $("#transferDone").show();
                    $("#transferLoading").hide();
                    setTimeout(function() {
                        $('#transferError').empty();
                    }, 3000);
                }
                if (response.success) {
                    $('#transferSuccess').fadeIn(100);
                    $('#transferSuccess').append(response.success);
                    $('#transferSuccess').fadeOut(3000);
                    $("#transferDone").show();
                    $("#transferLoading").hide();
                    setTimeout(function() {
                        $('#transferSuccess').empty();
                    }, 3000);
                }
            },
            error: function(response){
                alert('Error');
                $("#transferDone").show();
                $("#transferLoading").hide();
            }
        });
    });

    $('#exchange_amount').on('keyup keypress blur change',function () 
    {
        var currency_from = $('#currency_from').find(":selected").val();
        var currency_to = $('#currency_to').find(":selected").val();
        if (currency_from=="") 
        {
            iziToast.error({
                message: 'Please, Select the Exchange From',
                position: 'topRight'
            });
        }
        else if(currency_to=="")
        {
            iziToast.error({
                message: 'Please, Select the Exchange To',
                position: 'topRight'
            });
        }
        else
        {
            var formData =  $('#exchangeForm').serializeArray();
            $.ajax({
                type: "GET",
                url: "/dashboard/exchange/exchangeamount",
                data: formData,
                dataType: "json",
                success: function (response) {
                    $('#exchanged_amount').val(response.exchanged_amount);
                }
            });
        }
    });

    $('#exchangeForm').submit(function (e) { 
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-XSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var formData =  $('#exchangeForm').serializeArray();
        $.ajax({
            type: "POST",
            url: "/dashboard/exchange",
            data: formData,
            dataType: "json",
            beforeSend: function(){
                $('#sendExchange').hide();
                $('#exchangeLoading').show();
            },
            success: function (response) {
                $.each(response.errors, function (key, value) { 
                    $('#exchangeError').show();
                    $('#exchangeError').append('<span>'+value+'</span>'+'<br>');
                    $('#exchangeError').fadeOut(4000, 'swing');
                    setTimeout(() => {
                        $('#exchangeError').empty();
                    }, 4500);
                    $('#sendExchange').show();
                    $('#exchangeLoading').hide();
                });
                if (response.insufficient_amount) {
                    $('#exchangeError').fadeIn(100);
                    $('#exchangeError').append(response.insufficient_amount);
                    $('#exchangeError').fadeOut(3000);
                    $("#sendExchange").show();
                    $("#exchangeLoading").hide();
                    setTimeout(function() {
                        $('#exchangeError').empty();
                    }, 3000);
                }
                if (response.success) {
                    $('#exchangeSuccess').fadeIn(100);
                    $('#exchangeSuccess').append(response.success);
                    $('#exchangeSuccess').fadeOut(3000);
                    $("#sendExchange").show();
                    $("#exchangeLoading").hide();
                    setTimeout(function() {
                        $('#exchangeSuccess').empty();
                    }, 3000);
                }
            },
            error: function(response){
                alert('error');
                $("#sendExchange").show();
                $("#exchangeLoading").hide();
            }
        });
    });

    $("#receiver_account_number").on('keyup keypress blur change', function () { 
      $.ajax({
      type: "GET",
      url: "/dashboard/retrieve",
      dataType: "json",
      data: {
              _token: $("#csrf").val(),
              data : $('#receiver_account_number').val()
              },
      success: function (response) {
        $('#receiver_info_box').show();
        $('#receiver_info').val(response.test);
      }
    });
  });
  $("#amount_info").keyup(function () { 
      $.ajax({
      type: "GET",
      url: "/test",
      dataType: "json",
      data: {
              _token: $("#csrf").val(),
              amount : $('#amount_info').val()
              },
      success: function (response) {
        $('#amount_info_box').show();
        $('#amount_info').val(response.test);
      }
    });
  });
});

$(document).ajaxStart(function() { Pace.restart(); });
paceOptions = {
    ajax: true,
    document: false,
    eventLag: false,
    restartOnRequestAfter: true,
    elements: {
        selectors: ['.my-page']
    }
};
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#avatar").change(function(){
        $('#submitButton').show();
        $('#avatarUpload').submit(function(e){
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: "/dashboard/profile/avatar",
            dataType: 'json',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){
                iziToast.info({
                message: data.avatar,
                position: 'topRight',
            });
            setTimeout(function() {
                location.reload();
            }, 2000);
            },
            error: function(data){
                iziToast.error({
                title: 'Upload Error',
                message: data.avatar,
                position: 'topRight'
            });
            }
        });
    });
});

$('#basicInfoForm').submit(function(e){
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: "/dashboard/profile/basic_info",
            dataType: 'json',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend:function(){
                $("#done").hide();
                $("#loading").show();
            },
            success: function(response){
               $.each(response.errors, function (key, value) { 
                 $('#basicInfoError').show();
                 $("#done").show();
                $("#loading").hide();
                 $('#basicInfoError').append('<span>'+value+'</span>'+'<br>');
                $('#basicInfoError').fadeOut(2000, 'swing');
                 setTimeout(function() {
                    $('#basicInfoError').empty();
                }, 3000);
                 
               });

               if (response.success) 
               {
                $('#basicInfoSuccess').fadeIn(100);
                $('#basicInfoSuccess').append(response.success);
                $('#basicInfoSuccess').fadeOut(3000);
                $("#done").show();
                $("#loading").hide();
                setTimeout(function() {
                    $('#basicInfoSuccess').empty();
                }, 3000);
               }
            },
            error: function(data){
                alert('error');
            }
        });
    });

    $('#passwordForm').submit(function (e) { 
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: "/dashboard/profile/password",
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            beforeSend:function(){
                $("#pass_done").hide();
                $("#pass_loading").show();
            },
            success: function (response) {
                $.each(response.errors, function (key, value) { 
                 $('#passwordError').show();
                 $("#pass_done").show();
                $("#pass_loading").hide();
                 $('#passwordError').append('<span>'+value+'</span>'+'<br>');
                 setTimeout(function() {                                
                 $('#passwordError').fadeOut(3000, 'swing');
                 $('#passwordError').fadeOut(1000, 'swing');
                }, 2000);
                setTimeout(function()
                {
                    $('#passwordError').empty();
                }, 5000);
                 
               });
            if (response.incorrect_password) 
               {
                $('#passwordError').fadeIn(100);
                $('#passwordError').append(response.incorrect_password);
                $('#passwordError').fadeOut(3000);
                $("#pass_done").show();
                $("#pass_loading").hide();
                setTimeout(function() {
                    $('#passwordError').empty();
                }, 3000);
               }
               if (response.password_changed) 
               {
                 iziToast.success({
                     message: response.password_changed,
                     position: 'topRight',
                 });
                 $("#pass_done").show();
                 $("#pass_loading").hide();
               }
            },
            error: function (response) {
                $("#pass_loading").hide();
                $("#pass_done").show();
                alert('No');
            }
        });
    });

});