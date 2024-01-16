@extends('admin.adminLayout.app')
@section('title', 'Call To Action')
@section('content')

<div class="pagetitle">
    <h1>Data Call To Action</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/call-to-action">Call To Action</a></li>
            <li class="breadcrumb-item active">Data Call To Action</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Call To Action</h5>
                    <a type="button" class="btn btn-primary m-2" href="/admin/call-to-action/add"><i class="bi bi-plus-square-fill"></i> Tambah Data CTA</a>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Button Text</th>
                                <th scope="col">URL</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($call_to_actions as $call_to_action)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $call_to_action->title }}</td>    
                                <td>{{ $call_to_action->description }}</td>    
                                <td>{{ $call_to_action->buttonText }}</td>    
                                <td>{{ $call_to_action->url }}</td>    
                                <td>
                                    <a href="/admin/call-to-action/{{ $call_to_action->id }}/edit" class="btn btn-warning"><i class="bi bi-pencil-fill text-white"></i></a>
                                    <a href="/admin/call-to-action/{{ $call_to_action->id }}/delete" class="btn btn-danger"><i class="bi bi-trash3-fill text-white"></i></a>
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