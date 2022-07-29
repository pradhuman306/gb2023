@extends('layouts.adminlayout')
@section('content')
<style>
 /*@media print {*/
   .result-main label {
      min-width: max-content;
   text-align: left;
    color:#000;
    margin:0;
   }
   .result-main input {
   border: 0;
   padding: 0;
       border-radius: 0;
           text-transform: inherit;
           height:inherit;
   }
   .result-main .progress-table input {
   border-bottom: 1px dotted #000;
   width: 100%;
     padding: 0 10px;
   }
   .result-main .progress-table span {
   width: 100%;
   }
   .result-main .marks-table span {
   width: 100%;
   }
   td {
   text-align:center;
   }
   .max-25 input, .max-25 {
   width:25px;
   }
   .width-100 input {
   width:100px;
   }
   .d-flex {
       display:flex;
       align-items:center;
   }
   
   
 /*}*/
</style>
<section class="main-wrapper">
   <div class="page-color">
      <div class="page-header">
         <div class="page-title">
            <h4><span>All Students</span></h4>
            <div class="user-drop-sec">
               <span class="c_session"><svg class="icon-sessions" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect x="3" y="6" width="18" height="15" rx="2" stroke="#8F99B3" stroke-width="2"></rect>
                                        <path d="M4 11H20" stroke="#8F99B3" stroke-width="2" stroke-linecap="round"></path>
                                        <path d="M9 16H15" stroke="#8F99B3" stroke-width="2" stroke-linecap="round"></path>
                                        <path d="M8 3L8 7" stroke="#8F99B3" stroke-width="2" stroke-linecap="round"></path>
                                        <path d="M16 3L16 7" stroke="#8F99B3" stroke-width="2" stroke-linecap="round"></path>
                                    </svg>
                   @php 
                    $year = App\Models\Year::where('status' ,'=', '1')->first();
                   echo $year->years; 
                   @endphp
               </span>
            </div>
         </div>
      </div>
      <div class="page-inr">
         <div class="result-main">
         <form method="post" id="result" action="{{url('/printresult')}}">
          @csrf 
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
               <tr>
                  <td>
                     <table width="650" border="0" cellpadding="0" cellspacing="0" align="center">
                        <tr>
                           <td>
                              <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                               <tr>
                                    <td colspan="5">
                                       <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table-head">
                                          <tr>
                                             <td colspan="2" align="center">
                                                <h3 style="font-size:30px;text-tranform:uppercase;margin-bottom:0;">
                                                   Gyan Bharti Convent School Sutreti
                                                </h3>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td colspan="2" align="center">
                                                <span>
                                                Thandla 457777, Mobile-9753408869
                                                </span>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td colspan="2" align="center">
                                                <span>
                                                Affiliated by Board of Eduction & Govt. of MP
                                                </span>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="text-align:left;">
                                                <span>
                                                Reg.No.PS 57693
                                                </span>
                                             </td>
                                             <td style="text-align:right;">
                                                <span>
                                                Dise Code 23240410506
                                                </span>
                                             </td>
                                          </tr>
                                       </table>
                                    </td>
                                 </tr>
                                   <tr>
                                    <td colspan="5" align="center" style="padding:40px 0;">
                                        <img src="{{url('/')}}/assets/image/logo.jpg" class="desk-show" alt="">
                                       <!--<img class="desk-show" src="data:image/png;base64,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" alt="">-->
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                        <tr>
                           <td>
                         
                              <table width="100%" border="0" cellpadding="5" cellspacing="25" class="progress-table">
                                 <tr>
                                    <td colspan="5" align="center">
                                       <h4 style="padding-bottom:20px">
                                         Progress Report <br>
                                         <span style="font-size:20px;">Session @php echo $year->years; @endphp
                                         </span>
                                       </h4>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td colspan="3">
                                       <div class="d-flex">
                                          <label for="">Name of Student</label>
                                          <span>
                                          <input type="hidden" name="student_id" value="{{$students->id}}">
                                            <input type="text" name="student_name" value=" {{$students->name}}">
                                          </span>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="d-flex">
                                          <label for="" >Class</label>
                                            <span>
                                          <input type="text" name="class_name" value=" {{$class_name}}">
                                          </span>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="d-flex">
                                          <label for="">to transfer</label>
                                            <span>
                                            <input type="text" name="nextclass" value="">
                                            </span>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <div class="d-flex">
                                          <label for="">section</label>
                                         <span>
                                         <input type="text" name="section" value="">
                                         </span>
                                       </div>
                                    </td>
                                    <td colspan="3">
                                       <div class="d-flex">
                                          <label for="">Date of Birth</label>
                                            <span>
                                            <input type="text" name="dob" value=" {{$students->dob}}">
                                            </span>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="d-flex">
                                          <label for="">Roll No</label>
                                            <span>
                                            <input type="text" name="rollno" value=" {{$students->student_id}}">
                                            </span>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td colspan="3">
                                       <div class="d-flex">
                                          <label for="">Mother's Name</label>
                                            <span>
                                            <input type="text"  name="mother_name" value=" {{$students->mother_name}}">
                                            </span>
                                       </div>
                                    </td>
                                    <td colspan="2">
                                       <div class="d-flex">
                                          <label for="">Father's Name</label>
                                            <span>
                                            <input type="text" name="father_name" value=" {{$students->father_name}}">
                                            </span>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td colspan="5" style="padding-bottom:20px">
                                       <div class="d-flex">
                                          <label for="">Residential address and Telephone no</label>
                                            <span>
                                            <input type="text" name="address" value=" {{$students->address}}, {{$students->mobile_no}}">
                                            </span>
                                       </div>
                                    </td>
                                 </tr>
                                  <tr>
                                    <td colspan="5" style="padding-bottom:20px">
                                       <div class="d-flex">
                                          <label for="">Scholar no</label>
                                            <span>
                                            <input type="number" name="scholar" value="{{$students->scholar_no}}">
                                            </span>
                                       </div>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <table width="100%" border="2" cellpadding="5" cellspacing="0" class="marks-table">
                                     <tr style="border-bottom:0">
                                    <td colspan="22" align="center" style="border:0">
                                       <h4 style="font-size:22px;margin: 10px 0;">
                                          Progress Report @php echo $year->years; @endphp
                                       </h4>
                                    </td>
                                 </tr>
                                 <tr style="border:0;">
                                    <td colspan="11"  style="border:0; text-align:left; padding-left:20px;padding-bottom: 15px;">
                                       <div class="d-flex">
                                          <label for="">Name</label>
                                          <span>
                                          <input type="hidden" name="student_id" value="{{$students->id}}">
                                            <input type="text" name="student_name" value=" {{$students->name}}" style="border-bottom: 1px dotted #000; width:90%">
                                          </span>
                                       </div>
                                    </td>
                                    <td colspan="7" style="border:0;padding-bottom: 15px;">
                                       <div class="d-flex">
                                          <label for="" >Class</label>
                                            <span>
                                          <input type="text" name="class_name" value=" {{$class_name}}" style="border-bottom: 1px dotted #000; width:90%">
                                          </span>
                                       </div>
                                    </td>
                                    <td colspan="4" style="border:0;padding-bottom: 15px;">
                                       <div class="d-flex">
                                          <label for="">Roll No</label>
                                            <span>
                                           <input type="text" name="rollno" value=" {{$students->student_id}}" style="border-bottom: 1px dotted #000; width:90%">
                                            </span>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr style="border-top: 2px solid;">
                                    <td rowspan="2">
                                       <b>Subject</b>
                                    </td>
                                    <td colspan="8">
                                       <b>Unit Test</b>
                                    </td>
                                    <td colspan="3">
                                       <b>I Term</b>
                                    </td>
                                    <td colspan="3">
                                       <b>II Term</b>
                                    </td>
                                    <td colspan="3">
                                       <b>III Term</b>
                                    </td>
                                    <td colspan="4">
                                       <b>Persnol Progress</b>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="max-25">MM</td>
                                    <td class="max-25">I</td>
                                    <td class="max-25">II</td>
                                    <td class="max-25">III</td>
                                    <td class="max-25">IV</td>
                                    <td class="max-25">V</td>
                                    <td class="max-25">VI</td>
                                    <td class="max-25">GR</td>
                                    <td class="max-25">MM</td>
                                    <td class="max-25">MO</td>
                                    <td class="max-25">GR</td>
                                    <td class="max-25">MM</td>
                                    <td class="max-25">MO</td>
                                    <td class="max-25">GR</td>
                                    <td class="max-25">MM</td>
                                    <td class="max-25">MO</td>
                                    <td class="max-25">GR</td>
                                    <td>Progress</td>
                                    <td class="max-25">I</td>
                                    <td class="max-25">II</td>
                                    <td class="max-25">III</td>
                                 </tr>
                                 <tr>
                                    <td>
                                       English Spacial
                                    </td>
                                    <td class="max-25">
                                       10
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject1" name="e1" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject2" name="e2" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject3" name="e3" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject4" name="e4" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject5" name="e5" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject6" name="e6" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="" name="e7" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       50
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subm1" name="term1e1" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text"  name="term1g1" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       50
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subm2" name="term2e1" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="term2g1" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       100
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subm3" name="term3e1" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="term3g1" value="" maxlength="3">
                                    </td>
                                    <td>
                                       Panculity
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="panculity1" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="panculity2" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="panculity3" value="" maxlength="3">
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                      Hindi General
                                    </td>
                                    <td class="max-25">
                                       10
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject1" name="h1" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject2" name="h2" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject3" name="h3" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject4" name="h4" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject5" name="h5" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject6" name="h6" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="" name="h7" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       50
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subm1" name="term1e2" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="term1g2" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       50
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subm2" name="term2e2" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="term2g2" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       100
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subm3" name="term3e2" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="term3g2" value="" maxlength="3">
                                    </td>
                                    <td>
                                       Regularity
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="regularity1" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="regularity2" value="" maxlength="3">
                                    </td> 
                                    <td class="max-25">
                                       <input type="text" name="regularity3" value="" maxlength="3">
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                      Maths
                                    </td>
                                    <td class="max-25">
                                       10
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject1" name="m1" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject2" name="m2" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject3" name="m3" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject4" name="m4" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject5" name="m5" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject6" name="m6" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="" name="m7" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       50
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subm1" name="term1e3" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="term1g3" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       50
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subm2" name="term2e3" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="term2g3" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       100
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subm3" name="term3e3" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="term3g3" value="" maxlength="3"> 
                                    </td>
                                    <td>
                                       Neat & Clean
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="neat1" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="neat2" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="neat3" value="" maxlength="3">
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                      Social Study / EVS
                                    </td>
                                    <td class="max-25">
                                       10
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject1" name="s1" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject2" name="s2" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject3" name="s3" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject4" name="s4" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject5" name="s5" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject6" name="s6" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="" name="s7" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       50
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subm1" name="term1e4" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="term1g4" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       50
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subm2" name="term2e4" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="term2g4" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       100
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subm3" name="term3e4" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="term3g4" value="" maxlength="3">
                                    </td>
                                    <td>
                                       Discipline
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="discipline1" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="discipline2" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="discipline3" value="" maxlength="3">
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                      Computer / Science
                                    </td>
                                    <td class="max-25">
                                       10
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject1" name="c1" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject2" name="c2" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject3" name="c3" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject4" name="c4" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject5" name="c5" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject6" name="c6" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="" name="c7" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       50
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subm1" name="term1e5" value="" maxlength="3">
                                    </td>
                                    <td class="max-25" >
                                       <input type="text" name="term1g5" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       50
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subm2" name="term2e5" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="term2g5" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       100
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subm3" name="term3e5" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="term3g5" value="" maxlength="3">
                                    </td>
                                    <td>
                                      Attentive in class
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="attentive1" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="attentive2" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="attentive3" value="" maxlength="3">
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                      Drawing / Project / Sanskrit
                                    </td>
                                    <td class="max-25">
                                       10
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject1" name="d1" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject2" name="d2" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject3" name="d3" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject4" name="d4" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject5" name="d5" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject6" name="d6" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="" name="d7" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       50
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subm1" name="term1e6" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="term1g6" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       50
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subm2" name="term2e6" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="term2g6" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       100
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subm3" name="term3e6" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="term3g6" value="" maxlength="3">
                                    </td>
                                    <td>
                                       Participate in Act
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="act1" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="act2" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="act3" value="" maxlength="3">
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       GK/Conv.
                                    </td>
                                    <td class="max-25">
                                       10
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject1" name="g1" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject2" name="g2" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject3" name="g3" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject4" name="g4" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject5" name="g5" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subject6" name="g6" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="" name="g7" value="">
                                    </td>
                                    <td class="max-25">
                                       50
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subm1" name="term1e7" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="term1g7" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       50
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subm2" name="term2e7" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="term2g7" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       100
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="subm3" name="term3e7" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="term3g7" value="" maxlength="3">
                                    </td>
                                    <td>
                                       Maintain B&C+
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="maintain1" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="maintain2" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="maintain3" value="" maxlength="3">
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       Total
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="testtotal" >
                                    </td>
                                    <td class="max-25">
                                       <input type="text" id="total1" name="total1" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" id="total2" name="total2" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" id="total3" name="total3" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" id="total4" name="total4" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" id="total5" name="total5" value="" maxlength="3">
                                    </td> 
                                    <td class="max-25">
                                       <input type="text" id="total6" name="total6" value="" maxlength="3">
                                    </td>
                                    <td>
                                    </td>
                                    <td class="max-25">
                                       <input type="text" class="totalm" id="marks" name="first_total" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" id="total7" class="totalm" name="firstm_total" value="" maxlength="3">
                                    </td>
                                    <td>
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="second_total" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" id="total8" name="secondm_total" value="" maxlength="3">
                                    </td>
                                    <td>
                                    </td>
                                    <td class="max-25">
                                       <input type="text" name="third_total" value="" maxlength="3">
                                    </td>
                                    <td class="max-25">
                                       <input type="text" id="total9" name="thirdm_total" value="" maxlength="3">
                                    </td>
                                    <td>
                                    </td>
                                    <td colspan="4" rowspan="4" style="vertical-align:top" >
                                       Teacher Remarks
                                      <input type="text" id="total10" name="teacher_remark" maxlength="3">
                                    </td>
                                 </tr>
                                 <tr>
                                    <td >
                                       Percentage
                                    </td>
                                    <td colspan="8">
                                       <input type="text" class="text-center">
                                    </td>
                                    <td colspan="3" class="width-100">
                                       <input type="text" id="percent" name="percentage1" value="" class="text-center">
                                    </td>
                                    <td colspan="3" class="width-100" >
                                       <input type="text" name="percentage2" value="" class="text-center">
                                    </td>
                                    <td colspan="3" class="width-100" >
                                       <input type="text" name="percentage3" value="" class="text-center">
                                    </td>
                                 </tr>
                                 <tr>
                                    <td >
                                       Result
                                    </td>
                                    <td colspan="8">
                                       <input type="text"  name="result" value="" class="text-center">
                                    </td>
                                    <td colspan="3" class="width-100">
                                       <input type="text"  name="result1" value="" class="text-center">
                                    </td>
                                    <td colspan="3" class="width-100">
                                       <input type="text"  name="result2" value="" class="text-center">
                                    </td>
                                    <td colspan="3" class="width-100">
                                       <input type="text"  name="result3" value="" class="text-center">
                                    </td>
                                 </tr>
                                 <tr>
                                    <td >
                                       Rank
                                    </td>
                                    <td colspan="8">
                                       <input type="text" name="rank" value="" class="text-center">
                                    </td>
                                    <td colspan="3" class="width-100">
                                       <input type="text" class="text-center">
                                    </td>
                                    <td colspan="3" class="width-100">
                                       <input type="text" class="text-center">
                                    </td>
                                    <td colspan="3" class="width-100">
                                       <input type="text" class="text-center">
                                    </td>
                                 </tr>
                                 <tr>
                                    <td >
                                       Attendance
                                    </td>
                                    <td colspan="8">
                                       <input type="text" name="attendance" value="" class="text-center">
                                    </td>
                                    <td colspan="3" class="width-100">
                                       <input type="text" class="text-center">
                                    </td>
                                    <td colspan="3" class="width-100">
                                       <input type="text" class="text-center">
                                    </td>
                                    <td colspan="3" class="width-100">
                                       <input type="text" class="text-center">
                                    </td>
                                    <td rowspan="5" colspan="4" style="vertical-align:top">
                                       Principal
                                    </td>
                                 </tr>
                                 <tr>
                                    <td >
                                       Sign.of.Teacher
                                    </td>
                                    <td colspan="8">
                                    </td>
                                    <td colspan="3">
                                    </td>
                                    <td colspan="3">
                                    </td>
                                    <td colspan="3">
                                    </td>
                                 </tr>
                                 <tr>
                                    <td >
                                       Sign.of.Teacher
                                    </td>
                                    <td colspan="8">
                                    </td>
                                    <td colspan="3">
                                    </td>
                                    <td colspan="3">
                                    </td>
                                    <td colspan="3">
                                    </td>
                                 </tr>
                                 <tr>
                                    <td >
                                       Sign.of.Principal
                                    </td>
                                    <td colspan="8">
                                    </td>
                                    <td colspan="3">
                                    </td>
                                    <td colspan="3">
                                    </td>
                                    <td colspan="3">
                                    </td>
                                 </tr>
                                 <tr>
                                    <td >
                                       Sign.of.Parents
                                    </td>
                                    <td colspan="8">
                                    </td>
                                    <td colspan="3">
                                    </td>
                                    <td colspan="3">
                                    </td>
                                    <td colspan="3">
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                     </table>
                  </td>
               </tr>
            </table>
            <div class="print-btn">
            <input type="submit" name="save" class="add-btn" id="save" onclick="window.print()" value="Save & Print">
            </div>
         </form>
         </div>
      </div>
      
   </div>
</section>
@endsection
@section('additionalscripts')
@endsection