@extends('frontend.layouts.master')
@section('title','Donate Blood | Humanity')
@section('body')
<section id="booking">
    <div class="container">
        <div class="section-header">
            <h3>रक्तदान करें, जीवन बचाएं।</h3>
        </div>
        <span> 🩸 🩸 🙏रक्तदान महादान है, इससे बड़ा कोई दान नहीं। 🩸 🩸</span>

        <div class="row">
            <div class="col-12">
                <div class="booking-form">
                    <form method="post" action="{{route('Store-Blood-Donation')}}" id="DonationForm">
                        @csrf
                        <br>
                        <div class="form-row">
                            <div class="control-group col-sm-6">
                                <label>पंजीकरण संख्या (Registration No.)<span class="text-danger">*</span></label>
                                <input type="text" name="registration_no" class="form-control @error('registration_no') is-invalid @enderror" value="{{ old('registration_no') }}" required="required" />
                                @error('registration_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="control-group col-sm-6">
                                <label>रक्तदान की तिथि (Blood Donation Date)<span class="text-danger">*</span></label>
                                <input type="date" name="donation_date" class="form-control @error('donation_date') is-invalid @enderror" value="{{ old('donation_date') }}" required="required" />
                                @error('donation_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="control-group col-sm-6">
                                <label>डोनर का नाम (Donors Name)<span class="text-danger">*</span></label>
                                <input type="text" name="donors_name" class="form-control @error('donors_name') is-invalid @enderror" value="{{ old('donors_name') }}" required="required" />
                                @error('donors_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="control-group col-sm-6">
                                <label>डोनर की उम्र (Donors Age)<span class="text-danger">*</span></label>
                                <input type="text" name="donors_age" class="form-control @error('donors_age') is-invalid @enderror" value="{{ old('donors_age') }}" required="required" />
                                @error('donors_age')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="control-group col-sm-6">
                                <label>डोनर का मोबाइल नंबर (Donors Mobile No.)<span class="text-danger">*</span></label>
                                <input type="text" name="donors_mobile" class="form-control @error('donors_mobile') is-invalid @enderror" value="{{ old('donors_mobile') }}" required="required" />
                                @error('donors_mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="control-group col-sm-6">
                                <label>डोनर का पता (Donors Address)<span class="text-danger">*</span></label>
                                <input type="text" name="donors_address" class="form-control @error('donors_address') is-invalid @enderror" value="{{ old('donors_address') }}" required="required" />
                                @error('donors_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="control-group col-sm-6">
                                <label>डोनर का ब्लड ग्रुप (Donors Blood Group)<span class="text-danger">*</span></label>
                                <select class="custom-select @error('donors_blood_group') is-invalid @enderror" name="donors_blood_group">
                                    <option selected disabled>Select Blood Group</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="Bombay">Bombay</option>
                                </select>
                                @error('donors_blood_group')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="control-group col-sm-6">
                                <label>आखरी रक्तदान की तिथि (Last Blood Donation Date)<span class="text-danger">*</span></label>
                                <input type="date" name="donors_last_donation_date" class="form-control @error('donors_last_donation_date') is-invalid @enderror" value="{{ old('donors_last_donation_date') }}" required="required" />
                                @error('donors_last_donation_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="control-group col-sm-6">
                                <label>कैम्प / अस्पताल का नाम (Camp/Hospital Name)<span class="text-danger">*</span></label>
                                <input type="text" name="vanue_name" class="form-control @error('vanue_name') is-invalid @enderror" value="{{ old('vanue_name') }}" required="required" />
                                @error('vanue_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="control-group col-sm-6">
                                <label>कैम्प / अस्पताल का पता (Camp/Hospital Address)<span class="text-danger">*</span></label>
                                <input type="text" name="vanue_address" class="form-control @error('vanue_address') is-invalid @enderror" value="{{ old('vanue_address') }}" required="required" />
                                @error('vanue_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <span>🩸 🩸 रक्त का कोई विकल्प नहीं, आपका दान ही किसी की जान बचा सकता है। 🩸 🩸</span>
                        <div class="button">
                            <br>
                            <button type="submit" id="DonationBtn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var DonationBtn = document.getElementById('DonationBtn');
        var DonationForm = document.getElementById('DonationForm');

        DonationBtn.addEventListener('click', function() {
            DonationBtn.disabled = true; // Disable the button to prevent double-click
            DonationForm.submit(); // Submit the form
        });
    });
</script>
@endsection