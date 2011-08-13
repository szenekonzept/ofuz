<?php
/**COPYRIGHTS**/ 
// Copyright 2008 - 2010 all rights reserved, SQLFusion LLC, info@sqlfusion.com
/**COPYRIGHTS**/

  $pageTitle = 'Ofuz :: Language Translator';
  $Author = 'SQLFusion LLC';
  $Keywords = 'Keywords for search engine';
  $Description = 'Description for search engine';
  $background_color = 'white';
  include_once('config.php');
  include_once('includes/ofuz_check_access.script.inc.php');
  include_once('includes/header.inc.php');
  
?>

 
<?php $do_feedback = new Feedback(); $do_feedback->createFeedbackBox(); ?>
<table class="layout_columns"><tr><td class="layout_lmargin"></td><td>
<div class="layout_content">
<?php $thistab = 'Dashboard';  
 $_SESSION['dashboard_link'] = "/daily_notes.php";
include_once('includes/ofuz_navtabs.php'); ?>
<?php $do_breadcrumb = new Breadcrumb(); $do_breadcrumb->getBreadcrumbs(); ?>
    <div class="grayline1"></div>
    <div class="spacerblock_20"></div>
    <table class="layout_columns">
		<tr><td class="layout_lcolumn">
      <?php
      $GLOBALS['page_name'] = 'google_translator_et';
      include_once('plugin_block.php');
      ?>
    </td>
	<td class="layout_rcolumn">
	<?php
	      /*$msg = new Message(); 
	      $msg->getMessageFromContext("daily notes");
	      echo $msg->displayMessage();*/
	?>
	<table class="mainheader pad20" width="100%">
  <tr>
      <td><span class="headline14">
      <?php
          echo _('Language Translator for Emailtemplate');
      ?></span>
      </td>
  </tr>
	</table>
<?php if($_SESSION["dest_lang"] != "") { 
  $do_gt = new GoogleTranslatorEmailtemplate();
  $do_gt->getTemplatesToBeTranslated();
?>
	<table class="pad20" width="35%">
	  <tr>
	    <td width="25%" align="left">
	      <?php
	      if($do_gt->isPrev($do_gt->idemailtemplate)) {
		$e_prev = new Event("GoogleTranslatorEmailtemplate->eventSetPrevTemplate");
		$e_prev->addParam("current_idtemplate", $do_gt->idemailtemplate);
		$e_prev->addParam("goto",$_SERVER['PHP_SELF']);
		echo $e_prev->getLink("Previous");
	      }
	      ?>
	    </td>
	    <td width="25%" align="right">
	      <?php
	      if($do_gt->isNext($do_gt->idemailtemplate)) {
		echo "&nbsp;&nbsp&nbsp&nbsp";

		$e_next = new Event("GoogleTranslatorEmailtemplate->eventSetNextTemplate");
		$e_next->addParam("current_idtemplate", $do_gt->idemailtemplate);
		$e_next->addParam("goto",$_SERVER['PHP_SELF']);
		echo $e_next->getLink("Next");
	      }
	      ?>
	    </td>
	  </tr>
	  <tr>
	    <td colspan="2">
	      <?php
	      while($do_gt->next()) {
		$e_gt = new Event("GoogleTranslatorEmailtemplate->eventTranslateLanguage");
		$e_gt->addParam("goto", $_SERVER['PHP_SELF']);
// 		$e_gt->addParam("src_lng",$src_lng);
// 		$e_gt->addParam("dest_lng",$dest_lng);
		echo $e_gt->getFormHeader();
		echo $e_gt->getFormEvent();
	      ?>

		<div class="spacerblock_20"></div>
		<b>Subject</b><br />
		<input type="text" name="et_sub_src" id="et_sub_src" value="<?php echo $do_gt->subject; ?>" />
		<div class="spacerblock_20"></div>
		<b>bodytext</b><br />
		<textarea name="et_body_text_src" id="et_body_text_src" cols="50" rows="5" wrap=hard><?php echo $do_gt->bodytext; ?></textarea> <br />
		<div class="spacerblock_20"></div>
		<b>bodyhtml</b><br />
		<textarea name="et_body_html_src" id="et_body_html_src" cols="50" rows="5" wrap=hard><?php echo $do_gt->bodyhtml; ?></textarea> <br /><br />

		<?php echo $e_gt->getFormFooter("Translate"); ?>
		<div class="spacerblock_20"></div>

		<div class="spacerblock_20"></div>
	      <?php
		$e_gt_translated = new Event("GoogleTranslatorEmailtemplate->eventAddTranslateLanguage");
		$e_gt_translated->addParam("goto", $_SERVER['PHP_SELF']);
		//$e_gt_translated->addParam("dest_lng",$dest_lng);
		$e_gt_translated->addParam("name",$do_gt->name);
		$e_gt_translated->addParam("sendername",$do_gt->sendername);
		$e_gt_translated->addParam("senderemail",$do_gt->senderemail);

		echo $e_gt_translated->getFormHeader();
		echo $e_gt_translated->getFormEvent();
	      ?>
		<b>Subject</b><br />
		<input type="text" name="et_sub_dst" id="et_sub_dst" value="<?php if(isset($_SESSION["et_sub_src"])) {echo $_SESSION["et_sub_src"];}?>" />
		<div class="spacerblock_20"></div>
		<b>bodytext</b><br />
		<textarea name="et_body_text_dst" id="et_body_text_dst" cols="50" rows="5" wrap=hard><?php if(isset($_SESSION["et_body_text_src"])) {echo $_SESSION["et_body_text_src"];}?></textarea> <br />
		<div class="spacerblock_20"></div>
		<b>bodyhtml</b><br />
		<textarea name="et_body_html_dst" id="et_body_html_dst" cols="50" rows="5" wrap=hard><?php if(isset($_SESSION["et_body_html_src"])) {echo $_SESSION["et_body_html_src"];}?></textarea> <br />
	      <?php echo $e_gt_translated->getFormFooter("Save"); ?>
	      <?php } ?>
	    </td>
	  </tr>
	</table>
<?php } else { ?>
        <div class="spacerblock_20"></div>
        <div>Please select the destination language to see the Email templates.</div>
<?php } ?>
        <div class="spacerblock_20"></div>

    <div class="dottedline"></div>
    </td>
	</tr>
	</table>
    <div class="spacerblock_20"></div>
    <div class="layout_footer"></div>
</div>
</td><td class="layout_rmargin"></td></tr></table>
<?php include_once('includes/ofuz_facebook.php'); ?>
</body>
</html>