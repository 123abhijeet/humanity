@extends('frontend.layouts.master')
@section('title','Home | Humanity')
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
                    <form method="post" action="{{route('Store-Blood-Request')}}" id="RequestForm">
                        @csrf
                        <br>
                        <div class="form-row">
                            <div class="control-group col-sm-6">
                                <label>पेशेंट का नाम (Patents Name)<span class="text-danger">*</span></label>
                                <input type="text" name="patent_name" class="form-control @error('patent_name') is-invalid @enderror" value="{{ old('patent_name') }}" required="required" />
                                @error('patent_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="control-group col-sm-6">
                                <label>पेशेंट की उम्र (Patents Age)<span class="text-danger">*</span></label>
                                <input type="text" name="patent_age" class="form-control @error('patent_age') is-invalid @enderror" value="{{ old('patent_age') }}" required="required" />
                                @error('patent_age')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="control-group col-sm-6">
                                <label>पेशेंट का पता (Patents Address)<span class="text-danger">*</span></label>
                                <input type="text" name="patent_address" class="form-control @error('patent_address') is-invalid @enderror" value="{{ old('patent_address') }}" required="required" />
                                @error('patent_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="control-group col-sm-6">
                                <label>क्या प्रॉब्लम है (Patents Problem)<span class="text-danger">*</span></label>
                                <input type="text" name="patent_problem" class="form-control @error('patent_problem') is-invalid @enderror" value="{{ old('patent_problem') }}" id="date" required="required" />
                                @error('patent_problem')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="control-group col-sm-6">
                                <label>पेशेंट का ब्लड ग्रुप (Patents Blood Group)<span class="text-danger">*</span></label>
                                <select name="patent_blood_group" class="custom-select @error('patent_blood_group') is-invalid @enderror">
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
                                @error('patent_blood_group')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="control-group col-sm-6">
                                <label>कितना यूनिट ब्लड चाहिए (Home Many Units Required)<span class="text-danger">*</span></label>
                                <input type="number" name="unit_required" class="form-control @error('unit_required') is-invalid @enderror" value="{{ old('unit_required') }}" required="required" />
                                @error('unit_required')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="control-group col-sm-6">
                                <label>हॉस्पिटल का नाम (Hospital Name)<span class="text-danger">*</span></label>
                                <input type="text" name="hospital_name" class="form-control @error('hospital_name') is-invalid @enderror" value="{{ old('hospital_name') }}" required="required" />
                                @error('hospital_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="control-group col-sm-6">
                                <label>हॉस्पिटल का पता (Hospital Address)<span class="text-danger">*</span></label>
                                <input type="text" name="hospital_address" class="form-control @error('hospital_address') is-invalid @enderror" value="{{ old('hospital_address') }}" required="required" />
                                @error('hospital_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="control-group col-sm-6">
                                <label>ब्लड कब चाहिए तारीख (Required Date)<span class="text-danger">*</span></label>
                                <input type="date" name="date_required" class="form-control @error('date_required') is-invalid @enderror" value="{{ old('date_required') }}" required="required" />
                                @error('date_required')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="control-group col-sm-6">
                                <label>अटेंडेंट का नाम (Attendent Name)<span class="text-danger">*</span></label>
                                <input type="text" name="attendent_name" class="form-control @error('attendent_name') is-invalid @enderror" value="{{ old('attendent_name') }}" required="required" />
                                @error('attendent_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="control-group col-sm-6">
                                <label>अटेंडेंट का मोबाइल नंबर (Attendent Mobile No)<span class="text-danger">*</span></label>
                                <input type="text" name="attendent_mobile" class="form-control @error('attendent_mobile') is-invalid @enderror" value="{{ old('attendent_mobile') }}" required="required" />
                                @error('attendent_mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="control-group col-sm-6">
                                <label>परिवार वालों ने कितना यूनिट ब्लड दिया (Total Donated Unit)<span class="text-danger">*</span></label>
                                <input type="number" name="donated_unit" class="form-control @error('donated_unit') is-invalid @enderror" value="{{ old('donated_unit') }}" required="required" />
                                @error('donated_unit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <span>नोट:- इस पूरी जानकारी की जवाबदेही मरीज़ के परिजन की है,किसी भी गलत जानकारी के लिए मरीज के परिजन की जवाबदेही होगी।</span>
                        <div class="button">
                            <br>
                            <button type="submit" id="RequestBtn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection