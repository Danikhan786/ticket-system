@extends('layouts.frontend')

@section('content')
    <section class="ticket-section section-padding">
        <div class="section-overlay"></div>

        <div class="container">
            <div class="row">

                <div class="col-lg-6 col-10 mx-auto">
                    <form class="custom-form ticket-form mb-5 mb-lg-0" action="{{ route('tickets.store') }}" method="post" role="form"
                        enctype="multipart/form-data">
                        @csrf
                        <h2 class="text-center mb-4">Get started here</h2>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="ticket-form-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <input type="text" name="name" id="ticket-form-name" class="form-control"
                                        placeholder="Full name *" value="{{ old('name') }}" required>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12">
                                    <input type="email" name="email" id="ticket-form-email"
                                        pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Email address *" value="{{ old('email') }}" required>
                                </div>
                            </div>

                            <input type="tel" class="form-control" name="phone" placeholder="Phone (e.g., 0300-0000000)" value="{{ old('phone') }}">

                            <input type="text" class="form-control" name="student_id" placeholder="Student ID / Roll No" value="{{ old('student_id') }}">

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <input type="text" name="department" class="form-control" placeholder="Department" value="{{ old('department') }}">
                                </div>

                                <div class="col-lg-6 col-md-6 col-12">
                                    <input type="text" name="semester" class="form-control" placeholder="Semester" value="{{ old('semester') }}">
                                </div>
                            </div>

                            <h6>Our bank details</h6>
                            <div class="row mb-2">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <small class="form-text text-muted">Sadapay Account Name: <br> <b>Faisal Nadeem</b></small>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <small class="form-text text-muted">Account Number: <br> <b>03319957331</b></small>
                                </div>
                            </div>
                            <div class="row">
                                <h6>Upload the bank payment receipt *</h6>
                                <div class="col-lg-12 col-md-12 col-12">
                                    <small class="form-text text-muted mb-2">Please upload a screenshot of your transaction</small>
                                    <input type="file" name="transaction_screenshot"
                                        id="ticket-form-account-screenshot" class="form-control" accept="image/*" required>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-10 col-8 mx-auto">
                                <button type="submit" class="form-control">Buy Ticket</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </section>
@endsection
