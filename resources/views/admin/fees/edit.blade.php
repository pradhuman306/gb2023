@extends('layouts.adminlayout')
@section('content')
<div class="page-inner ad-inr">
    <section class="main-wrapper">
        <div class="page-color">
            <div class="page-header">
                <div class="page-title">
                    <h3>Edit <span>fees</span></h3>
                    <a href="{{url('/feesstructure')}}" class="add-btn">
                        <span>
                            <img src="{{url('/')}}/assets/image/Icon-arrow-back.svg" class="btn-arrow-show" alt="">
                            <img src="{{url('/')}}/assets/image/Icon-arrow-back-2.svg" class="btn-arrow-hide" alt="">
                        </span>
                        <span>Back</span>
                    </a>
                </div>
            </div>
            <div class="profile-box">
                <div class="short-code">
                    <form id="class-form" method="Post" action="{{route('feesstructure.update',$tests->id)}}" >
                        <input type="hidden" name="_method" value="PUT">
                        @csrf
                        <div class="col-md-6 last-input-margin">
                            <div class="form-group">
                                <label>Select Session</label><label class="error">*</label>
                                <select name="years_id" id="years_id">
                                    <option value="" selected>Select Session</option>
                                    @foreach($year as $y)
                                    <option value="{{$y->id}}" <?php
                                                                if ($y->id == $tests->years_id) {
                                                                    echo 'selected="selected"';
                                                                } ?>>{{$y->years}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Class</label><label class="error">*</label>
                                <select name="student_classes_id" id="student_classes_id">
                                    <option value="" selected>Select Class</option>
                                    @foreach($class as $c)
                                    <option value="{{$c->id}}" <?php
                                                                if ($c->id == $tests->student_classes_id) {
                                                                    echo 'selected="selected"';
                                                                } ?>>{{$c->class_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fees</label><label class="error">*</label>
                                <input type="text" placeholder="Fees" name="amount" id="amount" class="form-control" value="{{ $tests->amount}}">
                            </div>
                        </div>
                        <div class="btn btn-box">
                            <button type="submit" class="cstm-btn margin-top-15">update Fees</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('additionalscripts')
<script>
    $("#class-form").validate();
</script>
@endsection