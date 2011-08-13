<?php
// Copyright SQLFusion LLC, all rights reserved
/**COPYRIGHTS**/

    /**
     * Display just a button to link on the contact_share_settings.php page.
     *
     * @author SQLFusion's Dream Team <info@sqlfusion.com>
     * @package OfuzCore
     * @license ##License##
     * @version 0.6
     * @date 2010-09-06
     * @since 0.6
     */

class ContactShareCoworkerBlock extends BaseBlock{

      public $short_description = 'Share contact with co-worker';
      public $long_description = 'Share the contact with one or more co-workers from the contact detail page';
    
      /**
	    * processBlock() , This method must be added  
	    * Required to set the Block Title and The Block Content Followed by displayBlock()
	    * Must extend BaseBlock
        */
      function processBlock(){
	      $this->setButtonOnClickDisplayBlock(_('Share with Co-Workers'),'','','shareWithCoworker()','','dyn_button_share_this');
	      $this->hideContent();
          $this->generateOnclickJS();
      }

      function generateOnclickJS(){
          $script = "<script type='text/javascript'>
          function shareWithCoworker()
          {
               
                    $(\"#ContactEditSave__shareContact\").attr(\"action\",\"/co_workers.php\");
                    $(\"#ContactEditSave__shareContact\").submit(); 
                
          }
          //set_selected();
          </script>";
          echo $script;
          $e = new Event("ContactEditSave->shareContact");// Fictitious Event
          $e->addEventAction("mydb.gotoPage", 304);
          $e->addParam("goto", "contacts.php");
          echo $e->getFormHeader();
          echo $e->getFormEvent();
          $js .= '<input type="hidden" name="ck[]" value="'.$_SESSION['ContactEditSave']->idcontact.'">';
          $this->displayBlock();
          $js .= '</form>';
          echo $js;
      }
      

      

      
}

?>
