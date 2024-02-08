@extends('admin.adminLayout.app')
@section('title', 'Dashboard')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
    </div><!-- End Page Title -->
    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <!-- Partner Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Mitra Kerjasama</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person-plus-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 class="pb-2">{{ $our_partners }} Partner</h6>
                                        <a type="button" class="btn btn-primary" href="/admin/our-partner/add"><i class="bi bi-plus-lg me-1"></i>Tambah Data Partner</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Partner Card -->

                    <!-- Dosen Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Dosen PSIF ITI</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 class="pb-2">{{ $teaching_staff }} Dosen</h6>
                                        <a type="button" class="btn btn-primary" href="/admin/teaching-staff/add"><i class="bi bi-plus-lg me-1"></i>Tambah Data Dosen</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Dosen Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-12">
                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Laboratorium</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-pc-display"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 class="pb-2">{{ $laboratories}} Laboratorium</h6>
                                        <a type="button" class="btn btn-primary" href="/admin/laboratory/add"><i class="bi bi-plus-lg me-1"></i>Tambah Data Lab</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Lab Card -->

                                <!-- Recent Sales -->
            <div class="col-12">
                <div class="card recent-sales overflow-auto">
  
                  <div class="card-body">
                    <div class="d-flex align-items-center gap-4">
                        <h5 class="card-title">Berita Terkini</h5> 
                        <a type="button" class="" href="/admin/blog/add"><i class="bi bi-plus-lg me-1"></i>Tambah Berita Terbaru Disini</a>
                    </div>
                    <table class="table table-borderless datatable">
                      <thead>
                        <tr>
                            <th scope="col">No</th>
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
                            <td>{{ \Illuminate\Support\Str::limit($blog->title, 20) }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($blog->description, 20) }}</td>
                            <td><img src="{{ asset('storage/blogs/' . basename($blog->image)) }}" alt="" style="height:40px; width:60px; object-fit: cover; rounded"></td>
                            <td><a href="/admin/blog/{{ $blog->id }}/edit" class="btn btn-warning"><i class="bi bi-pencil-fill text-white"></i></a>
                                <a href="/admin/blog/{{ $blog->id }}/delete" class="btn btn-danger"><i class="bi bi-trash3-fill text-white"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                  </div>
                </div>
              </div><!-- End Recent Sales -->

                    <!-- Prestasi Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Prestasi Mahasiswa</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person-plus-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 class="pb-2">{{ $achievments }} Prestasi</h6>
                                        <a type="button" class="btn btn-primary" href="/admin/achievment/add"><i class="bi bi-plus-lg me-1"></i>Tambah Data Prestasi</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Partner Card -->

                    <!-- Dosen Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Riset</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-rocket-takeoff"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 class="pb-2">{{ $risets }} Riset</h6>
                                        <a type="button" class="btn btn-primary" href="/admin/riset/add"><i class="bi bi-plus-lg me-1"></i>Tambah Data Riset</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Dosen Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-12">
                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Unduhan</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-file-earmark-arrow-down-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 class="pb-2">{{ $downloads}} Unduhan</h6>
                                        <a type="button" class="btn btn-primary" href="/admin/download/add"><i class="bi bi-plus-lg me-1"></i>Tambah Data Unduhan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Customers Card -->
        </div>
    </section>
@endsection
