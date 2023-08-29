@extends('layouts.login')


@section('title', 'Halaman Masuk - PT Minamas TC')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-5">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-header"><h3 class="text-center font-weight-light my-4">Halaman Masuk</h3></div>
            <div class="card-body">
                <form action="{{ route('auth.login') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-floating mb-3">
                        <input class="form-control" id="name" name="name" type="name" placeholder="username" />
                        <label for="name">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="password" name="password" type="password" placeholder="Password" />
                        <label for="password">Password</label>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                        <button class="btn btn-primary" type="submit">Masuk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection