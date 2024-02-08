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
                    <h5 class="card-title">Berita Terkini</h5>
  
                    <table class="table table-borderless datatable">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Customer</th>
                          <th scope="col">Product</th>
                          <th scope="col">Price</th>
                          <th scope="col">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row"><a href="#">#2457</a></th>
                          <td>Brandon Jacob</td>
                          <td><a href="#" class="text-primary">At praesentium minu</a></td>
                          <td>$64</td>
                          <td><span class="badge bg-success">Approved</span></td>
                        </tr>
                        <tr>
                          <th scope="row"><a href="#">#2147</a></th>
                          <td>Bridie Kessler</td>
                          <td><a href="#" class="text-primary">Blanditiis dolor omnis similique</a></td>
                          <td>$47</td>
                          <td><span class="badge bg-warning">Pending</span></td>
                        </tr>
                        <tr>
                          <th scope="row"><a href="#">#2049</a></th>
                          <td>Ashleigh Langosh</td>
                          <td><a href="#" class="text-primary">At recusandae consectetur</a></td>
                          <td>$147</td>
                          <td><span class="badge bg-success">Approved</span></td>
                        </tr>
                        <tr>
                          <th scope="row"><a href="#">#2644</a></th>
                          <td>Angus Grady</td>
                          <td><a href="#" class="text-primar">Ut voluptatem id earum et</a></td>
                          <td>$67</td>
                          <td><span class="badge bg-danger">Rejected</span></td>
                        </tr>
                        <tr>
                          <th scope="row"><a href="#">#2644</a></th>
                          <td>Raheem Lehner</td>
                          <td><a href="#" class="text-primary">Sunt similique distinctio</a></td>
                          <td>$165</td>
                          <td><span class="badge bg-success">Approved</span></td>
                        </tr>
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
                                        <h6 class="pb-2">{{ $our_partners }} Partner</h6>
                                        <a type="button" class="btn btn-primary" href="/admin/our-partner/add"><i class="bi bi-plus-lg me-1"></i>Tambah Data Prestasi</a>
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
                                        <i class="bi bi-book"></i>
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
                                        <i class="bi bi-bookmarks"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 class="pb-2">{{ $laboratories}} Laboratorium</h6>
                                        <a type="button" class="btn btn-primary" href="/admin/laboratory/add"><i class="bi bi-plus-lg me-1"></i>Tambah Data Lab</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Customers Card -->
        </div>
    </section>
@endsection
