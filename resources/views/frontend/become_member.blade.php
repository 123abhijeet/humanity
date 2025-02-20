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
                    <form>
                        <br>
                        <div class="form-row">
                            <div class="control-group col-sm-6">
                                <label>सदस्य का नाम <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required="required" />
                            </div>
                            <div class="control-group col-sm-6">
                                <label>सदस्य की उम्र <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required="required" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="control-group col-sm-6">
                                <label>सदस्य का मोबाइल नंबर <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required="required" />
                            </div>
                            <div class="control-group col-sm-6">
                                <label>सदस्य का पता <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required="required" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="control-group col-sm-6">
                                <label>सदस्य का ब्लड ग्रुप <span class="text-danger">*</span></label>
                                <select class="custom-select">
                                    <option selected disabled>Select Blood Group</option>
                                    <option value="">O+</option>
                                    <option>O-</option>
                                    <option>A+</option>
                                    <option>A-</option>
                                    <option>B+</option>
                                    <option>B-</option>
                                    <option>AB+</option>
                                    <option>AB-</option>
                                    <option>Bombay</option>
                                </select>
                            </div>
                            <div class="control-group col-sm-6">
                                <label>आखरी रक्तदान की तिथि <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" required="required" />
                            </div>
                        </div>
                        <span>🩸 🩸 हर बूंद कीमती है, इसे व्यर्थ न जाने दें – रक्तदान करें। 🩸 🩸</span>
                        <div class="button">
                            <br>
                            <button type="submit">Join</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection