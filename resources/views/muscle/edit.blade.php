@extends('layouts.app')

@section('required-styles-for-this-page')

    <!-- start: Bootstrap Select Master -->
    {!! Html::style('theme/vendor/bootstrap-select-master/css/bootstrap-select.min.css?v='.time()) !!}
    <!-- end: Bootstrap Select Master -->
    {!! Html::style('theme/vendor/sweetalert/sweet-alert.css?v='.time()) !!}


@endsection
@section('title', 'Muscles List')

@section('breadcum')

    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dashboard.show') }}">Home</a></li>
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Edit Muscle</li>

@endsection

@section('breadcumTitle')

    <h6 class="font-weight-bolder mb-0">Edit Muscle</h6>

@endsection

@section('content')
	<div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <h5 class="mb-0">Edit Muscle</h5>
                </div>
                <div class="col-12 text-end">
                    <a class="btn bg-gradient-dark mb-0 me-4" href="{{ route('muscle.list') }}">Back to list</a>
                </div>
                <div class="card-body">
                    <form method='POST' action='{{ route('muscle.update', $muscle->id) }}' class='FromSubmit d-flex flex-column align-items-center' enctype="multipart/form-data" id="add_muscle">
                    	@csrf
	                        {{-- <div class="avatar avatar-xxl position-relative">
	                            <div class="position-relative preview">
	                                <label for="file-input"
	                                    class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
	                                    <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top"
	                                        title="" aria-hidden="true" data-bs-original-title="Select Cover Image"
	                                        aria-label="Select Image"></i><span class="sr-only">Select Cover Image</span>
	                                </label>
	                                <span class="h-12 w-12 rounded-full overflow-hidden bg-gray-100">
	                                    <img src="{{ $muscle->getMuscleCoverImageUrl() }}" alt="avatar"
	                                        id="file-ip-1-preview"></span>

	                                <input type="file" name='cover_image' id="file-input" onchange="showPreview(event, 'file-ip-1-preview');"
	                                    >
	                                <p class='text-danger inputerror' id="cover_image_error"> </p>
	                            </div>

	                        </div> --}}
                        <div class="form-group col-12 col-md-6 mt-3">

                            <label for="exampleInputname">Select Cover Image</label>
                            <input type="hidden" name="cover_image" class="cover_image" />
                                <div id="my-dropzone" class="dropzone shadow"></div>
                        </div>

                        <div class="form-group col-12 col-md-6 mt-3">

                            <label for="exampleInputname">Muscle Name</label>
                            <input type="name" name='title' class="form-control border border-2 p-2"
                                id="exampleInputname" placeholder="Enter Muscle Name" value={{ $muscle->title }}>
                                <p class='text-danger inputerror' id="title_error"> </p>
                        </div>


                        <div class="form-group col-12 mt-2 col-md-6">
                            <label for="description">Region</label>
                            <textarea class="editor-content editor" name="region">
                               {{ $muscle->region }}
                            </textarea>
                               <p class='text-danger inputerror' id="region_error"> </p>
                        </div>

                        <div class="form-group col-12 mt-2 col-md-6">
                            <label for="description">General Description</label>
                            <textarea class="editor-content editor" name="general_description">
                               {{ $muscle->general_description }}
                            </textarea>
                               <p class='text-danger inputerror' id="general_description_error"> </p>
                        </div> 

                        <div class="form-group col-12 mt-2 col-md-6">
                            <label for="description">Related Muscle</label>
                            <textarea class="editor-content editor" name="related_muscle">
                               {{ $muscle->related_muscle }}
                            </textarea>
                               <p class='text-danger inputerror' id="related_muscle_error"> </p>
                        </div>

                        <div class="form-group col-12 mt-2 col-md-6">
                            <label for="description">Antagonist</label>
                            <textarea class="editor-content editor" name="antagonist">
                               {{ $muscle->antagonist }}
                            </textarea>
                               <p class='text-danger inputerror' id="antagonist_error"> </p>
                        </div>

                        <div class="form-group col-12 mt-2 col-md-6">
                            <label for="description">Common Injuries</label>
                            <textarea class="editor-content editor" name="common_injuries">
                               {{ $muscle->common_injuries }}
                            </textarea>
                               <p class='text-danger inputerror' id="common_injuries_error"> </p>
                        </div>

                        <div class="form-group col-12 mt-2 col-md-6">
                            <label for="description">Resistance Exercises</label>
                            <textarea class="editor-content editor" name="resistance_exercises">
                               {{ $muscle->resistance_exercises }}
                            </textarea>
                               <p class='text-danger inputerror' id="resistance_exercises_error"> </p>
                        </div>

                        <div class="form-group col-12 mt-2 col-md-6">
                            <label for="description">Stretches</label>
                            <textarea class="editor-content editor" name="stretches">
                               {{ $muscle->stretches }}
                            </textarea>
                               <p class='text-danger inputerror' id="stretches_error"> </p>
                        </div>

                        <div class="form-group col-12 mt-2 col-md-6">
                            <label for="description">Origin</label>
                            <textarea class="editor-content editor" name="origin">
                               {{ $muscle->origin }}
                            </textarea>
                               <p class='text-danger inputerror' id="origin_error"> </p>
                        </div>

                        <div class="form-group col-12 mt-2 col-md-6">
                            <label for="description">Insertion</label>
                            <textarea class="editor-content editor" name="insertion">
                               {{ $muscle->insertion }}
                            </textarea>
                               <p class='text-danger inputerror' id="insertion_error"> </p>
                        </div>

                        <div class="form-group col-12 mt-2 col-md-6">
                            <label for="description">Major Arteries</label>
                            <textarea class="editor-content editor" name="major_arteries">
                               {{ $muscle->major_arteries }}
                            </textarea>
                               <p class='text-danger inputerror' id="major_arteries_error"> </p>
                        </div>
						
						<div class="form-group col-12 mt-2 col-md-6">
                            <label for="description">Neural Innervation</label>
                            <textarea class="editor-content editor" name="neural_innervation">
                               {{ $muscle->neural_innervation }}
                            </textarea>
                               <p class='text-danger inputerror' id="neural_innervation_error"> </p>
                        </div>

                        <div class="form-group col-12 mt-2 col-md-6">
                            <label for="description">Concentric</label>
                            <textarea class="editor-content editor" name="concentric">
                               {{ $muscle->concentric }}
                            </textarea>
                               <p class='text-danger inputerror' id="concentric_error"> </p>
                        </div>

                        <div class="form-group col-12 mt-2 col-md-6">
                            <label for="description">Eccentric</label>
                            <textarea class="editor-content editor" name="eccentric">
                               {{ $muscle->eccentric }}
                            </textarea>
                               <p class='text-danger inputerror' id="eccentric_error"> </p>
                        </div>

                        <div class="form-group col-12 mt-2 col-md-6">
                            <label for="description">Isometric Function</label>
                            <textarea class="editor-content editor" name="isometric_function">
                               {{ $muscle->isometric_function }}
                            </textarea>
                               <p class='text-danger inputerror' id="isometric_function_error"> </p>
                        </div>
                       {{--  <div class="form-group col-12 mt-2 col-md-6">
                            <label for="description">Select Image</label><br>

                            <input type="file" name='image' id="file-input2"  onchange="changeImage(event)" >
	                        <p class='text-danger inputerror' id="image_error"> </p>
                            <div class="mt-3">
                                <img src="{{ $muscle->getMuscleImageUrl() }}" class="image_2" width="150px" height="150px" />
                            </div>
                    	</div> --}}
                       <div class="form-group col-12 col-md-6 mt-3">
                            <label for="exampleInputname">Select Image</label>
                            <input type="hidden" name="image" class="sec_image" />
                                <div id="my-dropzone2" class="dropzone shadow"></div>
                        </div>

                        <button type="submit" class="btn btn-dark mt-3">Update Muscle</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<div class="modal fade" id="cropModal" tabindex="-1" aria-labelledby="cropModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cropModalLabel">Crop Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="image_name" class="image_name" />
                <div id="imagePreviewContainer">
                    <img id="imagePreview" src="#" alt="Preview">
                </div>
            </div>
            <div class="modal-footer">
                <button id="cropButton" class="btn btn-primary">Crop</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('required-script-for-this-page')
    <script src="{{ asset('theme') }}/js/plugins/perfect-scrollbar.min.js"></script>
    
    {!! Html::script('theme/js/common.js?v='.time()) !!}
    
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script src="{{ asset('theme') }}/js/plugins/dropzone.min.js"></script>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js" integrity="sha512-6lplKUSl86rUVprDIjiW8DuOniNX8UDoRATqZSds/7t6zCQZfaCe3e5zcGaQwxa8Kpn5RTM9Fvl3X2lLV4grPQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.css" integrity="sha512-C4k/QrN4udgZnXStNFS5osxdhVECWyhMsK1pnlk+LkC7yJGCqoYxW4mH3/ZXLweODyzolwdWSqmmadudSHMRLA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <style>
        #imagePreviewContainer {
            width: 400px; 
            height: 400px;
            overflow: hidden; 
        }
        /* Center the imagePreviewContainer within the modal */
        #cropModal .modal-content {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0;
        }

        /* Remove any padding or margin on the imagePreviewContainer */
        #imagePreviewContainer {
            margin: 0;
            padding: 0;
        }

        /* Adjust the Cropper.js canvas */
        #cropModal .cropper-container {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
        }
        .dz-progress {
            display: none;
        }
    </style>
    <script>
        Dropzone.autoDiscover = false;

        $(document).ready(function () {
            var csrfToken = $('meta[name="_token"]').attr('content');

          

            var myDropzone = new Dropzone("div#my-dropzone", {
                url: "{{ route('muscle.upload_image') }}",
                autoProcessQueue: false,
                uploadMultiple: false,
                maxFiles: 1,
                acceptedFiles: 'image/*',
                init: function () {
                    var myDropzone = this;

                    this.on("addedfile", function (file) {
                        // Display the selected image in Cropper
                        var reader = new FileReader();
                        reader.onload = function (event) {
                            $('#imagePreview').attr('src', event.target.result);
                            $('#imagePreviewContainer').show();
                        };
                        reader.readAsDataURL(file);

                        $('.image_name').val('cover_image')
                        // Show the crop modal
                        $('#cropModal').modal('show');
                          // Simulate completion of the upload by updating the progress bar
                        myDropzone.processFile(file);
                    });

                    // Handle form submission
                    $('#cropButton').on('click', function () {
                        // Handle cropping and further processing here
                    });
                },
            });

            var myDropzone2 = new Dropzone("div#my-dropzone2", {
                url: "{{ route('muscle.upload_image') }}",
                autoProcessQueue: false,
                uploadMultiple: false,
                maxFiles: 1,
                acceptedFiles: 'image/*',
                init: function () {
                    var myDropzone = this;

                    this.on("addedfile", function (file) {
                        var reader = new FileReader();
                        reader.onload = function (event) {
                            $('#imagePreview').attr('src', event.target.result);
                            $('#imagePreviewContainer').show();
                        };
                        reader.readAsDataURL(file);

                        $('.image_name').val('sec_image')
                        $('#cropModal').modal('show');
                    });

                    $('#cropButton').on('click', function () {
                    });
                },
            });
        });

        var cropper;

        function initializeCropper() {
            cropper = new Cropper(document.getElementById('imagePreview'), {
                aspectRatio: 1, 
                viewMode: 1,
                autoCropArea: 1,
            });
        }

        function destroyCropper() {
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
        }

        $('#cropModal').on('shown.bs.modal', function () {
            destroyCropper();
            initializeCropper();
        });

        $('#cropButton').on('click', function () {
            var croppedData = cropper.getCroppedCanvas().toDataURL('image/png'); 

            var formData = new FormData();
            formData.append('cropped_image', croppedData);

            $.ajax({
                url: "{{ route('muscle.upload_image') }}",
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log('Image cropped and uploaded:', response);

                    var image_name = $('.image_name').val()
                    console.log(image_name)
                    if (image_name == 'cover_image') {
                        $('.cover_image').val(response.imgname)
                    }else if(image_name == 'sec_image'){
                        $('.sec_image').val(response.imgname)
                    }
                    $('#cropModal').modal('hide');
                },
                error: function (error) {
                    console.error('Error cropping and uploading image:', error);
                },
            });
        });

    	$(document).ready(function () {

    		function showPreview(event, id) {
    			console.log(id)
	            if (event.target.files.length > 0) {
	                var src = URL.createObjectURL(event.target.files[0]);
	                var preview = document.getElementById(id);
	                preview.src = src;
	                preview.style.display = "block";
	            }
	        }
            function changeImage(event) {
                if (event.target.files.length > 0) {
                    var src = URL.createObjectURL(event.target.files[0]);
                    var preview = $('.image_2').attr('src', src);
                    
                }
            }
	        
			window.showPreview = showPreview
            window.changeImage = changeImage

            // ClassicEditor
            //     .create(document.getElementsByClassName('editor-content'))
            //     .then(editor => {})
            //     .catch(error => {});

                var elements = document.getElementsByClassName('editor');

			for (var i = 0; i < elements.length; i++) {
                CKEDITOR.replace(elements[i].name);
            }

        });
    </script>
@endsection