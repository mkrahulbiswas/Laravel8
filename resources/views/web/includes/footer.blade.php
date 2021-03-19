<div class="home_footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="footer_style">
                    <h2>About Us</h2>
                    <p><a href="{{ route('fontend.about.show') }}"><?php echo substr($about, 0, 220).'...'; ?></a></p>
                    <a href="{{ route('fontend.home.show') }}">
                        <img class="ftr_logo" class="img-responsive" src="{{ $bigLogo }}" alt="img" />
                    </a>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="footer_style">
                    <h2>Category</h2>
                    <ul>
                        @foreach ($galleryCategoryFooter as $item)
                        <li class="{{ (in_array($item->slug, explode('/', url()->current()))) ? 'active' : '' }}">
                            <a href="{{ route('fontend.gallery.detail').'/'.$item->slug }}">{{ $item->name }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="footer_style">
                    <h2>Contact Us</h2>
                    <p>{{ $footerContact->address }}</p>
                    <div class="ftr_contact_links">
                        <p><a href="tel:+{{ $footerContact->phone1 }}"><i class="fa fa-phone" aria-hidden="true"></i>{{ chunk_split($footerContact->phone1, 3, ' ') }}</a></p>
                        <p><a href="tel:{{ $footerContact->phone1 }}"><i class="fa fa-mobile" aria-hidden="true"></i>{{ chunk_split($footerContact->phone2, 3, ' ') }}</a></p>
                        <p><a href="mailto:{{ $footerContact->email }}"><i class="fa fa-envelope"
                                    aria-hidden="true"></i>{{ $footerContact->email }}</a></p>
                    </div>
                    <div class="ftr_social">
                        <a href="{{ $footerContact->facebook }}"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        <a href="{{ $footerContact->twitter }}"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        <a href="{{ $footerContact->google }}"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="ftr_btm">
    <div class="container">
        <div class="row">
            <p>Copyright © @php echo date('Y'); @endphp Autograph Collectors Club of India. All Rights Reserved.</p>
        </div>
    </div>
</div>
