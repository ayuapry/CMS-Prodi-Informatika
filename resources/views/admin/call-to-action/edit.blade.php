@extends('admin.adminLayout.app')

@section('title', 'Edit Call To Action')

@section('content')
    <div class="pagetitle">
        <h1>Edit Call To Action</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/call-to-action">Call To Action</a></li>
                <li class="breadcrumb-item active">Edit Call To Action</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Call To Action</h5>

                        <!-- General Form Elements -->
                        <form action="/admin/call-to-action/{{ $call_to_actions->id }}" method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        name="title" value="{{ $call_to_actions->title }}">
                                </div>
                                @error('title')
                                    <div class="invalid-feedback">
                                        title tidak boleh kosong
                                    </div>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('description') is-invalid @enderror"
                                        name="description" value="{{ $call_to_actions->description }}">
                                </div>
                                @error('description')
                                    <div class="invalid-feedback">
                                        Description tidak boleh kosong
                                    </div>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Button Text</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('buttonText') is-invalid @enderror"
                                        name="buttonText" value="{{ $call_to_actions->buttonText }}">
                                </div>
                                @error('buttonText')
                                    <div class="invalid-feedback">
                                        Button Text tidak boleh kosong
                                    </div>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">URL</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('url') is-invalid @enderror"
                                        name="url" value="{{ $call_to_actions->url }}">
                                </div>
                                @error('url')
                                    <div class="invalid-feedback">
                                        URL tidak boleh kosong
                                    </div>
                                @enderror
                            </div>
                        
                            <div class=" mb-3" style='float: right;'>
                                <button type="submit" class="btn btn-primary">Submit Form</button>
                                <div class="col-sm-10">
                                </div>
                            </div>
                        </form><!-- End General Form Elements -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
