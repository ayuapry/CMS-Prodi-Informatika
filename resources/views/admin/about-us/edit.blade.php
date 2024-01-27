@extends('admin.adminLayout.app')

@section('title', 'Edit About Us')

@section('content')
    <div class="pagetitle">
        <h1>Edit About Us</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/about-us">About Us</a></li>
                <li class="breadcrumb-item active">Edit About Us</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit About Us</h5>

                        <!-- General Form Elements -->
                        <form action="/admin/about-us/{{ $about_us->id }}" method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        name="title" value="{{ $about_us->title }}">
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
                                    <input type="text" class="form-control @error('description') is-invalid @enderror"
                                        name="description" value="{{ $about_us->description }}">
                                </div>
                                @error('description')
                                    <div class="invalid-feedback">
                                        Deskripsi tidak boleh kosong
                                    </div>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Selayang Pandang</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control @error('selayang') is-invalid @enderror" name="selayang" id="selayang">{{ $about_us->selayang }}</textarea>
                                </div>
                                @error('selayang')
                                    <div class="invalid-feedback">
                                        Selayang Pandang tidak boleh kosong
                                    </div>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Visi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('vision') is-invalid @enderror"
                                        name="vision" value="{{ $about_us->vision }}">
                                </div>
                                @error('vision')
                                    <div class="invalid-feedback">
                                        Visi tidak boleh kosong
                                    </div>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Misi</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control @error('mision') is-invalid @enderror" name="mision" id="mision">{{ $about_us->mision }}</textarea>
                                </div>
                                @error('mision')
                                    <div class="invalid-feedback">
                                        Mision tidak boleh kosong
                                    </div>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Content</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content">{{ $about_us->content }}</textarea>
                                </div>
                                @error('content')
                                    <div class="invalid-feedback">
                                        content Pandang tidak boleh kosong
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
        CKEDITOR.replace('selayang');
        CKEDITOR.replace('mision');
    </script>
@endsection
