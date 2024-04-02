@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    @section('title')
        Albums
    @stop

@endsection

@section('content')

    <!-- row -->
    <div class="row">
        @include('partials.alerts')
            <div class="col-xl-12">
                <div class="card mg-b-20">
                    <div class="card-header pb-2 mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                                <a class="modal-effect btn btn-outline-success btn-block" data-effect="effect-scale"
                                   data-toggle="modal" href="#addAlbumModal">Add Album</a>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
                        @foreach($albums as $album)
                            <div class="col-md-6 col-lg-6 col-xl-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="pro-img-box">
                                            <!-- Icon within the photo section -->
                                            <img class="w-100" src="{{ isset($album->Picture->url) ? $album->Picture->url->first() : URL::asset('assets/img/ecommerce/01.jpg') }}" alt="{{$album->name}}">
                                            <a href="{{route('albums.show',$album->id)}}" class="adtocart"> <i class="la la-image"></i></a>
                                        </div>
                                        <div class="text-center pt-3">
                                            <h3 class="h6 mb-2 mt-4 font-weight-bold text-uppercase">{{ $album->name }}</h3>
                                        </div>
                                        <!-- Buttons for each album -->
                                        <button type="button" class="btn btn-danger btn-sm mt-2" data-toggle="modal" data-id="{{ $album->id }}" data-target="#deleteAlbum">Delete</button>
                                        <button type="button" class="btn btn-primary btn-sm mt-2" data-toggle="modal" data-id="{{ $album->id }}" data-name="{{ $album->section_name }}" data-target="#updateAlbum">edite</button>

                                    </div>
                                </div>
                            </div>
                        @endforeach                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $albums->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="modal" id="addAlbumModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Add Album</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('albums.store') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="album_name">Album Name</label>
                                <input type="text" class="form-control" id="album_name" name="name">
                            </div>


                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Add Album</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- edit -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">transform Album</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{route('albums.transfer')}}" method="post" autocomplete="off">
                        @csrf
                        @method('delete')
                        <div class="modal-body">
                        <input type="hidden" name="sourceAlbumId" id="sourceAlbumId" value="">
                        <select name="targetAlbumId" class="form-control SlectBox" readonly>
                            <!--placeholder-->
                            @foreach($albums as $album)
                                <option value="{{$album->id}}" >
                                    {{$album->name}}
                                </option>
                            @endforeach

                        </select>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>

        <!-- delete -->
        <div class="modal" id="deleteAlbum">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Delete Album</h6><button aria-label="Close" class="close" data-dismiss="modal"
                                                                      type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="album/destroy" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p>Are You sure to Delete This Album</p><br>
                            <input type="hidden" name="id" id="id" value="">
                        </div>
                        <div class="modal-footer">
                            @if(count($albums) > 1)
                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-dismiss="modal" data-source-album-id="{{ $album->id }}" href="#exampleModal2">transform To Another Album</button>
                            @endif
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    <div class="modal" id="updateAlbum">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">update Album</h6><button aria-label="Close" class="close" data-dismiss="modal"
                                                                     type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="album/update" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id" value="">

                        <input class="form-control" name="name" id="name" type="text">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Save</button>
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
        var albumId;
        $('#deleteAlbum').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            albumId = button.data('id');
            var modal = $(this)
            modal.find('.modal-body #id').val(albumId);
        })
        $('#exampleModal2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('source-album-id');
            var modal = $(this)
            modal.find('.modal-body #sourceAlbumId').val(albumId);
        })

    </script>
    <script>
        $('#updateAlbum').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
        })

    </script>




@endsection
