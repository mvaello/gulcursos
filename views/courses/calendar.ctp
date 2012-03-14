<div class="courses calendar">
<h1 id="courses"><?php echo __('Calendar'); ?></h1>
<p>
	<?php echo __("Here you have the courses calendar. If you put the pointer on a ttitle, you can see a tooltip with information, and if you click on, you will see the course page."); ?>
</p>

<p><?php echo $html->link("Calendario en formato iCalendar", "/courses/ics/{$course['Course']['id']}"); ?> </p>

<?php if(!$assistants): ?>
<p> <?php echo $html->link(__("Here you can find the assistants calendar.",true), "/courses/calendar/{$course['Course']['id']}/assist"); ?> </p>
<?php endif; ?>

<?php echo $widewisse->createCalendar($course, $html, $assistants); ?>

	<p><?php echo $html->link(__("Return to course",true), "/courses/view/".$course['Course']['id']); ?><p>
</div>
