@extends('admin.adminLayout.app')
@section('title', 'Blog')
@section('content')

<div class="pagetitle">
    <h1>Data Blog</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/blog">Blog</a></li>
            <li class="breadcrumb-item active">Data Blog</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Blog</h5>
                    <a type="button" class="btn btn-primary m-2" href="/admin/blog/add"><i class="bi bi-plus-square-fill"></i> Tambah Data Blog</a>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Attachment</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blogs as $blog)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $blog->title }}</td>                                
                                <td>{{ $blog->description }}</td>
                                <td><img src="{{ asset('storage/blogs/' . basename($blog->image)) }}" alt="" style="height:40px; width:60px; object-fit: cover;"></td>
                                <td><a href="/admin/blog/{{ $blog->id }}/edit" class="btn btn-warning"><i class="bi bi-pencil-fill text-white"></i></a>
                                    <a href="/admin/blog/{{ $blog->id }}/delete" class="btn btn-danger"><i class="bi bi-trash3-fill text-white"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                </div>
            </div>

        </div>
    </div>
</section>
@endsection