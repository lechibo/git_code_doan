
@extends('admin.layouts.app')
@section('content')
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
                                            <th class="border-top-0">Tên</th>
                                            <th class="border-top-0">Email</th>
                                            <th class="border-top-0">Level</th>
                                            <th class="border-top-0">Action</th>
                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td class="txt-oflo">{{$user->id + 1}}</td>
                                            <td><span class="label label-success label-rounded" style="font-size:15px;">{{ $user->name }}</span> </td>
                                            <td><span class="label label-success label-rounded" style="font-size:15px;">{{ $user->email }}</span> </td>
                                            <td class="txt-oflo">
                                                @if($user->level == 0)
                                                    Member
                                                @elseif($user->level == 1)
                                                    Admin
                                                @endif</td>
                                            <td class="txt-oflo">
                                                
                                                <a href="{{ route('admin.users.edit', $user->id) }}">
                                                    <input type="button" style="color:blue;" value="Edit">  
                                                </a>
                                                <!-- <a href="{{ route('admin.users.delete', $user->id) }}"> 
                                                    <input type="button" style="color:red;" value="Delete"> 
                                                </a> -->
                                                <form action="{{ route('admin.users.delete', $user->id) }}"
                                                    method="POST"
                                                    style="display: inline">

                                                    @csrf
                                                    

                                                    <button type="submit"
                                                            class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Bạn có chắc muốn xóa user này?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            
                        </div>
                        <a href="#" class="btn btn-primary">
                            Add
                        </a>
                       
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
