@extends('admin.layouts.app')
@section('content')
        

<div class="row">
    <div class="col-sm-12">
        <div class="btn-group pull-right m-t-15">
            <a href="#" onClick="javascript:window.close('','_parent','');" class="btn closeBtn waves-effect waves-light m-l-15"><i class=""></i> Close</a>
        </div>
        <h4 class="page-title">Add Customize Table Style</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Customize Admin</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('admin.show.appearance') }}">Appearance</a></li>
            <li class="breadcrumb-item active">Add Customize Table Style</li>
        </ol>
    </div>
</div>



<div class="row">
    <div class="col-lg-12">
        <div class="card-box">

            <p class="text-muted font-14 m-b-20"></p>
            <form id="saveCustomizeTableStyleForm" action="{{route('admin.save.customizeTableStyle')}}" method="POST" enctype="multipart/form-data">

                @csrf

                <input type="hidden" name="id" value="{{ $id }}">

                <div class="row">

                    <div class="tableCommon">
                        <div class="col-md-12">
                            <p>Table Style Applying to 'Table Head' </p>
                        </div>
                        <div class="row tableFormRow">
                            <div class="col-md-12">

                                <div class="row fontStyleCommon" data-check="fontType">
                                    <label class="col-md-2">Font Type:-</label>
                                    <div class="col-md-3">
                                        <select name="headFontType" class="advance-select-table-fontType">
                                            <option value="">Select Font Type</option>
                                            <option value="Comic Sans MS">Comic Sans MS</option>
                                            <option value="Algerian">Algerian</option>
                                            <option value="Baskerville Old Face">Baskerville Old Face</option>
                                            <option value="Berlin Sans FB">Berlin Sans FB</option>
                                            <option value="Bradley Hand ITC">Bradley Hand ITC</option>
                                            <option value="Castellar">Castellar</option>
                                            <option value="Century Gothic">Century Gothic</option>
                                        </select>
                                    </div>
                                    <div class="col-md-7 applyStyle">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</div>
                                </div>

                                <div class="row fontStyleCommon" data-check="fontStyle">
                                    <label class="col-md-2">Font Style:-</label>
                                    <div class="col-md-3">
                                        <select name="headFontStyle" class="advance-select-table-fontStyle">
                                            <option value="">Select Font Style</option>
                                            <option value="italic">Italic</option>
                                            <option value="normal">Normal</option>
                                        </select>
                                    </div>
                                    <div class="col-md-7 applyStyle">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</div>
                                </div>

                                <div class="row fontStyleCommon" data-check="fontWeight">
                                    <label class="col-md-2">Font Weight:-</label>
                                    <div class="col-md-3">
                                        <select name="headFontWeight" class="advance-select-table-fontWeight">
                                            <option value="">Select Font Weight</option>
                                            <option value="bold">Bold</option>
                                            <option value="normal">Normal</option>
                                        </select>
                                    </div>
                                    <div class="col-md-7 applyStyle">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</div>
                                </div>

                                <div class="row fontStyleCommon" data-check="fontSize">
                                    <label class="col-md-2">Font Size:-</label>
                                    <div class="col-md-3">
                                        <select name="headFontSize" class="advance-select-table-fontSize">
                                            <option value="">Select Font Size</option>
                                            <option value="8">8</option>
                                            <option value="10">10</option>
                                            <option value="12">12</option>
                                            <option value="14">14</option>
                                            <option value="16">16</option>
                                            <option value="18">18</option>
                                        </select>
                                    </div>
                                    <div class="col-md-7 applyStyle">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</div>
                                </div>

                                <div class="fontStyleCommon" data-check="decorationType">
                                    <label class="col-md-2">Text Decoration:-</label>
                                    <div class="row col-md-12">
                                        <div class="col-md-2">
                                            <select name="headDecorationType" class="advance-select-table-decorationType">
                                                <option value="">Select Type</option>
                                                <option value="underline">Under Line</option>
                                                <option value="overline">Over Line</option>
                                                <option value="line-through">Line Through</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select name="headDecorationStyle" class="advance-select-table-decorationStyle">
                                                <option value="">Select Style</option>
                                                <option value="dashed">Dashed</option>
                                                <option value="dotted">Dotted</option>
                                                <option value="wavy">Wavy</option>
                                                <option value="double">Double</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="row" style="margin: 0;">
                                                <button type="button" class="col-md-8 color-picker-1 btn btn-primary">Color</button>
                                                <button type="button" class="btn col-md-4 headDecorationColor" style="background-color: rgba(0, 0, 0, 1)"></button>
                                            </div>
                                            <input type="hidden" name="headDecorationColor" value="" id="headDecorationColor">
                                        </div>
                                        <div class="col-md-2">
                                            <select name="headDecorationSize" class="advance-select-table-decorationSize">
                                                <option value="">Select Size</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 applyStyle">Lorem, ipsum dolor sit amet.</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="tableCommon">
                        <div class="col-md-12">
                            <p>Table Style Applying to 'Table Body' </p>
                        </div>
                        <div class="row tableFormRow">
                            <div class="col-md-12">

                                <div class="row fontStyleCommon" data-check="fontType">
                                    <label class="col-md-2">Font Type:-</label>
                                    <div class="col-md-3">
                                        <select name="bodyFontType" class="advance-select-table-fontType">
                                            <option value="">Select Font Type</option>
                                            <option value="Comic Sans MS">Comic Sans MS</option>
                                            <option value="Algerian">Algerian</option>
                                            <option value="Baskerville Old Face">Baskerville Old Face</option>
                                            <option value="Berlin Sans FB">Berlin Sans FB</option>
                                            <option value="Bradley Hand ITC">Bradley Hand ITC</option>
                                            <option value="Castellar">Castellar</option>
                                            <option value="Century Gothic">Century Gothic</option>
                                        </select>
                                    </div>
                                    <div class="col-md-7 applyStyle">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</div>
                                </div>

                                <div class="row fontStyleCommon" data-check="fontStyle">
                                    <label class="col-md-2">Font Style:-</label>
                                    <div class="col-md-3">
                                        <select name="bodyFontStyle" class="advance-select-table-fontStyle">
                                            <option value="">Select Font Style</option>
                                            <option value="italic">Italic</option>
                                            <option value="normal">Normal</option>
                                        </select>
                                    </div>
                                    <div class="col-md-7 applyStyle">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</div>
                                </div>

                                <div class="row fontStyleCommon" data-check="fontWeight">
                                    <label class="col-md-2">Font Weight:-</label>
                                    <div class="col-md-3">
                                        <select name="bodyFontWeight" class="advance-select-table-fontWeight">
                                            <option value="">Select Font Weight</option>
                                            <option value="bold">Bold</option>
                                            <option value="normal">Normal</option>
                                        </select>
                                    </div>
                                    <div class="col-md-7 applyStyle">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</div>
                                </div>

                                <div class="row fontStyleCommon" data-check="fontSize">
                                    <label class="col-md-2">Font Size:-</label>
                                    <div class="col-md-3">
                                        <select name="bodyFontSize" class="advance-select-table-fontSize">
                                            <option value="">Select Font Size</option>
                                            <option value="8">8</option>
                                            <option value="10">10</option>
                                            <option value="12">12</option>
                                            <option value="14">14</option>
                                            <option value="16">16</option>
                                            <option value="18">18</option>
                                        </select>
                                    </div>
                                    <div class="col-md-7 applyStyle">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</div>
                                </div>

                                <div class="fontStyleCommon" data-check="decorationType">
                                    <label class="col-md-2">Text Decoration:-</label>
                                    <div class="row col-md-12">
                                        <div class="col-md-2">
                                            <select name="bodyDecorationType" class="advance-select-table-decorationType">
                                                <option value="">Select Type</option>
                                                <option value="underline">Under Line</option>
                                                <option value="overline">Over Line</option>
                                                <option value="line-through">Line Through</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select name="bodyDecorationStyle" class="advance-select-table-decorationStyle">
                                                <option value="">Select Style</option>
                                                <option value="dashed">Dashed</option>
                                                <option value="dotted">Dotted</option>
                                                <option value="wavy">Wavy</option>
                                                <option value="double">Double</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="row" style="margin: 0;">
                                                <button type="button" class="col-md-8 color-picker-2 btn btn-primary">Color</button>
                                                <button type="button" class="btn col-md-4 bodyDecorationColor" style="background-color: rgba(0, 0, 0, 1)"></button>
                                            </div>
                                            <input type="hidden" name="bodyDecorationColor" value="" id="bodyDecorationColor">
                                        </div>
                                        <div class="col-md-2">
                                            <select name="bodyDecorationSize" class="advance-select-table-decorationSize">
                                                <option value="">Select Size</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 applyStyle">Lorem, ipsum dolor sit amet.</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="form-group text-right m-b-0">
                    <button type="submit" id="saveCustomizeTableStyleBtn"  class="btn saveBtn waves-effect waves-light"><i class=""></i> <span>Save</span></button>
                </div>
                {{-- <br>
                <div class="alert alert-danger" id="alert" style="display: none">
                    <center><strong id="validationAlert" style="font-size: 14px; font-weight: 500"></strong></center>
                </div> --}}

            </form>
        </div> <!-- end card-box -->
    </div>
</div>


@endsection