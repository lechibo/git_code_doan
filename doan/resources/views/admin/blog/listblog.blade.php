
@extends('admin.layouts.app')
@section('content')
<div class="page-wrapper">

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
     
            <div class="container-fluid">
          
                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">List Blogs</h4>       
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">Title</th>
                                            <th class="border-top-0">Image</th>
                                            <th class="border-top-0">Description</th>
                                            <th class="border-top-0">Content</th>
                                            <th class="border-top-0">Action</th>
                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($blog as $blog)
                                        <tr>
                                            <td class="txt-oflo">{{$blog->id}}</td>
                                            <td class="txt-oflo">{{$blog->title}}</td>
                                            <!-- <td class="txt-oflo">{{$blog->image}}</td> -->
                                            <td>
                                                <img src="{{ asset('admin/assets/images/blogs/'.$blog->image) }}"
                                                    width="100">
                                            </td>
                                            
                                            <td class="txt-oflo">{{$blog->description}}</td>
                                            <td class="txt-oflo">{!!$blog->content!!}</td>
                                            <td class="txt-oflo">  
                                                <a href="{{route('blog.getdelete',$blog->id)}}">
                                                    <input type="button" style="color:red;" value="Delete"> 
                                                </a>
                                                <a href="{{route('blog.edit',$blog->id)}}">
                                                    <input type="button" style="color:blue;" value="Edit"> 
                                                </a>
                                            </td>
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            
                        </div>
                        <a href="{{ route('addblog.get') }}" class="btn btn-primary">
                            Add
                        </a>
                       
                    </div>
                </div>

            </div>

        </div>
@endsection
