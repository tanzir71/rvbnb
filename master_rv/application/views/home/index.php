
<div class="intro" data-stellar-background-ratio="0.55">
    <div class="container">
        <div class="text-center">
            <h2 style="font-family: Pacifico;">rvbnb</h2>
            <p class="lead">Where you like to Park?</p>
        </div>
        <div class="intro-search">
            <input type="text" id="location_input" autofocus="1" placeholder="Enter location" autocomplete="off" >
            <input type="text" id="from" class="picker" placeholder="Check In">
            <input type="text" id="to" class="picker" placeholder="Check Out">

            <button type="submit" id="final_search">Search <img src="<?php echo base_url() ?>assets/images/icons/search.png" alt="" /> </button>
        </div>
    </div>
</div>
<!-- end: Intro search section -->

<div id="demo"></div>

<div class="search-content blog-content">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="side-widget space30">
                    <h5>Maps</h5>
                    <div class="side-cat2" style="padding: 10px">
                        <div id="maps"  style="min-height: 600px"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-7 dir-search">
                <div class="search-filter">
                    <ul>
                        <li><a href="#">Featured</a> </li>
                        <li><a href="#">Popular</a> </li>
                        <li><a href="#">Best rated</a> </li>
                        <li><a href="#">Most recent</a> </li>
                        <li>
                            <a href="directory_search.html"> <img src="images/icons/grid.png" alt=""> </a>
                        </li>
                        <li>
                            <a href="directory_search_list.html"> <img src="images/icons/list.png" alt=""> </a>
                        </li>
                    </ul>
                </div>
                <div class="row" id="filterig_result">

                <?php 
                $this->db->order_by('id','desc');
                $this->db->limit(6);
                $query = $this->db->get('host');
                if ($query->num_rows()>0) {
                    foreach ($query->result_array() as $value) {
                ?>
                    <div class="col-md-6 col-sm-6">
                        <div class="listing mob-space30 space30">
                            <div class="listing-img bg-image" data-image-src="<?php echo base_url() ?>assets/images/host/<?php echo $value['id'] ?>.jpg" style="background: rgba(0, 0, 0, 0) url(&quot;http://placehold.it/360x245&quot;) no-repeat scroll center center / cover ;">
                                <div class="li-overlay">
                                    <div class="li-overlay-inner">
                                        <a href="#" class="mail"></a>
                                        <a href="#" class="menu"></a>
                                        <a href="#" class="link"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="listing-info">
                                <h4 class="li-name"><a href="<?php echo base_url() ?>home/host_rv/<?php echo $value['id'].'/'.preg_replace('/\s+/', '-', $value['title']) ?>" target="_blank"><?php echo $value['title'] ?></a></h4>
                                <ul class="list-icon">
                                    <li> <i class="pe-7s-map-marker"></i> <?php echo $value['location'] ?></li>
                                    <li> <i class="pe-7s-call"></i> <?php echo $value['phone_number'] ?></li>
                                    <li> <i class="pe-7s-mail"></i> <a href="mailto:<?php echo $value['email'] ?>"><?php echo $value['email'] ?></a> </li>
                                </ul>
                                <div class="list-ratings"><i class="fa fa-usd" aria-hidden="true"></i>48</div>
                            </div>
                        </div>
                    </div>

                <?php }} ?>


                </div>


                <ul class="dpr-pager">
                    <li><a href="#">1</a> </li>
                    <li><a href="#">2</a> </li>
                    <li><a href="#">3</a> </li>
                    <li><a href="#">...</a> </li>
                </ul>
            </div>
        </div>
    </div>
</div>