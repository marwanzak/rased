<!-- Main wrapper -->
<div class="wrapper">

	<!-- Left sidebar -->
    <div class="sidebar" id="left-sidebar">
        <ul class="navigation standard"><!-- standard nav -->
            <li><a href="<?=base_url() ?>admin/" title="" class=<?= ($table=="")? "active":"standard"?>><img src="<?=base_url() ?>images/icons/mainnav/dashboard.png" alt="" /><?= lang("dashboard") ?></a></li>
 
            <li class=<?= ($table=="ra_levels")? "active":"standard"?>><a href="<?=base_url() ?>admin/levels" title=""><?= lang("ra_levels") ?></a></li>
            <li class=<?= ($table=="ra_grades")? "active":"standard"?>><a href="<?=base_url() ?>admin/grades" title=""><?= lang("ra_grades") ?></a></li>
            <li class=<?= ($table=="ra_classes")? "active":"standard"?>><a href="<?=base_url() ?>admin/classes" title=""><?= lang("ra_classes") ?></a></li>
            <li class=<?= ($table=="ra_students")? "active":"standard"?>><a href="<?=base_url() ?>admin/students" title=""><?= lang("ra_students") ?></a></li>
            <li class=<?= ($table=="ra_subjects")? "active":"standard"?>><a href="<?=base_url() ?>admin/subjects" title=""><?= lang("ra_subjects") ?></a></li>
            <li class=<?= ($table=="ra_users")? "active":"standard"?>><a href="<?=base_url() ?>admin/users" title=""><?= lang("ra_users") ?></a></li>
            <li class=<?= ($table=="ra_roles")? "active":"standard"?>><a href="<?=base_url() ?>admin/roles" title=""><?= lang("ra_roles") ?></a></li>
            <li class=<?= ($table=="ra_notesprob")? "active":"standard"?>><a href="<?=base_url() ?>admin/notesprob" title=""><?= lang("ra_notesprob") ?></a></li>
            <li class=<?= ($table=="ra_notestypes")? "active":"standard"?>><a href="<?=base_url() ?>admin/notestypes" title=""><?= lang("ra_notestypes") ?></a></li>
            <li class=<?= ($table=="ra_notes")? "active":"standard"?>><a href="<?=base_url() ?>admin/notes" title=""><?= lang("ra_notes") ?></a></li>
            <li class=<?= ($table=="ra_actions")? "active":"standard"?>><a href="<?=base_url() ?>admin/actions" title=""><?= lang("ra_actions") ?></a></li>
            <li class=<?= ($table=="ra_defaultnumemail")? "active":"standard"?>><a href="<?=base_url() ?>admin/defaultnumemail" title=""><?= lang("ra_defaultnumemail") ?></a></li>
            <li class=<?= ($table=="ra_readymessages")? "active":"standard"?>><a href="<?=base_url() ?>admin/readymessages" title=""><?= lang("ra_readymessages") ?></a></li>
            <li class="active"><a href="#" title="" class="expand" id="current"><img src="<?=base_url() ?>images/icons/mainnav/page-layouts.png" alt="" />Page layouts<strong>3</strong></a>
                <ul>
                    <li class="current"><a href="#" title="">2 columns</a></li>
                    <li><a href="#" title="">3 columns</a></li>
                    <li><a href="#" title="">Tabbed page</a></li>
                </ul>
            </li>
        </ul><!-- /standard nav -->
    </div>
    <!-- /left sidebar -->