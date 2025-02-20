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
                    <form>
                        <br>
                        <div class="form-row">
                            <div class="control-group col-sm-6">
                                <label>डोनर का नाम <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required="required" />
                            </div>
                            <div class="control-group col-sm-6">
                                <label>डोनर की उम्र <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required="required" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="control-group col-sm-6">
                                <label>डोनर का मोबाइल नंबर <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required="required" />
                            </div>
                            <div class="control-group col-sm-6">
                                <label>डोनर का पता <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required="required" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="control-group col-sm-6">
                                <label>डोनर का ब्लड ग्रुप <span class="text-danger">*</span></label>
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
                        <div class="form-row">
                            <div class="control-group col-sm-6">
                                <label>कैम्प / अस्पताल का नाम <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required="required" />
                            </div>
                            <div class="control-group col-sm-6">
                                <label>कैम्प / अस्पताल का पता <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required="required" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="control-group col-sm-6">
                                <label>रक्तदान की तिथि <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" required="required" />
                            </div>
                        </div>
                        <span>🩸 🩸 रक्त का कोई विकल्प नहीं, आपका दान ही किसी की जान बचा सकता है। 🩸 🩸</span>
                        <div class="button">
                            <br>
                            <button type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection