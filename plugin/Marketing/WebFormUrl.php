<?php
/**COPYRIGHTS**/ 
// Copyright 2008 - 2010 all rights reserved, SQLFusion LLC, info@sqlfusion.com
/**COPYRIGHTS**/

/*
 *      Web form creator
 *      This will let the user selec the fields that will display 
 *      in the web form. He will also add initial default tags.
 *      
 *      Copyright 2009 SQLFusion LLC, Philippe Lewicki <philippe@sqlfusion.com>
 *      
 */

				$msg = new Message(); 
				$msg->getMessage('web form url instruction');
				$msg->displayMessage();

		            $_SESSION['do_userform']->setApplyRegistry(false);
		            echo _('The url for the web form '). '<b>'.$_SESSION['do_userform']->title.'</b>'._(' is ').
		                $GLOBALS['cfg_ofuz_site_http_base'].'form/'.
						$_SESSION['do_userform']->getPrimaryKeyValue(); 
						?>
		</div>
		<?php echo _('Embed code to insert in your blog or web site'); ?>
		<div>
		<textarea rows="2" cols="100"><script type="text/javascript" src="<?php echo $GLOBALS['cfg_ofuz_site_http_base'].'js_form.php?fid='.$_SESSION['do_userform']->getPrimaryKeyValue(); ?>"></script>
        </textarea>
		</div>
		
		<br />OR<br /><br />
		<?php 
		
		$do_webformuser = new WebFormUser();
		$do_webformuser->getId($_SESSION['do_userform']->getPrimaryKeyValue());
		$do_webformuser->sessionPersistent("do_webformuser", "index.php", OFUZ_TTL);
		
		$do_webformuser->newForm('do_webformuser->eventAddContact');
		if ($do_webformuser->email_alert == 'y') {
			$do_webformuser->form->addEventAction("do_webformuser->eventSendEmailAlert", 300);
		}
		$js = '';
		if (strlen($do_webformuser->title)>0) {
			$js .= $do_webformuser->title . '<br />' ;
		}
		if (strlen ($do_webformuser->description ) > 0 ) {
			$js .= $do_webformuser->description  . '<br />';
		}
		$js .='<form method="post" action="http://'.$_SERVER['SERVER_NAME'].'/eventcontroler.php">' .
          $do_webformuser->form->getFormEvent() .
          $do_webformuser->displayWebFormFields() .
          '<div align="right">'.$do_webformuser->form->getFormFooter('Submit').'</div>';
		//$js = addslashes(str_replace("\n", '', $js));
		$js = "<table><tr><td>".$js."</td></tr></table>";
		
		?>
		<div>
		<textarea rows="20" cols="100"><?php echo $js;?></textarea>
		
		</div>
		<div>
	   <?php 
              if($_SESSION['setting_mode'] == 'Yes'){
                    echo '<a href="'.$cfg_plugin_mkt_path.'WebForm">'._('Back').'</a>';
                    $_SESSION['setting_mode'] = '';
              }
           ?>
    </div>
    <div class="spacerblock_40"></div>