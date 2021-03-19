@if ($checkOne == 'loginPage')

    @if ($checkTwo == 'cssJs')
    <script>
        $(window).on('load', function () {
            $('#pageLoader').fadeOut(500);
        });
    </script>
    @endif

@else

    @if ($checkTwo == 'cssJs')
        @foreach ($reqData['customizeButton'] as $item)
            @if (config('constants.addBtn') == $item['btnFor'])
            <style>
                .addBtn,
                .addBtn i {
                    background-color: rgba({{ $item['backColor'] }});
                    color: rgba({{ $item['textColor'] }});
                    transition: all 0.3s ease-out;
                }

                .addBtn:hover i,
                .addBtn:hover {
                    background-color: rgba({{ $item['backHoverColor'] }});
                    color: rgba({{ $item['textHoverColor'] }});
                }
            </style>

            <script>
                $('.addBtn').find('i').attr('class', "{{ $item['btnIcon'] }}");
            </script>
            @elseif(config('constants.saveBtn') == $item['btnFor'])
            <style>
                .saveBtn,
                .saveBtn i {
                    background-color: rgba({{ $item['backColor'] }});
                    color: rgba({{ $item['textColor'] }});
                    transition: all 0.3s ease-out;
                }

                .saveBtn:hover,
                .saveBtn:hover i {
                    background-color: rgba({{ $item['backHoverColor'] }});
                    color: rgba({{ $item['textHoverColor'] }});
                }
            </style>

            <script>
                $('.saveBtn').find('i').attr('class', "{{ $item['btnIcon'] }}");
            </script>
            @elseif(config('constants.updateBtn') == $item['btnFor'])
            <style>
                .updateBtn,
                .updateBtn i {
                    background-color: rgba({{ $item['backColor'] }});
                    color: rgba({{ $item['textColor'] }});
                    transition: all 0.3s ease-out;
                }

                .updateBtn:hover,
                .updateBtn:hover i {
                    background-color: rgba({{ $item['backHoverColor'] }});
                    color: rgba({{ $item['textHoverColor'] }});
                }
            </style>

            <script>
                $('.updateBtn').find('i').attr('class', "{{ $item['btnIcon'] }}");
            </script>
            @elseif(config('constants.searchBtn') == $item['btnFor'])
            <style>
                .searchBtn,
                .searchBtn i {
                    background-color: rgba({{ $item['backColor'] }});
                    color: rgba({{ $item['textColor'] }});
                    transition: all 0.3s ease-out;
                }

                .searchBtn:hover,
                .searchBtn:hover i {
                    background-color: rgba({{ $item['backHoverColor'] }});
                    color: rgba({{ $item['textHoverColor'] }});
                }
            </style>

            <script>
                $('.searchBtn').find('i').attr('class', "{{ $item['btnIcon'] }}");
            </script>
            @elseif(config('constants.reloadBtn') == $item['btnFor'])
            <style>
                .reloadBtn,
                .reloadBtn i {
                    background-color: rgba({{ $item['backColor'] }});
                    color: rgba({{ $item['textColor'] }});
                    transition: all 0.3s ease-out;
                }

                .reloadBtn:hover,
                .reloadBtn:hover i {
                    background-color: rgba({{ $item['backHoverColor'] }});
                    color: rgba({{ $item['textHoverColor'] }});
                }
            </style>

            <script>
                $('.reloadBtn').find('i').attr('class', "{{ $item['btnIcon'] }}");
            </script>
            @elseif(config('constants.backBtn') == $item['btnFor'])
            <style>
                .backBtn,
                .backBtn i {
                    background-color: rgba({{ $item['backColor'] }});
                    color: rgba({{ $item['textColor'] }});
                    transition: all 0.3s ease-out;
                }

                .backBtn:hover,
                .backBtn:hover i {
                    background-color: rgba({{ $item['backHoverColor'] }});
                    color: rgba({{ $item['textHoverColor'] }});
                }
            </style>

            <script>
                $('.backBtn').find('i').attr('class', "{{ $item['btnIcon'] }}");
            </script>
            @else
            <style>
                .closeBtn,
                .closeBtn i {
                    background-color: rgba({{ $item['backColor'] }});
                    color: rgba({{ $item['textColor'] }});
                    transition: all 0.3s ease-out;
                }

                .closeBtn:hover,
                .closeBtn:hover i {
                    background-color: rgba({{ $item['backHoverColor'] }});
                    color: rgba({{ $item['textHoverColor'] }});
                }
            </style>

            <script>
                $('.closeBtn').find('i').attr('class', "{{ $item['btnIcon'] }}");
            </script>
            @endif
        @endforeach


        @if (in_array("appearance", $urlArray) && in_array("table", $urlArray) && in_array("details", $urlArray))
        <style>
            .tableStyle thead {
                background-color: rgba({{ $data['headBackColor'] }});
                color: rgba({{ $data['headTextColor'] }});
                transition: all 0.3s ease-out;
            }

            .tableStyle thead:hover {
                background-color: rgba({{ $data['headHoverBackColor'] }});
                color: rgba({{ $data['headHoverTextColor'] }});
            }

            .tableStyle tbody {
                background-color: rgba({{ $data['bodyBackColor'] }});
                color: rgba({{ $data['bodyTextColor'] }});
                transition: all 0.3s ease-out;
            }

            .tableStyle tbody:hover {
                background-color: rgba({{ $data['bodyHoverBackColor'] }});
                color: rgba({{ $data['bodyHoverTextColor'] }});
            }
        </style>
        @else
        <style>
            .tableStyle thead {
                background-color: rgba({{ $reqData['customizeTable']['headBackColor'] }});
                color: rgba({{ $reqData['customizeTable']['headTextColor'] }});
                transition: all 0.3s ease-out;
            }

            .tableStyle thead:hover {
                background-color: rgba({{ $reqData['customizeTable']['headHoverBackColor'] }});
                color: rgba({{ $reqData['customizeTable']['headHoverTextColor'] }});
            }

            .tableStyle thead tr{
                font-family: {{ $reqData['customizeTable']['headTableStyle']->fontType }} !important;
                font-style: {{ $reqData['customizeTable']['headTableStyle']->fontStyle }} !important;
                font-weight: {{ $reqData['customizeTable']['headTableStyle']->fontWeight }} !important;
                font-size: {{ $reqData['customizeTable']['headTableStyle']->fontSize }}px !important;
                text-decoration: {{ $reqData['customizeTable']['headTableStyle']->decorationType }} {{ $reqData['customizeTable']['headTableStyle']->decorationStyle }} rgba({{ $reqData['customizeTable']['headTableStyle']->decorationColor }}) {{ $reqData['customizeTable']['headTableStyle']->decorationSize }}px !important;
            }

            .tableStyle tbody {
                background-color: rgba({{ $reqData['customizeTable']['bodyBackColor'] }});
                color: rgba({{ $reqData['customizeTable']['bodyTextColor'] }});
                transition: all 0.3s ease-out;
            }

            .tableStyle tbody tr{
                font-family: {{ $reqData['customizeTable']['bodyTableStyle']->fontType }} !important;
                font-style: {{ $reqData['customizeTable']['bodyTableStyle']->fontStyle }} !important;
                font-weight: {{ $reqData['customizeTable']['bodyTableStyle']->fontWeight }} !important;
                font-size: {{ $reqData['customizeTable']['bodyTableStyle']->fontSize }}px !important;
                text-decoration: {{ $reqData['customizeTable']['bodyTableStyle']->decorationType }} {{ $reqData['customizeTable']['bodyTableStyle']->decorationStyle }} rgba({{ $reqData['customizeTable']['bodyTableStyle']->decorationColor }}) {{ $reqData['customizeTable']['bodyTableStyle']->decorationSize }}px !important;
            }

            .tableStyle tbody:hover {
                background-color: rgba({{ $reqData['customizeTable']['bodyHoverBackColor'] }});
                color: rgba({{ $reqData['customizeTable']['bodyHoverTextColor'] }});
            }
        </style>
        @endif


        <style>
            .card-box {
                border-top: 3px solid #0797dd !important;
            }
        </style>

        <!-- Loader Load End -->
        <script>
            $(window).on('load', function () {
                $('#pageLoader').fadeOut(500);
            });
        </script>
    @endif

@endif


@if ($checkTwo == 'loader')
            
    @foreach ($reqData['customizeLoader'] as $item)
        @if ($item->loaderFor == 1)
        <div id="pageLoader" class="pageLoader">
            {!! $item->html !!}
            <style>
                {!! $item->css !!}
            </style>
        </div>
        @else
        <div id="internalLoader" class="internalLoader">
            {!! $item->html !!}
            <style>
                {!! $item->css !!}
            </style>
        </div>
        @endif
    @endforeach

@elseif($checkTwo == 'alertMessage')

    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong><i class="fa fa-exclamation"></i> &nbsp;Error!</strong> {{$message}}.
        </div>
    @endif

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong><i class="fa fa-check"></i> &nbsp;Success!</strong> {{$message}}.
        </div>
    @endif

@endif