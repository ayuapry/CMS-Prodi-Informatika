@extends('admin.adminLayout.app')

@section('title', 'Edit Blog')

@section('content')
    <div class="pagetitle">
        <h1>Edit Blog</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/blog">Blog</a></li>
                <li class="breadcrumb-item active">Edit Blog</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Blog</h5>

                        <!-- General Form Elements -->
                        <form action="/admin/blog/{{ $blog->id }}" method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        name="title" value="{{ $blog->title }}">
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
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description">{{ $blog->description }}</textarea>
                                </div>
                                @error('description')
                                    <div class="invalid-feedback">
                                        Deskripsi tidak boleh kosong
                                    </div>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Attachment</label>
                                <div class="col-sm-10">
                                    <input class="form-control @error('image') is-invalid @enderror" type="file"
                                        name="image">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Kategori Blog</label>
                                <div class="col-sm-10">
                                    <select class="form-select @error('blogcategory_id') is-invalid @enderror"
                                        aria-label="Default select example" name="blogcategory_id">
                                        <option selected>{{ $blog->blogcategory->name }}</option>
                                        @foreach ($blogcategories  as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
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
