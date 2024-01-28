@extends('admin.adminLayout.app')
@section('title', 'Riset')
@section('content')

<div class="pagetitle">
    <h1>Data Riset</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/riset">Riset</a></li>
            <li class="breadcrumb-item active">Data Riset</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Riset</h5>
                    <a type="button" class="btn btn-primary m-2" href="/admin/riset/add"><i class="bi bi-plus-square-fill"></i> Tambah Data Riset</a>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Type</th>
                                <th scope="col">Research Title</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($risets as $riset)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $riset->name }}</td>    
                                <td>{{ $riset->type }}</td>    
                                <td>{{ $riset->research_title }}</td>    
                                <td>
                                    <a href="/admin/riset/{{ $riset->id }}/edit" class="btn btn-warning"><i class="bi bi-pencil-fill text-white"></i></a>
                                    <a href="/admin/riset/{{ $riset->id }}/delete" class="btn btn-danger"><i class="bi bi-trash3-fill text-white"></i></a>
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