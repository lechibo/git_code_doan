
@extends('admin.layouts.app')
@section('content')

{{ request('search') }}

<br>

Số kết quả: {{ $checkouts->count() }}
<div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Email campaign chart -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Email campaign chart -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Ravenue - page-view-bounce rate -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Latest Sales</h4>       
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">STT</th>
                                            <th class="border-top-0">ID User</th>
                                            <th class="border-top-0">Name User</th>
                                            <th class="border-top-0">Email</th>
                                            <th class="border-top-0">Phone</th>
                                            <th class="border-top-0">Tên người mua</th>
                                            <th class="border-top-0">Giá</th>
                                            <th class="border-top-0">Ngày mua</th>
                                           
                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($checkouts  as $checkout)
                                        <tr>
                                            <td class="txt-oflo">{{ $loop->iteration }}</td>
                                            <td><span class="label label-success label-rounded" style="font-size:15px;">{{ $checkout->id_user }}</span> </td>
                                            <td><span class="label label-success label-rounded" style="font-size:15px;">{{ $checkout->user->name ?? 'Không xác định' }}</span> </td>
                                            <td><span class="label label-success label-rounded" style="font-size:15px;">{{ $checkout->email }}</span> </td>
                                        
                                            <td class="txt-oflo">
                                                {{ $checkout->phone }}
                                            </td>
                                            <td class="txt-oflo">
                                                {{ $checkout->name }}
                                            </td>
                                            <td class="txt-oflo">
                                                {{ number_format($checkout->price) }}
                                            </td>
                                            <td class="txt-oflo">
                                                {{ $checkout->created_at }}
                                            </td>
                                            
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            
                        </div>
                       
                       
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Ravenue - page-view-bounce rate -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Recent comment and chats -->
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- Recent comment and chats -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
@endsection
