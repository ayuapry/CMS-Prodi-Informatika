@extends('admin.adminLayout.app')
@section('title', 'Menu')
@section('content')

<div class="pagetitle">
    <h1>Data Menu</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/riset">Menu</a></li>
            <li class="breadcrumb-item active">Data Menu</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Menu</h5>
                    <a type="button" class="btn btn-primary m-2" href="/admin/menu/add"><i class="bi bi-plus-square-fill"></i> Tambah Data Menu</a>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Menu</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menus as $menu)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $menu->name }}</td>    
                                <td>
                                    <a href="/admin/menu/{{ $menu->id }}/edit" class="btn btn-warning"><i class="bi bi-pencil-fill text-white"></i></a>
                                    <a href="/admin/menu/{{ $menu->id }}/delete" class="btn btn-danger"><i class="bi bi-trash3-fill text-white"></i></a>
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