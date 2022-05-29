@extends('layouts.app')

@section('content')
{{-- @if ($errors->any())
        <div class="container alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
@endif --}}

        <!-- Main Content-->
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <!-- Post preview-->
                    <div class="post-preview">
                        <a href="post.html">
                            <h2 class="post-title">Posts</h2>
                        </a>
                        <div class="card">
                            <div class="card-header text-center font-weight-bold">
                                Add new post:
                            </div>
                            <div class="card-body">
                              <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{ route('posts.add') }}">
                               @csrf

                                <div class="form-group mb-4">
                                    @error('title')
                                        <div class="error alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label for="title">Title</label>
                                    <input type="text" id="title" name="title" class="form-control" required="" value="{{ old('title') }}">

                                    @error('slug')
                                    <div class="error alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                    <label for="slug">Slug</label>
                                    <input type="text" id="slug" name="slug" class="form-control" required="" value="{{ old('slug') }}">

                                    @error('description')
                                        <div class="error alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                    <label for="description">Description</label>
                                    <input type="text" id="description" name="description" class="form-control" required="" value="{{ old('description') }}">

                                    @error('body')
                                        <div class="error alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                    <label for="body">Body</label>
                                    <input type="text" id="body" name="body" class="form-control" required="" value="{{ old('body') }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Zapisz</button>

                              </form>
                            </div>
                        </div>
                    <!-- Divider-->
                    <hr class="my-4" />
                    <!-- Pager-->
                    <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="{{ route('posts.index') }}">Powrót do listy postów →</a></div>
                </div>
            </div>
        </div>
        <!-- Footer-->
        <footer class="border-top">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <ul class="list-inline text-center">
                            <li class="list-inline-item">
                                <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <div class="small text-center text-muted fst-italic">Dominik Figiel 2022</div>
                    </div>
                </div>
            </div>
        </footer>
@endsection