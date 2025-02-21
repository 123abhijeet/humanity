@extends('frontend.layouts.master')
@section('title','Become Member | Humanity')
@section('body')
<section id="booking">
    <div class="container">
        <div class="section-header">
            <h3>सदस्य बनें</h3>
        </div>
        <span> 🩸 🩸 रक्तदान – इंसानियत की सबसे बड़ी सेवा। 🩸 🩸</span>

        <div class="row">
            <div class="col-12">
                <div class="booking-form">
                    <form method="post" action="{{route('Store-Member')}}" id="MemberForm">
                        @csrf
                        <br>
                        <div class="form-row">
                            <div class="control-group col-sm-6">
                                <label>सदस्य का नाम <span class="text-danger">*</span></label>
                                <input type="text" name="members_name" class="form-control @error('members_name') is-invalid @enderror" value="{{ old('members_name') }}" required="required" />
                                @error('members_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="control-group col-sm-6">
                                <label>सदस्य की उम्र <span class="text-danger">*</span></label>
                                <input type="text" name="members_age" class="form-control @error('members_age') is-invalid @enderror" value="{{ old('members_age') }}" required="required" />
                                @error('members_age')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="control-group col-sm-6">
                                <label>सदस्य का मोबाइल नंबर <span class="text-danger">*</span></label>
                                <input type="text" name="members_mobile" class="form-control @error('members_mobile') is-invalid @enderror" value="{{ old('members_mobile') }}" required="required" />
                                @error('members_mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="control-group col-sm-6">
                                <label>सदस्य का पता <span class="text-danger">*</span></label>
                                <input type="text" name="members_address" class="form-control @error('members_address') is-invalid @enderror" value="{{ old('members_address') }}" required="required" />
                                @error('members_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="control-group col-sm-6">
                                <label>सदस्य का ब्लड ग्रुप <span class="text-danger">*</span></label>
                                <select name="members_blood_group" class="custom-select @error('members_blood_group') is-invalid @enderror">
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
                                @error('members_blood_group')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="control-group col-sm-6">
                                <label>आखरी रक्तदान की तिथि <span class="text-danger">*</span></label>
                                <input type="date" name="members_last_donation_date" class="form-control @error('members_last_donation_date') is-invalid @enderror" value="{{ old('members_last_donation_date') }}" required="required" />
                                @error('members_last_donation_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <span>🩸 🩸 हर बूंद कीमती है, इसे व्यर्थ न जाने दें – रक्तदान करें। 🩸 🩸</span>
                        <div class="button">
                            <br>
                            <button type="submit" id="MemberBtn">Join</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var MemberBtn = document.getElementById('MemberBtn');
        var MemberForm = document.getElementById('MemberForm');

        MemberBtn.addEventListener('click', function() {
            MemberBtn.disabled = true; // Disable the button to prevent double-click
            MemberForm.submit(); // Submit the form
        });
    });
</script>
@endsection