  <!-- header -->

  



  <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title"></h4>
              </div>
              <div class="modal-body">
                  <div class="row">
                      <div class="col-sm-6">
                          <div class="autograph_image">
                              <img class="img-responsive" src="img/popup_image.jpg" alt="img" />
                              <img class="img-responsive" src="img/autograph_image.jpg" alt="img" />
                          </div>
                      </div>
                      <div class="col-sm-6">
                          <div class="autograph_popuptext">
                              <p class="born"></p>
                              <p class="place"></p>
                              <div class="achivement">

                              </div>
                              <br />
                              <br />
                              <p class="description"></p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>


  <div class="header_top">
      <div class="container">
          <div class="row">
              <div class="logo">
                  <a href="{{ route('fontend.home.show') }}">
                      <img class="img-responsive" src="{{ $bigLogo }}" alt="img" />
                  </a>
              </div>
              <div class="top_nav">
                  <div id="menu">
                      <ul class="nav">
                          <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ route('fontend.home.show') }}">Home</a></li>
                          <li class="{{ Request::is('about-us') ? 'active' : '' }}"><a href="{{ route('fontend.about.show') }}">About Us</a></li>
                          <li class="{{ Request::is('members') ? 'active' : '' }}"><a href="{{ route('fontend.members.show') }}">Members</a></li>
                          <li class="{{ (in_array("gallery", explode('/', url()->current()))) ? 'active' : '' }}"><a href="{{ route('fontend.gallery.show') }}">Gallery</a></li>
                          <li class="{{ Request::is('exchange') ? 'active' : '' }}"><a href="{{ route('fontend.exchange.show') }}">Exchange</a></li>
                          <li class="{{ Request::is('contact-us') ? 'active' : '' }}"><a href="{{ route('fontend.contact.show') }}">Contact Us</a></li>
                      </ul>
                  </div>
              </div>
              <div class="clearfix"></div>
          </div>
      </div>
  </div>
