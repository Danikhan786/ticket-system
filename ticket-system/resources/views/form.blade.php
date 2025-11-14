@extends('layouts.frontend')

@section('content')
    <section class="ticket-section section-padding">
        <div class="section-overlay"></div>

        <div class="container">
            <div class="row">

                <div class="col-lg-6 col-10 mx-auto">
                    <form class="custom-form ticket-form mb-5 mb-lg-0" action="#" method="post" role="form"
                        enctype="multipart/form-data">
                        <h2 class="text-center mb-4">Get started here</h2>

                        <div class="ticket-form-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <input type="text" name="ticket-form-name" id="ticket-form-name" class="form-control"
                                        placeholder="Full name" required>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12">
                                    <input type="email" name="ticket-form-email" id="ticket-form-email"
                                        pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Email address" required>
                                </div>
                            </div>

                            <input type="tel" class="form-control" name="ticket-form-phone" placeholder="Ph 0300000000"
                                pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required="">

                            <input type="text" class="form-control" name="ticket-form-rollno" placeholder="Roll No"
                                required>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <input type="text" name="ticket-form-semester" id="ticket-form-semester"
                                        class="form-control" placeholder="Semester" required>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12">
                                    <input type="text" name="ticket-form-department" id="ticket-form-department"
                                        class="form-control" placeholder="Department" required>
                                </div>
                            </div>
                            <h6>Choose Ticket Type</h6>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-check form-control">
                                        <input class="form-check-input" type="radio" name="TicketForm"
                                            id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Eary bird $120
                                        </label>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-check form-check-radio form-control">
                                        <input class="form-check-input" type="radio" name="TicketForm"
                                            id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Standard $240
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-check form-check-radio form-control">
                                        <input class="form-check-input" type="radio" name="TicketForm"
                                            id="flexRadioDefault3">
                                        <label class="form-check-label" for="flexRadioDefault3">
                                            Premium $360
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <h6>Account Details</h6>
                            <div class="row mb-2">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <small class="form-text text-muted">Sadapay Account Name: <br> <b>Muhammad
                                            Sufyan</b></small>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <small class="form-text text-muted">Account Number: <br> <b>03319957331</b></small>
                                </div>
                            </div>
                            <div class="row">
                                <h6>Upload Account Screenshot</h6>
                                <div class="col-lg-12 col-md-12 col-12">
                                    <small class="form-text text-muted mb-2">Please upload a screenshot of your account
                                        details</small>
                                    <input type="file" name="ticket-form-account-screenshot"
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
