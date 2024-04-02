@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
    @section('title')
        {{ $album->name }}
    @stop

@endsection

@section('content')

    <!-- row -->
    <div class="row">

            <div class="col-xl-12 mt-5">
                @include('partials.alerts')

                <div class="card mg-b-20">
                    <div class="card-header pb-2 mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                                <a class="modal-effect btn btn-outline-success btn-block" data-effect="effect-scale"
                                   data-toggle="modal" href="#addAlbumModal">Add Photos</a>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">

                        @forelse($album->pictures as $picture)
                            <div class="col-md-6 col-lg-6 col-xl-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="pro-img-box">
                                            <!-- Icon within the photo section -->
                                            <img class="w-100" style="width: 150px; height: 200px; object-fit: cover;" src="{{  asset('albums/'.$album->hashed_id.'/'.$picture->path) }}">
                                        </div>

                                        <!-- Buttons for each album -->
                                        <button type="button" class="btn btn-danger btn-sm mt-2" data-toggle="modal" data-id="{{ $picture->id }}" data-target="#deleteAlbum">Delete</button>

                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="container">

                            <h1 class="text-center">No Photos added yet</h1>
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
        <div class="modal" id="addAlbumModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Add Pictures</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('pictures.store',$album->id ) }}" method="post" enctype="multipart/form-data" id="image-upload" class="dropzone">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- delete -->
        <div class="modal" id="deleteAlbum">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Delete Photo</h6><button aria-label="Close" class="close" data-dismiss="modal"
                                                                      type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="{{ route('pictures.destroy',$album->id) }}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p>Are You sure to Delete This photo</p><br>
                            <input type="hidden" name="id" id="id" value="">
                        </div>
                        <div class="modal-footer">

                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                </div>
                </form>
            </div>
        </div>





    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>



    <script>
        $('#deleteAlbum').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
        })

    </script>


    <script type="text/javascript">

        var dropzone = new Dropzone('#image-upload', {
            thumbnailWidth: 200,
            maxFilesize: 1,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            complete: function() {
                setTimeout(function() {
                    window.location.reload();
                }, 3000);
            }
        });


    </script>



@endsection
