<!-- Top nav -->
<div id="top">
    <div class="top-wrapper">
        <ul class="topnav">
            <li class="topuser">
                <a title="" data-toggle="dropdown"><img src="<?=base_url() ?>images/user.png" alt="" /><span>Eugene Kopyov</span><i class="caret"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="#" title=""><span class="user-profile"></span>My profile</a></li>
                    <li><a href="#" title=""><span class="user-stats"></span>Statistics <strong>2</strong></a></li>
                    <li><a href="#" title=""><span class="user-settings"></span>Switch user</a></li>
                    <li><a href="<?= base_url() ?>admin/do_logout" title=""><span class="user-logout"></span>Logout</a></li>
                </ul>
            </li>
            <li><a href="#" title=""><b class="settings"></b></a></li>
            <li><a href="#" title=""><b class="mail"></b></a></li>
            <li class="search">
                <a title=""><b class="search"></b></a>
                <form class="top-search" action="#">
                    <input type="text" placeholder="Search..." />
                    <input type="submit" value="" />
                </form>
            </li>
            <li class="sidebar-button"><a href="#" title=""><b class="responsive-nav"></b></a></li>
            <li><a href="<?= base_url() ?>admin/do_logout" title=""><b class="logout"></b></a></li>
        </ul>
    </div>
</div>
<!-- /top nav -->