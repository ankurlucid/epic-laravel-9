<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('theme') }}/img/apple-icon.png">
  <link rel="icon" type="image/png" href="{{ asset('theme') }}/img/favicon.png">
  <title>@yield('title', '') - {{app_name()}}</title>

  <meta name="_token" content="{{ csrf_token() }}" />
  <meta name="public_url" content="{{ asset('') }}">

  <meta name="description" content="@yield('meta_description', '')">
  <meta name="author" content="@yield('meta_author', '')">
  @yield('meta')

  @yield('before-styles-end')

  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('theme') }}/css/nucleo-icons.css" rel="stylesheet" />
  <link href="{{ asset('theme') }}/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('theme') }}/css/material-dashboard.css?v=3.0.1" rel="stylesheet" />

  @yield('plugin-css')

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="{{ asset('theme') }}/js/jquery.sparkline/jquery.sparkline.min.js"></script>
  <link rel="stylesheet" href="{{ asset('theme') }}/css/bootstrap-select/bootstrap-select.css">
        {!! Html::style('assets/plugins/select2/select2.css?v='.time()) !!}

  <link id="pagestyle" href="{{ asset('theme') }}/css/demo.css" rel="stylesheet" />
  <link id="pagestyle" href="{{ asset('theme') }}/css/new-styles.css" rel="stylesheet" />
    {!! Html::style('vendor/tooltipster-master/tooltipster.css?v='.time()) !!}
        {!! Html::style('assets/plugins/Jcrop/css/jquery.Jcrop.min.css?v='.time()) !!}

  @yield('required-styles-for-this-page')

  <style>

      .swal2-container {
          z-index: 999999 !important;
        }
  </style>

</head>
<body class="g-sidenav-show  bg-gray-200">

  @include('layouts.includes.sidebar')
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('layouts.includes.navbar')

        <div class="container-fluid py-4">

            @yield('content')

            @include('layouts.includes.footer')

        </div>
  </main>

    @include('layouts.includes.theme-setting')

    <script>
        var public_url = $('meta[name="public_url"]').attr('content');
    </script>



    <script src="{{ asset('theme') }}/js/core/popper.min.js"></script>
    <script src="{{ asset('theme') }}/js/core/bootstrap.min.js"></script>
    <script src="{{ asset('theme') }}/js/plugins/smooth-scrollbar.min.js"></script>
    <!-- Kanban scripts -->
    <script src="{{ asset('theme') }}/js/plugins/dragula/dragula.min.js"></script>
    <script src="{{ asset('theme') }}/js/plugins/jkanban/jkanban.js"></script>
    <script src="{{ asset('theme') }}/js/bootstrap-select/bootstrap-select.min.js"></script>
    {!! Html::script('assets/plugins/select2/select2.min.js?v='.time()) !!}

    <script src="https://parsleyjs.org/dist/parsley.js"></script>
        {!! Html::script('vendor/tooltipster-master/jquery.tooltipster.min.js?v='.time()) !!}
         {!! Html::script('vendor/jquery-validation/jquery.validate.min.js?v='.time()) !!}
    {!! Html::script('assets/plugins/Jcrop/js/jquery.Jcrop.min.js?v='.time()) !!}
    {!! Html::script('assets/plugins/Jcrop/js/script.js?v='.time()) !!}
    {!! Html::script('assets/plugins/Jcrop/js/posture-script.js?v='.time()) !!}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('required-script-for-this-page')

    @yield('script-after-page-handler')

    <script>
      var win = navigator.platform.indexOf('Win') > -1;
      if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
          damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
      }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('theme') }}/js/material-dashboard.min.js?v=3.0.1"></script>
    <script>
        $(document).ready(function(){

            $("#white-version").trigger('click');

        });
    </script>

    <script>
    var constraints = '';
    var modal_type = '';
    var modal_id = '';
    var url = window.location.href;
    var index = url.indexOf("#");
    if (index !== -1)
    {
    var hash = url.substring(index + 1);
    }

    if(hash == 'Before')
    {
        $("#Before").addClass('active');
        $("#Gallery").removeClass('active');
        $('#before-after-tab').trigger('click');
    }
    else if(hash == 'Gallery')
    {
        $("#Before").removeClass('active');
        $("#Gallery").addClass('active');
        $('#gallery-tab').trigger('click');
    }

    $("#gallery-tab").click(function()
    {
        // window.location.hash = 'Gallery';
    });
    $("#before-after-tab").click(function()
    {
        // window.location.hash = 'Before';
    });

    $('input').parsley();
    // $(window).load(function() {
    // $(".waitingShield").show();
    // setTimeout(function ()
    // {
    //     $(".waitingShield").hide();
    // },3000);
    // });
    setTimeout(function() {
    $('#success_message').fadeOut("slow");
    }, 3000 );
    var validImageTypes = ["image/jpeg","image/png","image/jpg"];

    $("#upload-gallery-images").change(function(){
    $("#valid_file_msg").hide();
    $('#preview-gallery-images').html("");

    var total_file=document.getElementById("upload-gallery-images").files.length;
    var valid_file = true;
    for(var i=0;i<total_file;i++)
    {
        var file = event.target.files[i];
        var fileType = file['type'];
        if($.inArray(fileType, validImageTypes) < 0)
        {
            valid_file = false;
        }
        else
        {
            $('#preview-gallery-images').append("<li><div class='row'><div class='col-md-3'><img src='"+URL.createObjectURL(event.target.files[i])+"' class='img-fluid'></div><div class='col-md-8'><input type='text' name='images_name[]' class='form-control' required  data-parsley-trigger='focusout' data-parsley-required-message='Image name is required' placeholder='Enter image name'> </div></div></li>");
        }
    }
        if(valid_file === true)
        {
            $("#gallery-images-modal").modal();
        }
        else
        {
            $('#preview-gallery-images').html("");
            $("#valid_file_msg").show();
        }
    });
    $('#upload-images-btn').click(function ()
    {
        var isValid = true;
        $('#gallery-images-modal input').each( function()
        {
            if ($(this).parsley().validate() !== true)
            {
                isValid = false;
            }
        });
        if(isValid)
        {
            $("#images_name").val($("input[name='images_name[]']").map(function(){return $(this).val();}).get());
            $('#add-gallery-image-form').submit();
            $(".waitingShield").show();
        }
    });

 /* Take photo from camera js */
    // Webcam.set({
    //     width: 320,
    //     height: 240,
    //     image_format: 'jpeg',
    //     jpeg_quality: 90,
    //     constraints: constraints,
    // });
    // $('.openWebcam').on('click',function(e) {
    //     capture_image_type = $(this).attr('data-item');
    //     if(capture_image_type === 'before' || capture_image_type === 'after' )
    //     {
    //         $('#'+capture_image_type+'-msg').empty();
    //         $('#'+capture_image_type+'-image-upload').val('');
    //     }
    // $('#webcam-modal').modal('show');
    // Webcam.attach('#camera');
    // });
    // $('.snap').on('click',function()
    // {
    //     Webcam.snap(function(data_uri)
    //     {
    //         $('#'+capture_image_type+'_success_message').empty();
    //         $('#'+capture_image_type+'-image-capture').val(data_uri);
    //         Webcam.reset();
    //         $('#webcam-modal').modal('hide');
    //         $('<span>'+'Photo uploaded successfully'+'</span>').appendTo("#"+capture_image_type+"_success_message").css('color','green');
    //     });
    // });
    // $('.close-webcam').click(function(){
    //     Webcam.reset();
    //     $('#webcam-modal').modal('hide');
    // });

    /* Manage image uload after and before */
    $('.add-before-after-btn').on('click',function(){
        modal_type = $(this).attr('data-type');
        title = $(this).attr('data-item');
        var before_after_id = $(this).attr('data-id');
        if(modal_type == 'edit')
        {
            $("#before-after-id").val(before_after_id);
            $("input[name='title']").val(title);
        }
        else
        {
            $("#before-after-id").val('');
            $("input[name='title']").val('');
        }
        $('#add-before-after-modal').modal();
    });
    var upload_image_type = ''
    $("input[type='file']").on('click',function()
    {
        upload_image_type = $(this).attr('data-item');
        upload_image_medium = $(this).attr('data-type');
        if(upload_image_type === 'before' || upload_image_type === 'after' )
        {
            $('#'+upload_image_type+'-image-'+upload_image_medium).change(function()
            {
                var validImageTypes = ["image/jpeg", "image/png","image/jpg"];
                var file = this.files[0]
                var fileType = file['type'];
                if($.inArray(fileType, validImageTypes) < 0)
                {
                    $('#'+upload_image_type+'_success_message').empty();
                   $('#'+upload_image_type+'-msg').empty();
                    $('#'+upload_image_type+'-image-upload').val('');
                    $('#'+upload_image_type+'-image-capture').val('');
                   $('<p>' + 'Image must be png,jpg,jpge type' + '</p>').appendTo("#"+upload_image_type+"-msg").css('color','red');
                }
                else
                {
                    $('#'+upload_image_type+'_success_message').empty();
                    $('<span>'+'Photo uploaded successfully'+'</span>').appendTo("#"+upload_image_type+"_success_message").css('color','green');
                    $('#'+upload_image_type+'-msg').empty();
                    if(upload_image_medium == 'upload')
                    {
                        $('#'+upload_image_type+'-image-capture').val(null);
                    }
                    else
                    {
                        $('#'+upload_image_type+'-image-upload').val(null);

                    }
                }

            });
        }
    });

    $('.before-after-save-btn').click(function ()
    {
        $("#before-msg").empty();
        $("#after-msg").empty();
        var  before_available = true;
        var  after_available = true;
        var  before_image_upload = $("#before-image-upload").val();
        var  before_image_capture = $("#before-image-capture").val();
        var  after_image_upload = $("#after-image-upload").val();
        var  after_image_capture = $("#after-image-capture").val();
        if(modal_type == 'add')
        {
            if(before_image_upload == '' && before_image_capture == '')
            {
                // before_available = false;
                // $('<p>' + 'Before image is required' + '</p>').appendTo("#before-msg").css('color','red');

            }
            if(after_image_upload == '' && after_image_capture == '')
            {
                // after_available = false;
                // $('<p>' + 'After image is required' + '</p>').appendTo("#after-msg").css('color','red');

            }
        }
        var isValid = true;
        $('#add-before-after-modal input').each( function()
        {
            if ($(this).parsley().validate() !== true)
            {
                isValid = false;
            }
        });
        if(isValid && before_available && after_available)
        {
            $('#add-before-after-form').submit();
            $(".waitingShield").show();
        }
    });

    $('#add-before-after-modal').on('hidden.bs.modal', function ()
    {
        $('#after-msg').empty();
        $('#before-msg').empty();
        $('.parsley-required').empty();
        $('#before_success_message').empty();
        $('#after_success_message').empty();
        $('#before-image-upload').val('');
        $('#after-image-upload').val('');
        $('#before-image-capture').val('');
        $('#after-image-capture').val('');
    });

    /* View afer-before uploaded image*/
    $('.view-after-before').on('click',function(){
        var modal_id = $(this).attr('data-id');
        $('#view-after-before-modal'+modal_id).modal();
    });


    /* --------- delete before-after --------------------*/
    $(document).on('click','.delete-before-after-btn', function ()
    {
        var before_after_id = $(this).attr('data-id');
        swal({
        title: "Do you want to delete?",
          type: 'warning',
          allowEscapeKey: false,
          showCancelButton: true,
          confirmButtonText: 'Yes',
          cancelButtonText:'No',
          confirmButtonColor: '#ff4401'
        },
        function(isConfirm) {
        if(isConfirm)
        {
            $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            method:"POST",
            url:"{{url('client/delete-before-after')}}",
            data :
            {
                before_after_id : before_after_id
            },
            success: function(data) {
                if(data.status == true)
                {
                    swal("Deleted!", "Your imaginary file has been deleted.", "success");
                    location.reload();
                }
            }
            });
        }
        else{
          swal("Cancelled", "Your file is safe", "error");
        }
        });
    });

    // setTimeout(function(){
    //         $('.alert-success').html('');
    //    }, 2000);

</script>

    {!! Html::script('assets/js/set-moment-timezone.js') !!}
    {!! Html::script('assets/js/lock-screen.js') !!}

</body>
</html>
