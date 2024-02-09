@extends('admin.adminLayout.app')
@section('title', 'Banner')
@section('content')

<div class="pagetitle">
    <h1>Data Banner</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/hero">Banner</a></li>
            <li class="breadcrumb-item active">Data Banner</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Banner</h5>
                    @if ($heroes -> isEmpty()) 
                        <a type="button" class="btn btn-primary m-2" href="/admin/hero/add"><i class="bi bi-plus-square-fill"></i> Tambah Data Banner</a>
                    @else
                        <a type="button" class="btn btn-primary m-2 disabled" href="/admin/hero/add"><i class="bi bi-plus-square-fill"></i> Tambah Data Banner</a>
                    @endif
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Image</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($heroes as $hero)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $hero->title }}</td>                                
                                <td>{{ $hero->description }}</td>
                                <td><img src="{{ asset('storage/heroes/' . basename($hero->image)) }}" alt="" style="height:40px; width:60px; object-fit: cover;"></td>
                                <td><a href="/admin/hero/{{ $hero->id }}/edit" class="btn btn-warning"><i class="bi bi-pencil-fill text-white"></i></a>
                                    <a href="/admin/hero/{{ $hero->id }}/delete" class="btn btn-danger"><i class="bi bi-trash3-fill text-white"></i></a>
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