@extends('frontend.layouts.master')
@section('title','Request Blood | Humanity')
@section('body')
<section id="booking">
    <div class="container">
        <div class="section-header">
            <h3>रक्त अनुरोध प्रपत्र</h3>
        </div>
        <span>🙏नोट:- कृपया मरीज की पूरी जानकारी विस्तार के साथ हॉस्पिटल द्वारा दिए गए ओरिजनल डिमांड लेटर और ब्लड रिपोर्ट के साथ जरूर दीजिए,पहले मरीज के घर के सदस्य रक्तदान करे🙏
            ब्लड बैंक से ब्लड 🩸लेने के लिए कृप्या मरीज का ब्लड सैंपल और डॉक्टर द्वारा दिया गया डिमांड लेटर साथ लेकर ब्लड बैंक आएं</span>
        <div class="row">
            <div class="col-12">
                <div class="booking-form">
                    <form>
                        <br>
                        <div class="form-row">
                            <div class="control-group col-sm-6">
                                <label>पेशेंट का नाम <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required="required" />
                            </div>
                            <div class="control-group col-sm-6">
                                <label>पेशेंट की उम्र <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required="required" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="control-group col-sm-6">
                                <label>पेशेंट का पता <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required="required" />
                            </div>
                            <div class="control-group col-sm-6">
                                <label>क्या प्रॉब्लम है <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="date" required="required" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="control-group col-sm-6">
                                <label>पेशेंट का ब्लड ग्रुप <span class="text-danger">*</span></label>
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
                                <label>कितना यूनिट ब्लड चाहिए <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" required="required"/>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="control-group col-sm-6">
                                <label>हॉस्पिटल का नाम <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required="required" />
                            </div>
                            <div class="control-group col-sm-6">
                                <label>हॉस्पिटल का पता <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required="required" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="control-group col-sm-6">
                                <label>ब्लड कब चाहिए तारीख <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" required="required" />
                            </div>
                            <div class="control-group col-sm-6">
                                <label>अटेंडेंट का नाम <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required="required" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="control-group col-sm-6">
                                <label>अटेंडेंट का मोबाइल नंबर <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required="required" />
                            </div>
                            <div class="control-group col-sm-6">
                                <label>परिवार वालों ने कितना यूनिट ब्लड दिया <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" required="required" />
                            </div>
                        </div>
                        <span>नोट:- इस पूरी जानकारी की जवाबदेही मरीज़ के परिजन की है,किसी भी गलत जानकारी के लिए मरीज के परिजन की जवाबदेही होगी।</span>
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