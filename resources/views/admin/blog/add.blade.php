@extends('admin.adminLayout.app')
@section('title', 'Tambah Data Blog')

@section('content')
    <div class="pagetitle">
        <h1>Tambah Data Blog</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/blog">Blog</a></li>
                <li class="breadcrumb-item active">Tambah Data Blog</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tambah Data Blog</h5>

                        <!-- General Form Elements -->
                        <form action="/admin/blog" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Judul</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        name="title">
                                </div>
                                @error('title')
                                    <div class="invalid-feedback">
                                        Judul tidak boleh kosong
                                    </div>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Deskripsi</label>
                                <div class="col-sm-10">
                                    <textarea type="text" id="description" class="form-control @error('description') is-invalid @enderror"
                                        name="description"></textarea>
                                </div>
                                @error('description')
                                    <div class="invalid-feedback">
                                        description tidak boleh kosong
                                    </div>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Thumbnail</label>
                                <div class="col-sm-10">
                                    <input class="form-control @error('image') is-invalid @enderror" type="file"
                                        name="image">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Blog Category</label>
                                <div class="col-sm-10">
                                    <select class="form-select @error('blogcategory_id') is-invalid @enderror"
                                        aria-label="Default select example" name="blogcategory_id">
                                        <option selected>Pilih Kategori</option>
                                        @foreach ($blogcategories as $blogcategory)
                                            <option value="{{ $blogcategory->id }}">{{ $blogcategory->name }}</option>
                                        @endforeach
                                    </select>
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
        CKEDITOR.replace('description');
    </script>
@endsection
