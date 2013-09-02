<!-- Top nav -->
<div id="top">
    <div class="top-wrapper">
        <ul class="topnav">
            <li class="topuser">
                <a title="" data-toggle="dropdown"><img src="<?=base_url() ?>images/user.png" alt="" /><span><?= $this->session->userdata("name")?></span><i class="caret"></i></a>
            </li>
            <li><a href="<?=base_url()?>admin/showInbox" title="<?=lang("inbox")?>"><b class="mail"></b></a></li>
            <?php if($table!="search_note"){?>
            <?php if($table!="showNotes"&& $table!="settings" && $table!="showLessons" && $table!="showInbox"){?>
            <li class="search">
                <a title=""><b class="search"></b></a>
                <form class="top-search" action="<?= base_url() ?>admin/show/<?= str_replace("ra_","",$table)?>" method="POST">
                    <input type="text" placeholder="<?= lang("search")?>" name="word" />
                    <input type="submit" value="" />
                </form>
            </li>
            <?php }?>
            <?php }?>
            <li class="sidebar-button"><a href="#" title=""><b class="responsive-nav"></b></a></li>
            <li><a href="<?= base_url() ?>admin/do_logout" title=""><b class="logout"></b></a></li>
        </ul>
    </div>
</div>
<!-- /top nav -->