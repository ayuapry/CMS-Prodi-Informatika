@extends('admin.adminLayout.app')

@section('title', 'Edit Achievment')

@section('content')
    <div class="pagetitle">
        <h1>Edit Achievment</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/achievment">Achievment</a></li>
                <li class="breadcrumb-item active">Edit Achievment</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Achievment</h5>

                        <!-- General Form Elements -->
                        <form action="/admin/achievment/{{ $achievment->id }}" method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        name="title" value="{{ $achievment->title }}">
                                </div>
                                @error('title')
                                    <div class="invalid-feedback">
                                        title tidak boleh kosong
                                    </div>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Deskripsi</label>
                                <div class="col-sm-10">
                                    {{-- <input type="text" class="form-control @error('content') is-invalid @enderror" name="content" value="{{ $laboratory->content }}"> --}}
                                    <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content">{{ $achievment->content }}</textarea>
                                </div>
                                @error('content')
                                    <div class="invalid-feedback">
                                        Deskripsi tidak boleh kosong
                                    </div>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    <input class="form-control @error('image') is-invalid @enderror" type="file"
                                        name="image">
                                </div>
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
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
