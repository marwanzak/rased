<!-- Main wrapper -->
<div class="wrapper">
	<?php $permissions = $this->homemodel->getUserPermissions($this->session->userdata("id"));?>
	<!-- Left sidebar -->
	<div class="sidebar" id="left-sidebar">
		<ul class="navigation standard">
			<!-- standard nav -->
			<li><a href="<?=base_url() ?>admin/" title=""
				class=<?= ($table=="")? "active":"standard"?>><img
					src="<?=base_url() ?>images/icons/mainnav/dashboard.png" alt="" />
					<?= lang("dashboard") ?> </a></li>
			<?php if($permissions->level_see==1){?>
			<li class=<?= ($table=="ra_levels")? "active":"standard"?>><a
				href="<?=base_url() ?>admin/show/levels" title=""><?= lang("ra_levels") ?>
			</a></li>
			<?php }?>
			<?php if($permissions->grade_see==1){?>
			<li class=<?= ($table=="ra_grades")? "active":"standard"?>><a
				href="<?=base_url() ?>admin/show/grades" title=""><?= lang("ra_grades") ?>
			</a></li>
			<?php }?>
			<?php if($permissions->class_see==1){?>
			<li class=<?= ($table=="ra_classes")? "active":"standard"?>><a
				href="<?=base_url() ?>admin/show/classes" title=""><?= lang("ra_classes") ?>
			</a></li>
			<?php }?>
			<?php if($permissions->student_see==1){?>
			<li class=<?= ($table=="ra_students")? "active":"standard"?>><a
				href="<?=base_url() ?>admin/show/students" title=""><?= lang("ra_students") ?>
			</a></li>
			<?php }?>
			<?php if($permissions->subject_see==1){?>
			<li class=<?= ($table=="ra_subjects")? "active":"standard"?>><a
				href="<?=base_url() ?>admin/show/subjects" title=""><?= lang("ra_subjects") ?>
			</a></li>
			<?php }?>
			<?php if($permissions->user_see==1){?>
			<li class=<?= ($table=="ra_users")? "active":"standard"?>><a
				href="<?=base_url() ?>admin/show/users" title=""><?= lang("ra_users") ?>
			</a></li>
			<?php }?>
			<?php if($permissions->role_see==1){?>
			<li class=<?= ($table=="ra_roles")? "active":"standard"?>><a
				href="<?=base_url() ?>admin/show/roles" title=""><?= lang("ra_roles") ?>
			</a></li>
			<?php }?>
			<?php if($permissions->prob_see==1){?>
			<li class=<?= ($table=="ra_notesprob")? "active":"standard"?>><a
				href="<?=base_url() ?>admin/show/notesprob" title=""><?= lang("ra_notesprob") ?>
			</a></li>
			<?php }?>
			<?php if($permissions->type_see==1){?>
			<li class=<?= ($table=="ra_notestypes")? "active":"standard"?>><a
				href="<?=base_url() ?>admin/show/notestypes" title=""><?= lang("ra_notestypes") ?>
			</a></li>
			<?php }?>
			<?php if($permissions->note_see==1){?>
			<li class=<?= ($table=="ra_notes")? "active":"standard"?>><a
				href="<?=base_url() ?>admin/show/notes" title=""><?= lang("ra_notes") ?>
			</a></li>
			<li class=<?= ($table=="search_note")? "active":"standard"?>><a
				href="<?=base_url() ?>admin/searchNotes" title=""><?= lang("search_note") ?>
			</a></li>
			<?php }?>
			<?php if($permissions->action_see==1){?>
			<li class=<?= ($table=="ra_actions")? "active":"standard"?>><a
				href="<?=base_url() ?>admin/show/actions" title=""><?= lang("ra_actions") ?>
			</a></li>
			<?php }?>
			<?php if($permissions->def_see==1){?>
			<li class=<?= ($table=="ra_defaultnumemail")? "active":"standard"?>><a
				href="<?=base_url() ?>admin/show/defaultnumemail" title=""><?= lang("ra_defaultnumemail") ?>
			</a></li>
			<?php }?>
			<?php if($permissions->ready_see==1){?>
			<li class=<?= ($table=="ra_readymessages")? "active":"standard"?>><a
				href="<?=base_url() ?>admin/show/readymessages" title=""><?= lang("ra_readymessages") ?>
			</a></li>
			<?php }?>
			<?php if($permissions->sitesettings==1){?>
			<li class=<?= ($table=="sitesettings")? "active":"standard"?>><a
				href="<?=base_url() ?>admin/insertSiteSettings" title=""><?= lang("site_settings") ?>
			</a></li>
			<?php }?>

			<li class="active"><a href="#" title="" class="expand" id="current"><img
					src="<?=base_url() ?>images/icons/mainnav/page-layouts.png" alt="" />Page
					layouts<strong>3</strong> </a>
				<ul>
					<li class="current"><a href="#" title="">2 columns</a></li>
					<li><a href="#" title="">3 columns</a></li>
					<li><a href="#" title="">Tabbed page</a></li>
				</ul>
			</li>
		</ul>
		<!-- /standard nav -->
	</div>
	<!-- /left sidebar -->