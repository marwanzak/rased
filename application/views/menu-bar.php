<!-- Main wrapper -->
<div class="wrapper">
	<?php $permissions = $this->homemodel->getUserPermissions($this->session->userdata("id"));?>
	<!-- Left sidebar -->
	<div class="sidebar" id="left-sidebar">
		<ul class="navigation standard">
			<!-- standard nav -->
			<li class=<?= ($table=="dashboard")? "active":"standard"?>><a href="<?=base_url() ?>admin/dashboard" title=""
				><img
					src="<?=base_url() ?>images/icons/mainnav/dashboard.png" alt="" />
					<?= lang("dashboard") ?> </a></li>
			<li
				class=<?=($table=="ra_users"||$table=="ra_roles"||$table=="ra_actions"||$table=="ra_defaultnumemail")?"active":""?>><a href="#" title="" class="expand"
				id=<?=($table=="ra_users"||$table=="ra_roles"||$table=="ra_actions"||$table=="ra_defaultnumemail")?"current":""?>
				><img src="" alt="" /> <?=lang("users")?>
			</a>
				<ul>
					<?php if($permissions->user_see==1){?>
					<li class=<?= ($table=="ra_users")? "current":""?>><a
						href="<?=base_url() ?>admin/show/users" title=""><?= lang("ra_users") ?>
					</a></li>
					<?php }?>
					<?php if($permissions->role_see==1){?>
					<li class=<?= ($table=="ra_roles")? "current":""?>><a
						href="<?=base_url() ?>admin/show/roles" title=""><?= lang("ra_roles") ?>
					</a></li>
					<?php }?>
					<?php if($permissions->action_see==1){?>
					<li class=<?= ($table=="ra_actions")? "current":""?>><a
						href="<?=base_url() ?>admin/show/actions" title=""><?= lang("ra_actions") ?>
					</a></li>
					<?php }?>
					<?php if($permissions->def_see==1){?>
					<li class=<?= ($table=="ra_defaultnumemail")? "current":""?>><a
						href="<?=base_url() ?>admin/show/defaultnumemail" title=""><?= lang("ra_defaultnumemail") ?>
					</a></li>
					<?php }?>
				</ul>
			</li>
			<li
				class=<?=($table=="ra_levels"||$table=="ra_lessons"||$table=="ra_grades"||$table=="ra_classes"||$table=="ra_students"||$table=="ra_subjects")? "active":""?>><a
				href="#" title="" class="expand"
				id=<?=($table=="ra_levels"||$table=="ra_lessons"||$table=="ra_grades"||$table=="ra_classes"||$table=="ra_students"||$table=="ra_subjects")? "current":""?>><img
					src="" alt="" /> <?=lang("inner_system")?> </a>
				<ul>
					<?php if($permissions->level_see==1){?>
					<li class=<?= ($table=="ra_levels")? "current":""?>><a
						href="<?=base_url() ?>admin/show/levels" title=""><?= lang("ra_levels") ?>
					</a>
					</li>
					<?php }?>
					<?php if($permissions->grade_see==1){?>
					<li class=<?= ($table=="ra_grades")? "current":""?>><a
						href="<?=base_url() ?>admin/show/grades" title=""><?= lang("ra_grades") ?>
					</a></li>
					<?php }?>
					<?php if($permissions->class_see==1){?>
					<li class=<?= ($table=="ra_classes")? "current":""?>><a
						href="<?=base_url() ?>admin/show/classes" title=""><?= lang("ra_classes") ?>
					</a></li>
					<?php }?>
					<?php if($permissions->student_see==1){?>
					<li class=<?= ($table=="ra_students")? "current":""?>><a
						href="<?=base_url() ?>admin/show/students" title=""><?= lang("ra_students") ?>
					</a></li>
					<?php }?>
					<?php if($permissions->subject_see==1){?>
					<li class=<?= ($table=="ra_subjects")? "current":""?>><a
						href="<?=base_url() ?>admin/show/subjects" title=""><?= lang("ra_subjects") ?>
					</a></li>
					<?php }?>
					<?php if($permissions->lessons_see==1){?>
					<li class=<?= ($table=="ra_lessons")? "active":"standard"?>><a
						href="<?=base_url() ?>admin/showLessons" title=""><?= lang("ra_lessons") ?>
					</a></li>
					<?php }?>
				</ul>
			</li>
			<li
				class=<?=($table=="ra_notesprob"||$table=="ra_notestypes"||$table=="ra_notes"||$table=="search_note")? "active":""?>><a href="#" title="" class="expand"
				id=<?=($table=="ra_notesprob"||$table=="ra_notestypes"||$table=="ra_notes"||$table=="search_note")? "current":""?>
				><img src="" alt="" /> <?=lang("notes")?>
			</a>
				<ul>
					<?php if($permissions->prob_see==1){?>
					<li class=<?= ($table=="ra_notesprob")? "current":""?>><a
						href="<?=base_url() ?>admin/show/notesprob" title=""><?= lang("ra_notesprob") ?>
					</a></li>
					<?php }?>
					<?php if($permissions->type_see==1){?>
					<li class=<?= ($table=="ra_notestypes")? "current":""?>><a
						href="<?=base_url() ?>admin/show/notestypes" title=""><?= lang("ra_notestypes") ?>
					</a></li>
					<?php }?>
					<?php if($permissions->note_see==1){?>
					<li class=<?= ($table=="ra_notes")? "current":""?>><a
						href="<?=base_url() ?>admin/show/notes" title=""><?= lang("ra_notes") ?>
					</a></li>
					<li class=<?= ($table=="search_note")? "current":""?>><a
						href="<?=base_url() ?>admin/searchNotes" title=""><?= lang("search_note") ?>
					</a></li>
					<?php }?>
				</ul>
			</li>

			<li
				class=<?=($table=="ra_forms"||$table=="ra_inbox")? "active":""?>><a href="#" title="" class="expand"
				id=<?=($table=="ra_forms"||$table=="ra_inbox")? "current":""?>
				><img src="" alt="" /> <?=lang("trans")?>
			</a>
				<ul>
			<?php if($permissions->forms_see==1){?>
			<li class=<?= ($table=="ra_forms")? "current":""?>><a
				href="<?=base_url() ?>admin/showForms" title=""><?= lang("forms") ?>
			</a></li>
			<?php }?>
			<li class=<?= ($table=="ra_inbox")? "current":""?>><a
				href="<?=base_url() ?>admin/showInbox" title=""><?= lang("inbox") ?>
			</a></li>
				</ul>
			</li>
	
				<li
				class=<?=($table=="ra_slider"||$table=="ra_readymessages"||$table=="sitesettings")? "active":""?>><a href="#" title="" class="expand"
				id=<?=($table=="ra_slider"||$table=="ra_readymessages"||$table=="sitesettings")? "current":""?>
				><img src="" alt="" /> <?=lang("site")?>
			</a>
				<ul>
			<?php if($permissions->slider_see==1){?>
			<li class=<?= ($table=="ra_slider")? "current":""?>><a
				href="<?=base_url() ?>admin/showSlider" title=""><?= lang("slider") ?>
			</a></li>
			<?php }?>

			<?php if($permissions->ready_see==1){?>
			<li class=<?= ($table=="ra_readymessages")? "current":""?>><a
				href="<?=base_url() ?>admin/show/readymessages" title=""><?= lang("ra_readymessages") ?>
			</a></li>
			<?php }?>
			<?php if($permissions->sitesettings==1){?>
			<li class=<?= ($table=="sitesettings")? "current":""?>><a
				href="<?=base_url() ?>admin/insertSiteSettings" title=""><?= lang("site_settings") ?>
			</a></li>
			<?php }?>
				</ul>
			</li>
			

		</ul>
		<?php if($table=="ra_inbox"){?>
		<div style="overflow: hidden; height: 225px; width: 225px;">
			<!-- Contact list -->
			<ul class="user-list block"
				style="height: 200px; width: 230px; overflow: auto;">
				<?php foreach($users as $user){?>
				<li><a href="<?=base_url()?>admin/showInbox?username=<?=$user->id?>"
					title=""> <span class="contact-name"> <strong><?=$user->username?>
						</strong> <i><?=$user->name?> </i>
					</span>
				</a>
				</li>
				<?php }?>

			</ul>
		</div>
		<!-- /contact list -->
		<?php }?>

		<!-- /standard nav -->
	</div>
	<!-- /left sidebar -->
