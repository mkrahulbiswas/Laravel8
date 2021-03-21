@extends('admin.layouts.app')
@section('content')
        

<div class="row">
    <div class="col-sm-12">
        <div class="btn-group pull-right m-t-15">
            <a href="#" onClick="javascript:window.close('','_parent','');" class="btn closeBtn waves-effect waves-light m-l-15"><i class=""></i> Close</a>
        </div>
        <h4 class="page-title">Customize Table Color Detail View</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Customize Admin</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('admin.show.appearance') }}">Appearance</a></li>
            <li class="breadcrumb-item active">Customize Table Color Detail View</li>
        </ol>
    </div>
</div>



<div class="row">
    <p class="text-muted font-14 m-b-30">
        <div class="alert alert-danger" id="alert" style="display: none">
            <center><strong id="validationAlert" style="font-size: 14px; font-weight: 500"></strong></center>
        </div>
    </p>
    <div class="col-lg-12 m-b-20">
        <ul class="nav nav-pills mb-3 Appearance">
            <li class="nav-item tab">
                <a href="#tabOne" data-toggle="tab" aria-expanded="true" class="nav-link active show">Table Head Color</a>
            </li>
            <li class="nav-item tab">
                <a href="#tabTwo" data-toggle="tab" aria-expanded="false" class="nav-link show">Table Body Color</a>
            </li>
            <li class="nav-item tab">
                <a href="#tabThree" data-toggle="tab" aria-expanded="false" class="nav-link show">Table Head Style</a>
            </li>
            <li class="nav-item tab">
                <a href="#tabFour" data-toggle="tab" aria-expanded="false" class="nav-link show">Table Body Style</a>
            </li>
        </ul>
        
        <div class="tab-content" style="padding: 0;">

            <div class="tab-pane active" id="tabOne">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            
                            <div class="row">
                                <div class="col-lg-12 m-b-20">
                                    <div class="accordion" id="accordionOne">
                                        
                                        <div class="card">
                                            <div class="card-header" id="headingOne">
                                                <h6 class="m-0">
                                                    <a href="#collapseOne" class="collapsed text-dark" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne">Table Head Color Code In Text</a>
                                                </h6>
                                            </div>
                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionOne">
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <lable class="font-weight-bold">Normally Backgroung Color: &nbsp;&nbsp;</lable>
                                                                rgba({{ $data['headBackColor'] }}) &nbsp;&nbsp;&nbsp;&nbsp;
                                                                <span style="background-color: rgba({{ $data['headBackColor'] }}); padding: 2px 30px;"></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <lable class="font-weight-bold">Normally Text Color: &nbsp;&nbsp;</lable>
                                                                rgba({{ $data['headTextColor'] }}) &nbsp;&nbsp;&nbsp;&nbsp;
                                                                <span style="background-color: rgba({{ $data['headTextColor'] }}); padding: 2px 30px;"></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <lable class="font-weight-bold">On Hover Backgroung Color: &nbsp;&nbsp;</lable>
                                                                rgba({{ $data['headHoverBackColor'] }}) &nbsp;&nbsp;&nbsp;&nbsp;
                                                                <span style="background-color: rgba({{ $data['headHoverBackColor'] }}); padding: 2px 30px;"></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <lable class="font-weight-bold">On Hover Text Color: &nbsp;&nbsp;</lable>
                                                                rgba({{ $data['headHoverTextColor'] }}) &nbsp;&nbsp;&nbsp;&nbsp;
                                                                <span style="background-color: rgba({{ $data['headHoverTextColor'] }}); padding: 2px 30px;"></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="headingTwo">
                                                <h6 class="m-0">
                                                    <a href="#collapseTwo" class="collapsed text-dark" data-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo">Table Head Color Demo</a>
                                                </h6>
                                            </div>
                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionOne">
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-md-12">

                                                            <table class="tableStyle table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Demo</th>
                                                                        <th>Demo</th>
                                                                        <th>Demo</th>
                                                                        <th>Demo</th>
                                                                    </tr>
                                                                </thead>
                                                                
                                                                <tbody></tbody>
                                                            </table>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            

            <div class="tab-pane" id="tabTwo">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            
                            <div class="row">
                                <div class="col-lg-12 m-b-20">
                                    <div class="accordion" id="accordionTwo">
                                        
                                        <div class="card">
                                            <div class="card-header" id="headingThree">
                                                <h6 class="m-0">
                                                    <a href="#collapseThree" class="collapsed text-dark" data-toggle="collapse" aria-expanded="true" aria-controls="collapseThree">Table Body Color Code In Text</a>
                                                </h6>
                                            </div>
                                            <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionTwo">
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <lable class="font-weight-bold">Normally Backgroung Color: &nbsp;&nbsp;</lable>
                                                                rgba({{ $data['bodyBackColor'] }}) &nbsp;&nbsp;&nbsp;&nbsp;
                                                                <span style="background-color: rgba({{ $data['bodyBackColor'] }}); padding: 2px 30px;"></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <lable class="font-weight-bold">Normally Text Color: &nbsp;&nbsp;</lable>
                                                                rgba({{ $data['bodyTextColor'] }}) &nbsp;&nbsp;&nbsp;&nbsp;
                                                                <span style="background-color: rgba({{ $data['bodyTextColor'] }}); padding: 2px 30px;"></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <lable class="font-weight-bold">On Hover Backgroung Color: &nbsp;&nbsp;</lable>
                                                                rgba({{ $data['bodyHoverBackColor'] }}) &nbsp;&nbsp;&nbsp;&nbsp;
                                                                <span style="background-color: rgba({{ $data['bodyHoverBackColor'] }}); padding: 2px 30px;"></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <lable class="font-weight-bold">On Hover Text Color: &nbsp;&nbsp;</lable>
                                                                rgba({{ $data['bodyHoverTextColor'] }}) &nbsp;&nbsp;&nbsp;&nbsp;
                                                                <span style="background-color: rgba({{ $data['bodyHoverTextColor'] }}); padding: 2px 30px;"></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="headingFour">
                                                <h6 class="m-0">
                                                    <a href="#collapseFour" class="collapsed text-dark" data-toggle="collapse" aria-expanded="false" aria-controls="collapseFour">Table Body Color Demo</a>
                                                </h6>
                                            </div>
                                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionTwo">
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-md-12">

                                                            <table class="tableStyle table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                                                <thead></thead>
                                                                
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Demo</td>
                                                                        <td>Demo</td>
                                                                        <td>Demo</td>
                                                                        <td>Demo</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Demo</td>
                                                                        <td>Demo</td>
                                                                        <td>Demo</td>
                                                                        <td>Demo</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Demo</td>
                                                                        <td>Demo</td>
                                                                        <td>Demo</td>
                                                                        <td>Demo</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Demo</td>
                                                                        <td>Demo</td>
                                                                        <td>Demo</td>
                                                                        <td>Demo</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            

            <div class="tab-pane" id="tabThree">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            
                            <div class="row">
                                <div class="col-lg-12 m-b-20">
                                    <div class="accordion" id="accordionThree">
                                        
                                        <div class="card">
                                            <div class="card-header" id="headingFive">
                                                <h6 class="m-0">
                                                    <a href="#collapseFive" class="collapsed text-dark" data-toggle="collapse" aria-expanded="true" aria-controls="collapseFive">Table Body Style Code In Text</a>
                                                </h6>
                                            </div>
                                            <div id="collapseFive" class="collapse show" aria-labelledby="headingFive" data-parent="#accordionThree">
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <lable class="font-weight-bold">Font Family: &nbsp;&nbsp;</lable>
                                                                {{ $data['headTableStyle']->fontType }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <lable class="font-weight-bold">Font Style: &nbsp;&nbsp;</lable>
                                                                {{ $data['headTableStyle']->fontStyle }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <lable class="font-weight-bold">Font Weight: &nbsp;&nbsp;</lable>
                                                                {{ $data['headTableStyle']->fontWeight }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <lable class="font-weight-bold">Font Size: &nbsp;&nbsp;</lable>
                                                                {{ $data['headTableStyle']->fontSize }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <lable class="font-weight-bold">Text Decoration Type: &nbsp;&nbsp;</lable>
                                                                {{ $data['headTableStyle']->decorationType }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <lable class="font-weight-bold">Text Decoration Style: &nbsp;&nbsp;</lable>
                                                                {{ $data['headTableStyle']->decorationStyle }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <lable class="font-weight-bold">Text Decoration Color: &nbsp;&nbsp;</lable>
                                                                rgba({{ $data['headTableStyle']->decorationColor }}) &nbsp;&nbsp;&nbsp;&nbsp;
                                                                <span style="background-color: rgba({{ $data['headTableStyle']->decorationColor }}); padding: 2px 30px;"></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <lable class="font-weight-bold">Text Decoration Size: &nbsp;&nbsp;</lable>
                                                                {{ $data['headTableStyle']->decorationSize }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="headingSix">
                                                <h6 class="m-0">
                                                    <a href="#collapseSix" class="collapsed text-dark" data-toggle="collapse" aria-expanded="false" aria-controls="collapseSix">Table Body Style Demo On Text</a>
                                                </h6>
                                            </div>
                                            <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionThree">
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-md-12">

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <p style="font-family: {{ $data['headTableStyle']->fontType }} !important; font-style: {{ $data['headTableStyle']->fontStyle }} !important; font-weight: {{ $data['headTableStyle']->fontWeight }} !important; font-size: {{ $data['headTableStyle']->fontSize }}px !important; text-decoration: {{ $data['headTableStyle']->decorationType }} {{ $data['headTableStyle']->decorationStyle }} rgba({{ $data['headTableStyle']->decorationColor }}) {{ $data['headTableStyle']->decorationSize }}px !important;">Lorem ipsum dolor sit amet consectetur adipisicing elit. A repellendus sapiente dignissimos illo. Numquam inventore aspernatur obcaecati tempore perferendis enim. Distinctio necessitatibus ipsum voluptates nostrum ipsa autem nobis eveniet enim.
                                                                        Ab harum ullam velit quo voluptatibus a quaerat nisi placeat culpa dignissimos, quidem, necessitatibus illum maiores, veritatis impedit nam. Modi dolores molestiae delectus laboriosam ea, nemo voluptas quos similique repellat.
                                                                        Est corporis blanditiis, voluptatum consectetur quia, dolores facilis unde doloribus temporibus quo asperiores dignissimos cum quasi iste quam expedita modi possimus aspernatur dolorem velit distinctio numquam provident quibusdam? Ipsum, sunt.
                                                                        Autem, libero ipsa? Distinctio corporis, hic dolor magni repellat tenetur cupiditate autem nobis ea, voluptate architecto animi et aperiam voluptatem. Autem reprehenderit nemo sunt magnam quod numquam quae dolore molestiae?
                                                                        Ipsa reprehenderit quos perferendis vel officiis qui voluptatum aliquid at reiciendis non, ipsam soluta, eos alias. Dolorum qui voluptatibus, tempore consequatur exercitationem esse quis nostrum iure quas, deleniti neque beatae.
                                                                        Cum, culpa recusandae porro assumenda dolorem delectus reprehenderit mollitia accusamus sit quod pariatur sunt animi laborum eligendi tempora libero alias ad fugiat quidem magnam id ea modi! Consectetur, inventore fugit?
                                                                        Fugit blanditiis necessitatibus minima quod eveniet nobis quibusdam. Natus explicabo non, rerum expedita vel dolor nulla quidem ipsa hic, cumque rem. Facilis sed dolorum eos nobis assumenda voluptatum illum eaque.
                                                                        Harum velit autem sequi laboriosam nulla molestias obcaecati sapiente et nobis officiis iure labore tenetur laudantium error, repudiandae aliquam neque voluptas! Alias reiciendis commodi nihil possimus minus, ipsa vero quam!
                                                                        Harum sapiente soluta facilis sed inventore ea quisquam dicta doloremque ratione odit totam illo esse excepturi quaerat laudantium obcaecati ex eaque porro, quas ipsam rerum dolores deserunt, quae minima? Rem!
                                                                        Nesciunt possimus modi aut nulla totam explicabo, deleniti perferendis magnam aperiam, dolor tempora. Quo nesciunt, ipsa, totam aperiam excepturi natus quidem nihil eligendi accusantium odit nemo incidunt quam quos odio!</p>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="headingSeven">
                                                <h6 class="m-0">
                                                    <a href="#collapseSeven" class="collapsed text-dark" data-toggle="collapse" aria-expanded="false" aria-controls="collapseSeven">Table Body Style Demo On Table</a>
                                                </h6>
                                            </div>
                                            <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionThree">
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-md-12">

                                                            <table class="tableStyle table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                                                <thead>
                                                                    <tr style="font-family: {{ $data['headTableStyle']->fontType }} !important; font-style: {{ $data['headTableStyle']->fontStyle }} !important; font-weight: {{ $data['headTableStyle']->fontWeight }} !important; font-size: {{ $data['headTableStyle']->fontSize }}px !important; text-decoration: {{ $data['headTableStyle']->decorationType }} {{ $data['headTableStyle']->decorationStyle }} rgba({{ $data['headTableStyle']->decorationColor }}) {{ $data['headTableStyle']->decorationSize }}px !important;">
                                                                        <th>Demo</th>
                                                                        <th>Demo</th>
                                                                        <th>Demo</th>
                                                                        <th>Demo</th>
                                                                    </tr>
                                                                </thead>
                                                                
                                                                <tbody></tbody>
                                                            </table>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            

            <div class="tab-pane" id="tabFour">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            
                            <div class="row">
                                <div class="col-lg-12 m-b-20">
                                    <div class="accordion" id="accordionThree">
                                        
                                        <div class="card">
                                            <div class="card-header" id="headingEight">
                                                <h6 class="m-0">
                                                    <a href="#collapseEight" class="collapsed text-dark" data-toggle="collapse" aria-expanded="true" aria-controls="collapseEight">Table Head Style Code In Text</a>
                                                </h6>
                                            </div>
                                            <div id="collapseEight" class="collapse show" aria-labelledby="headingEight" data-parent="#accordionThree">
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <lable class="font-weight-bold">Font Family: &nbsp;&nbsp;</lable>
                                                                {{ $data['bodyTableStyle']->fontType }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <lable class="font-weight-bold">Font Style: &nbsp;&nbsp;</lable>
                                                                {{ $data['bodyTableStyle']->fontStyle }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <lable class="font-weight-bold">Font Weight: &nbsp;&nbsp;</lable>
                                                                {{ $data['bodyTableStyle']->fontWeight }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <lable class="font-weight-bold">Font Size: &nbsp;&nbsp;</lable>
                                                                {{ $data['bodyTableStyle']->fontSize }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <lable class="font-weight-bold">Text Decoration Type: &nbsp;&nbsp;</lable>
                                                                {{ $data['bodyTableStyle']->decorationType }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <lable class="font-weight-bold">Text Decoration Style: &nbsp;&nbsp;</lable>
                                                                {{ $data['bodyTableStyle']->decorationStyle }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <lable class="font-weight-bold">Text Decoration Color: &nbsp;&nbsp;</lable>
                                                                rgba({{ $data['bodyTableStyle']->decorationColor }}) &nbsp;&nbsp;&nbsp;&nbsp;
                                                                <span style="background-color: rgba({{ $data['bodyTableStyle']->decorationColor }}); padding: 2px 30px;"></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <lable class="font-weight-bold">Text Decoration Size: &nbsp;&nbsp;</lable>
                                                                {{ $data['bodyTableStyle']->decorationSize }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="headingNile">
                                                <h6 class="m-0">
                                                    <a href="#collapseNile" class="collapsed text-dark" data-toggle="collapse" aria-expanded="false" aria-controls="collapseNile">Table Body Style Demo On Text</a>
                                                </h6>
                                            </div>
                                            <div id="collapseNile" class="collapse" aria-labelledby="headingNile" data-parent="#accordionThree">
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-md-12">

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <p style="font-family: {{ $data['bodyTableStyle']->fontType }} !important; font-style: {{ $data['bodyTableStyle']->fontStyle }} !important; font-weight: {{ $data['bodyTableStyle']->fontWeight }} !important; font-size: {{ $data['bodyTableStyle']->fontSize }}px !important; text-decoration: {{ $data['bodyTableStyle']->decorationType }} {{ $data['bodyTableStyle']->decorationStyle }} rgba({{ $data['bodyTableStyle']->decorationColor }}) {{ $data['bodyTableStyle']->decorationSize }}px !important;">Lorem ipsum dolor sit amet consectetur adipisicing elit. A repellendus sapiente dignissimos illo. Numquam inventore aspernatur obcaecati tempore perferendis enim. Distinctio necessitatibus ipsum voluptates nostrum ipsa autem nobis eveniet enim.
                                                                        Ab harum ullam velit quo voluptatibus a quaerat nisi placeat culpa dignissimos, quidem, necessitatibus illum maiores, veritatis impedit nam. Modi dolores molestiae delectus laboriosam ea, nemo voluptas quos similique repellat.
                                                                        Est corporis blanditiis, voluptatum consectetur quia, dolores facilis unde doloribus temporibus quo asperiores dignissimos cum quasi iste quam expedita modi possimus aspernatur dolorem velit distinctio numquam provident quibusdam? Ipsum, sunt.
                                                                        Autem, libero ipsa? Distinctio corporis, hic dolor magni repellat tenetur cupiditate autem nobis ea, voluptate architecto animi et aperiam voluptatem. Autem reprehenderit nemo sunt magnam quod numquam quae dolore molestiae?
                                                                        Ipsa reprehenderit quos perferendis vel officiis qui voluptatum aliquid at reiciendis non, ipsam soluta, eos alias. Dolorum qui voluptatibus, tempore consequatur exercitationem esse quis nostrum iure quas, deleniti neque beatae.
                                                                        Cum, culpa recusandae porro assumenda dolorem delectus reprehenderit mollitia accusamus sit quod pariatur sunt animi laborum eligendi tempora libero alias ad fugiat quidem magnam id ea modi! Consectetur, inventore fugit?
                                                                        Fugit blanditiis necessitatibus minima quod eveniet nobis quibusdam. Natus explicabo non, rerum expedita vel dolor nulla quidem ipsa hic, cumque rem. Facilis sed dolorum eos nobis assumenda voluptatum illum eaque.
                                                                        Harum velit autem sequi laboriosam nulla molestias obcaecati sapiente et nobis officiis iure labore tenetur laudantium error, repudiandae aliquam neque voluptas! Alias reiciendis commodi nihil possimus minus, ipsa vero quam!
                                                                        Harum sapiente soluta facilis sed inventore ea quisquam dicta doloremque ratione odit totam illo esse excepturi quaerat laudantium obcaecati ex eaque porro, quas ipsam rerum dolores deserunt, quae minima? Rem!
                                                                        Nesciunt possimus modi aut nulla totam explicabo, deleniti perferendis magnam aperiam, dolor tempora. Quo nesciunt, ipsa, totam aperiam excepturi natus quidem nihil eligendi accusantium odit nemo incidunt quam quos odio!</p>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="headingTen">
                                                <h6 class="m-0">
                                                    <a href="#collapseTen" class="collapsed text-dark" data-toggle="collapse" aria-expanded="false" aria-controls="collapseTen">Table Body Style Demo On Table</a>
                                                </h6>
                                            </div>
                                            <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordionThree">
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-md-12">

                                                            <table class="tableStyle table table-bordered table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                                                <thead></thead>
                                                                
                                                                <tbody>
                                                                    <tr style="font-family: {{ $data['bodyTableStyle']->fontType }} !important; font-style: {{ $data['bodyTableStyle']->fontStyle }} !important; font-weight: {{ $data['bodyTableStyle']->fontWeight }} !important; font-size: {{ $data['bodyTableStyle']->fontSize }}px !important; text-decoration: {{ $data['bodyTableStyle']->decorationType }} {{ $data['bodyTableStyle']->decorationStyle }} rgba({{ $data['bodyTableStyle']->decorationColor }}) {{ $data['bodyTableStyle']->decorationSize }}px !important;">
                                                                        <td>Demo</td>
                                                                        <td>Demo</td>
                                                                        <td>Demo</td>
                                                                        <td>Demo</td>
                                                                    </tr>
                                                                    <tr style="font-family: {{ $data['bodyTableStyle']->fontType }} !important; font-style: {{ $data['bodyTableStyle']->fontStyle }} !important; font-weight: {{ $data['bodyTableStyle']->fontWeight }} !important; font-size: {{ $data['bodyTableStyle']->fontSize }}px !important; text-decoration: {{ $data['bodyTableStyle']->decorationType }} {{ $data['bodyTableStyle']->decorationStyle }} rgba({{ $data['bodyTableStyle']->decorationColor }}) {{ $data['bodyTableStyle']->decorationSize }}px !important;">
                                                                        <td>Demo</td>
                                                                        <td>Demo</td>
                                                                        <td>Demo</td>
                                                                        <td>Demo</td>
                                                                    </tr>
                                                                    <tr style="font-family: {{ $data['bodyTableStyle']->fontType }} !important; font-style: {{ $data['bodyTableStyle']->fontStyle }} !important; font-weight: {{ $data['bodyTableStyle']->fontWeight }} !important; font-size: {{ $data['bodyTableStyle']->fontSize }}px !important; text-decoration: {{ $data['bodyTableStyle']->decorationType }} {{ $data['bodyTableStyle']->decorationStyle }} rgba({{ $data['bodyTableStyle']->decorationColor }}) {{ $data['bodyTableStyle']->decorationSize }}px !important;">
                                                                        <td>Demo</td>
                                                                        <td>Demo</td>
                                                                        <td>Demo</td>
                                                                        <td>Demo</td>
                                                                    </tr>
                                                                    <tr style="font-family: {{ $data['bodyTableStyle']->fontType }} !important; font-style: {{ $data['bodyTableStyle']->fontStyle }} !important; font-weight: {{ $data['bodyTableStyle']->fontWeight }} !important; font-size: {{ $data['bodyTableStyle']->fontSize }}px !important; text-decoration: {{ $data['bodyTableStyle']->decorationType }} {{ $data['bodyTableStyle']->decorationStyle }} rgba({{ $data['bodyTableStyle']->decorationColor }}) {{ $data['bodyTableStyle']->decorationSize }}px !important;">
                                                                        <td>Demo</td>
                                                                        <td>Demo</td>
                                                                        <td>Demo</td>
                                                                        <td>Demo</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
</div>


@endsection
