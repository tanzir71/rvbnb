<?php 
    $this->db->where('id',$id);
    $query = $this->db->get("host");

    if ($query->num_rows() > 0) {
        $value = $query->row();
?>
<div class="page_header">
    <div class="profile_carousel slick-initialized slick-slider">
        <div aria-live="polite" class="slick-list draggable"><div class="slick-track" style="opacity: 1; width: 2528px; left: 0px;" role="listbox"><div class="slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" style="width: 316px;" tabindex="-1" role="option" aria-describedby="slick-slide00"> <img src="http://placehold.it/800x800" alt=""> </div><div class="slick-slide slick-active" data-slick-index="1" aria-hidden="false" style="width: 316px;" tabindex="-1" role="option" aria-describedby="slick-slide01"> <img src="http://placehold.it/800x800" alt=""> </div><div class="slick-slide slick-active" data-slick-index="2" aria-hidden="false" style="width: 316px;" tabindex="-1" role="option" aria-describedby="slick-slide02"> <img src="http://placehold.it/800x800" alt=""> </div><div class="slick-slide slick-active" data-slick-index="3" aria-hidden="false" style="width: 316px;" tabindex="-1" role="option" aria-describedby="slick-slide03"> <img src="http://placehold.it/800x800" alt=""> </div><div class="slick-slide" data-slick-index="4" aria-hidden="true" style="width: 316px;" tabindex="-1" role="option" aria-describedby="slick-slide04"> <img src="http://placehold.it/800x800" alt=""> </div><div class="slick-slide" data-slick-index="5" aria-hidden="true" style="width: 316px;" tabindex="-1" role="option" aria-describedby="slick-slide05"> <img src="http://placehold.it/800x800" alt=""> </div><div class="slick-slide" data-slick-index="6" aria-hidden="true" style="width: 316px;" tabindex="-1" role="option" aria-describedby="slick-slide06"> <img src="http://placehold.it/800x800" alt=""> </div><div class="slick-slide" data-slick-index="7" aria-hidden="true" style="width: 316px;" tabindex="-1" role="option" aria-describedby="slick-slide07"> <img src="http://placehold.it/800x800" alt=""> </div></div></div>
        
        
        
        
        
        
        
    </div>
    <div class="container">
        <ul class="bcrumbs">
            <li><a href="#">Restaurant guide</a> </li>
            <li><a href="#">Restaurants Paris</a> </li>
            <li>Restaurant Laurent - Alain Pegouret - Paris</li>
        </ul>
    </div>
</div>


<div class="directory-profile">
    <div class="dp-header">
        <div class="container">
            <div class="row">
                <div class="col-md-8 dph-info"> <img src="images/profile.png" class="profile-img" alt="">
                    <div>
                        <h4><?php echo $value->title; ?></h4>
                        <p><?php echo $value->location; ?></p><p>Phone Number:   <?php echo $value->phone_number; ?></p> <a href="#">French</a> <a href="#">Luxury</a> </div>
                </div>
                <div class="col-md-4 dph-reviews">
                    <p><span>9,2 &nbsp;<em>/10</em></span> 21 reviews</p>
                    <p class="dph-rec"><i class="fa fa-star-o"></i><span>178</span> Recommendations</p>
                </div>
            </div>
        </div>
    </div>
    <div class="dp-info">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="dp-about">
                        <p class="space120"> <img src="images/icons/1.png" alt=""> <span class="lead">About this listing</span> Pork belly iPhone twee dreamcatcher kitsch. Listicle cliche vegan lomo typewriter, hoodie beard mlkshk. Mumblecore squid trust fund semiotics, brunch umami typewriter meditation stumptown chartreuse.
                            <br>
                            <br>Whatever synth locavore, <span class="highlight-dark">roof party post-ironic vegan freegan sustainable</span>. Biodiesel pabst green juice cronut, gochujang try-hard vinyl raw denim fap chillwave cray messenger bag gentrify <span class="highlight"><b>flexitarian</b></span> umami. </p>
                        <p class="space80"> <img src="images/icons/2.png" alt=""> <span class="lead">Our History</span> Pork belly iPhone twee dreamcatcher kitsch. Listicle cliche vegan lomo
                            <br>typewriter, <span class="highlight-dark">hoodie beard mlkshk</span>. Mumblecore squid trust fund semiotics,
                            <br>brunch umami typewriter meditation stumptown chartreuse. </p>
                        <p class="last"> <img src="images/icons/3.png" alt=""> <span class="lead">Full list of services</span> Hoodie beard mlkshk. Mumblecore squid trust fund semiotics,
                            <br>brunch umami <span class="highlight"><a href="#">typewriter</a></span> meditation stumptown chartreuse. </p>
                        <div class="dp-tags"> <a href="#">Service</a> <a href="#">Food</a> <a href="#">Catering</a> <a href="#">Weddings</a> <a href="#">Birthdays</a> <a href="#">Birthdays</a> <a href="#">French Food</a> <a href="#">...</a> </div>
                    </div>
                    <div class="dp-reviews">
                        <div class="dpr-header">
                            <div class="review-count"> 4.9 <span class="star-ratings">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            </span>
                                <p>211 Reviews</p>
                            </div>
                            <a href="#" class="dpr-btn"> <img src="images/icons/4.png" alt="">Write a review</a>
                        </div>
                        <ul class="dpr-comments">
                            <li> <img src="images/comment.png" alt="">
                                <p> <span class="lead">Best place &amp; service in town
                                <span class="star-ratings">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                </span> </span> Pork belly iPhone twee dreamcatcher kitsch. Listicle cliche vegan lomo typewriter,
                                    <br><span class="highlight-dark">hoodie beard mlkshk</span>. Mumblecore squid trust. </p>
                                <div class="dpr-like">126 Find This Useful</div>
                            </li>
                            <li> <img src="images/comment.png" alt="">
                                <p> <span class="lead">Such a lovely place
                                <span class="star-ratings">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                </span> </span> Pork belly iPhone twee dreamcatcher kitsch. Listicle cliche vegan lomo
                                    <br>typewriter, <span class="highlight-dark">hoodie beard mlkshk</span>. Mumblecore squid trust. </p>
                                <div class="dpr-like">47 Find This Useful</div>
                            </li>
                        </ul>
                        <input class="rating-tooltip-manual" data-filled="fa fa-star fa-3x" data-empty="fa fa-star-o fa-3x" data-fractions="3" type="hidden">
                        <ul class="dpr-pager">
                            <li><a href="#">1</a> </li>
                            <li><a href="#">2</a> </li>
                            <li><a href="#">3</a> </li>
                            <li><a href="#">...</a> </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="book-table">
                        <div class="bt-head text-center">
                            <h5>Book your table</h5>
                            <p>Free service - Confirmed immediately</p>
                        </div>
                        <div id="tabs-container">
                            <ul class="bt-tabs">
                                <li class="current">
                                    <a href="#tab-1"></a>
                                </li>
                                <li>
                                    <a href="#tab-2"></a>
                                </li>
                                <li>
                                    <a href="#tab-3"></a>
                                </li>
                            </ul>
                            <div class="tab">
                                <div id="tab-1" class="tab-content">
                                    <table class="calendar">
                                        <caption> March 2016 </caption>
                                        <thead>
                                            <tr>
                                                <th>Mon</th>
                                                <th>Tue</th>
                                                <th>Wed</th>
                                                <th>Thu</th>
                                                <th>Fri</th>
                                                <th>Sat</th>
                                                <th>Sun</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="off">
                                                    <a href="index.html"></a>
                                                </td>
                                                <td class="off">
                                                    <a href="index.html"></a>
                                                </td>
                                                <td class="off">
                                                    <a href="index.html"></a>
                                                </td>
                                                <td><a href="index.html">1</a> </td>
                                                <td><a href="index.html">2</a> </td>
                                                <td><a href="index.html">3</a> </td>
                                                <td><a href="index.html">4</a> </td>
                                            </tr>
                                            <tr>
                                                <td><a href="index.html">5</a> </td>
                                                <td><a href="index.html">6</a> </td>
                                                <td><a href="index.html">7</a> </td>
                                                <td class="active"><a href="index.html">8</a> </td>
                                                <td><a href="index.html">9</a> </td>
                                                <td><a href="index.html">10</a> </td>
                                                <td><a href="index.html">11</a> </td>
                                            </tr>
                                            <tr>
                                                <td><a href="index.html">12</a> </td>
                                                <td><a href="index.html">13</a> </td>
                                                <td><a href="index.html">14</a> </td>
                                                <td><a href="index.html">15</a> </td>
                                                <td><a href="index.html">16</a> </td>
                                                <td><a href="index.html">17</a> </td>
                                                <td><a href="index.html">18</a> </td>
                                            </tr>
                                            <tr>
                                                <td><a href="index.html">19</a> </td>
                                                <td><a href="index.html">20</a> </td>
                                                <td><a href="index.html">21</a> </td>
                                                <td><a href="index.html">22</a> </td>
                                                <td><a href="index.html">23</a> </td>
                                                <td><a href="index.html">24</a> </td>
                                                <td><a href="index.html">25</a> </td>
                                            </tr>
                                            <tr>
                                                <td><a href="index.html">26</a> </td>
                                                <td><a href="index.html">27</a> </td>
                                                <td><a href="index.html">28</a> </td>
                                                <td><a href="index.html">29</a> </td>
                                                <td><a href="index.html">30</a> </td>
                                                <td><a href="index.html">31</a> </td>
                                                <td class="off">
                                                    <a href="index.html"></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div id="tab-2" class="tab-content">
                                    <h3>Choose your Time</h3>
                                    <div class="bt-tabs-clock"> <a href="#">1:00 AM</a> <a href="#">12:00 PM</a> <a href="#">3:00 AM</a> <a href="#">2:00 PM</a> <a href="#">5:00 AM</a> <a href="#">4:00 PM</a> <a href="#">7:00 AM</a> <a href="#">6:00 PM</a> <a href="#">9:00 AM</a> <a href="#">8:00 PM</a> <a href="#">11:00 AM</a> <a href="#">10:00 PM</a> </div>
                                </div>
                                <div id="tab-3" class="tab-content">
                                    <h3>Number of Persons</h3>
                                    <div class="bt-tabs-clock"> <a href="#">1 Adult</a> <a href="#">1 Child</a> <a href="#">2 Adult</a> <a href="#">2 Child</a> <a href="#">3 Adult</a> <a href="#">3 Child</a> <a href="#">4 Adult</a> <a href="#">4 Child</a> <a href="#">5 Adult</a>
                                        <br>
                                        <br>
                                        <button type="submit">Book Table</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="call-rep">
                        <p class="lead">Would like to discuss by the phone?</p>
                        <p>Call our represntative</p> <a href="#">0080 1200 222 333</a> </div>
                    <div class="dp-contact">
                        <h5>Contact Us</h5>
                        <p>we usually respond within 3 hours</p>
                        <form>
                            <input placeholder="Your Name" type="text">
                            <input placeholder="Your E-mail address" type="email">
                            <input placeholder="Subject" type="text">
                            <textarea placeholder="Your message"></textarea>
                            <button type="submit">Submit inquiry</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>