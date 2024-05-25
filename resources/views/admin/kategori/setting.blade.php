@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Setting Kategori</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('kategori.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="attendance" class="col-md-4 col-form-label text-md-right">Attendance</label>

                            <div class="col-md-6">
                                <input id="attendance" type="text" class="form-control" name="attendance" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="first_attendance" class="col-md-4 col-form-label text-md-right">First Attendance</label>

                            <div class="col-md-6">
                                <input id="first_attendance" type="text" class="form-control" name="first_attendance" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="finish_attendance" class="col-md-4 col-form-label text-md-right">Finish Attendance</label>

                            <div class="col-md-6">
                                <input id="finish_attendance" type="text" class="form-control" name="finish_attendance" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
