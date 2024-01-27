@extends('admin.adminLayout.app')
@section('title', 'Download')
@section('content')

<div class="pagetitle">
    <h1>Data Download</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/download">Download</a></li>
            <li class="breadcrumb-item active">Data Download</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Download</h5>
                    <a type="button" class="btn btn-primary m-2" href="/admin/download/add"><i class="bi bi-plus-square-fill"></i> Tambah Data</a>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">URL</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($downloads as $download)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $download->title }}</td>    
                                <td>{{ $download->description }}</td>    
                                <td>{{ $download->url }}</td>    
                                <td>
                                    <a href="/admin/download/{{ $download->id }}/edit" class="btn btn-warning"><i class="bi bi-pencil-fill text-white"></i></a>
                                    <a href="/admin/download/{{ $download->id }}/delete" class="btn btn-danger"><i class="bi bi-trash3-fill text-white"></i></a>
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