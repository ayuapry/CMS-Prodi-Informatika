@extends('admin.adminLayout.app')
@section('title', 'Tambah Data Riset')

@section('content')
    <div class="pagetitle">
        <h1>Tambah Data Riset</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/riset">Riset</a></li>
                <li class="breadcrumb-item active">Tambah Data Riset</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tambah Data Riset</h5>

                        <!-- General Form Elements -->
                        <form action="/admin/riset" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name">
                                </div>
                                @error('name')
                                    <div class="invalid-feedback">
                                        Name tidak boleh kosong
                                    </div>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Research Title</label>
                                <div class="col-sm-10">
                                    <textarea type="text" class="form-control @error('research_title') is-invalid @enderror"
                                        name="research_title"></textarea>
                                </div>
                                @error('research_title')
                                    <div class="invalid-feedback">
                                        research_title tidak boleh kosong
                                    </div>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Year</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('year') is-invalid @enderror"
                                        name="year">
                                </div>
                                @error('year')
                                    <div class="invalid-feedback">
                                        Year tidak boleh kosong
                                    </div>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Type</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('type') is-invalid @enderror"
                                        name="type">
                                </div>
                                @error('type')
                                    <div class="invalid-feedback">
                                        Type tidak boleh kosong
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
        CKEDITOR.replace('research_title');
    </script>
@endsection
