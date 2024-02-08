@extends('admin.adminLayout.app')
@section('title', 'Sub Menu')
@section('content')

<div class="pagetitle">
    <h1>Data Sub Menu</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/sub-menu">Sub Menu</a></li>
            <li class="breadcrumb-item active">Data Sub Menu</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Sub Menu</h5>
                    <a type="button" class="btn btn-primary m-2" href="/admin/sub-menu/add"><i class="bi bi-plus-square-fill"></i> Tambah Sub Menu</a>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Sub Menu</th>
                                <th scope="col">Menu</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sub_menus as $sub_menu)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $sub_menu->name }}</td>
                                <td>{{ $sub_menu->menu->name }}</td>
                                <td><a href="/admin/sub-menu/{{ $sub_menu->id }}/edit" class="btn btn-warning"><i class="bi bi-pencil-fill text-white"></i></a>
                                    | <a href="/admin/sub-menu/{{ $sub_menu->id }}/delete" class="btn btn-danger"><i class="bi bi-trash3-fill text-white"></i></a>
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