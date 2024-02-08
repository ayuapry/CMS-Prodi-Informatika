@extends('admin.adminLayout.app')

@section('title', 'Edit Sub Menu')

@section('content')
    <div class="pagetitle">
        <h1>Edit Sub Menu</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/sub-menu">Sub Menu</a></li>
                <li class="breadcrumb-item active">Edit Sub Menu</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Sub Menu</h5>

                        <!-- General Form Elements -->
                        <form action="/admin/sub-menu/{{ $sub_menus->id }}" method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Nama Sub Menu</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ $sub_menus->name }}">
                                </div>
                                @error('name')
                                    <div class="invalid-feedback">
                                        Sub Menu tidak boleh kosong
                                    </div>
                                @enderror
                            </div>
                        
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Kategori Menu</label>
                                <div class="col-sm-10">
                                    <select class="form-select @error('menu_id') is-invalid @enderror"
                                        aria-label="Default select example" name="menu_id">
                                        <option selected>{{ $sub_menus->menu->name }}</option>
                                        @foreach ($menus as $menu)
                                            <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Submit Button</label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Submit Form</button>
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
