<?php
defined('WYSIJA') or die('Restricted access');

class WYSIJA_view_back_campaigns extends WYSIJA_view_back{

    var $icon="icon-edit-news";
    var $column_action_list="name";
    var $queuedemails=false;
    function WYSIJA_view_back_campaigns(){
        $this->title=__("All Newsletters");
        $this->WYSIJA_view_back();
        $this->jsTrans['selecmiss']=__('Please select some users first!',WYSIJA);
        $this->search=array('title'=>__('Search newsletters',WYSIJA));
        $this->column_actions=array('editlist'=>__('Edit',WYSIJA),'duplicatelist'=>__('Duplicate',WYSIJA),'deletelist'=>__('Delete',WYSIJA));
    }

    function main($data){
        $this->menuTop($this->action);

        echo '<form method="post" action="" id="posts-filter">';
        $this->filtersLink($data);
        $this->filterDDP($data);
        $this->listing($data);
        echo '</form>';
    }

    function menuTop($actionmenu=false,$data=false){
        $duplicateSuffix='';

        if(isset($data['email']['type']) && (int)$data['email']['type']==1){
              $duplicateSuffix='Email';
        }
        $arrayTrans=array('back'=>__('Back',WYSIJA),'add'=>__('Create a new email',WYSIJA),'duplicate'.$duplicateSuffix=>__('Duplicate',WYSIJA),'view'=>__('View',WYSIJA));
        $arrayMenus=false;
        switch($actionmenu){
            case "add":
            case "edit":

                break;
            case 'main':
                 $arrayMenus=array();
                /*if($this->queuedemails){
                    $arrayTrans["send_test_editor"]=sprintf(__('Send %1$s queued emails right now.',WYSIJA),$this->queuedemails);
                    $arrayMenus[]="send_test_editor";
                }*/
                $arrayMenus[]='add';
                break;
            case 'viewstats':
                $arrayMenus=array('view','duplicate'.$duplicateSuffix);
                break;
            default:
               $arrayMenus=false;
        }
        $menu="";
        if($arrayMenus){
            foreach($arrayMenus as $action){
                $actionParams=$action;
                $extraparams=$link='';
                if($action=='duplicate'.$duplicateSuffix){
                    $actionParams=$action."&id=".$_REQUEST['id'];
                }

                if($action=='view'){
                    $emailH=&WYSIJA::get('email','helper');

                    $link=$emailH->getVIB($data['email']);
                    $extraparams='target="_blank"';
                }


                if(!$link) $link='admin.php?page=wysija_campaigns&action='.$actionParams;
                $menu.= '<a id="action-'.str_replace("_","-",$action).'" '.$extraparams.' href="'.$link.'" class="action-'.str_replace("_","-",$action).' button-secondary2">'.$arrayTrans[$action].'</a>';
                if($actionmenu=="main" && $action=="add"){
                     $menu.='<span class="description" > '.__("... or duplicate one below to copy its design.",WYSIJA)."</span>";
                }

            }


        }

        return $menu;

    }


    function filterDDP($data){

        ?>
        <ul class="subsubsub">
            <?php
            $total=count($data['counts']);
            $i=1;
            foreach($data['counts'] as $countType =>$count){
                if(!$count) {$i++;continue;}
                switch($countType){
                    case "all":
                        $tradText=__('All',WYSIJA);
                        break;
                    case "status-sent":
                        $tradText=__('Sent',WYSIJA);
                        break;
                    case "status-sending":
                        $tradText=__('Sending',WYSIJA);
                        break;
                    case "status-draft":
                        $tradText=__('Draft',WYSIJA);
                        break;
                    case "status-paused":
                        $tradText=__('Paused',WYSIJA);
                        break;
                    case "status-scheduled":
                        $tradText=__('Scheduled',WYSIJA);
                        break;
                    case "type-regular":
                        $tradText=__('Standard Newsletters',WYSIJA);
                        break;
                    case "type-autonl":
                        $tradText=__('Auto Newsletters',WYSIJA);
                        break;
                }
                $classcurrent='';
                if((isset($_REQUEST['link_filter']) && $_REQUEST['link_filter']==$countType) || ($countType=='all' && !isset($_REQUEST['link_filter']))) $classcurrent='class="current"';
                echo '<li><a '.$classcurrent.' href="admin.php?page=wysija_campaigns&link_filter='.$countType.'">'.$tradText.' <span class="count">('.$count.')</span></a>';

                if($total!=$i) echo ' | ';
                echo '</li>';
                $i++;
            }

            ?>
        </ul>

        <?php $this->searchBox(); ?>

        <div class="tablenav">
            <div class="alignleft actions">
                <select name="filter-date" class="global-filter">
                    <option selected="selected" value=""><?php echo esc_attr(__('Show all months', WYSIJA)); ?></option>
                    <?php
                     //echo $this->fieldListHTML_created_at($row["created_at"])

                    foreach($data['dates'] as $listK => $list){
                        $selected="";
                        if(isset($_REQUEST['filter-date']) && $_REQUEST['filter-date']== $listK) $selected=' selected="selected" ';
                        echo '<option '.$selected.' value="'.esc_attr($listK).'">'.$list.'</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="alignleft actions">
                <select name="filter-list" class="global-filter">
                    <option selected="selected" value=""><?php _e('View by lists', WYSIJA); ?></option>
                    <?php

                    foreach($data['lists'] as $listK => $list){
                        $selected="";
                        if(isset($_REQUEST['filter-list']) && $_REQUEST['filter-list']== $listK) $selected=' selected="selected" ';
                       if($list['users']>0) echo '<option '.$selected.' value="'.$list['list_id'].'">'.$list['name'].' ('.$list['users'].')'.'</option>';
                    }
                    ?>
                </select>
                <input type="submit" class="filtersubmit button-secondary action" name="doaction" value="<?php echo esc_attr(__('Filter', WYSIJA)); ?>">
            </div>
            <?php $this->pagination(); ?>

            <div class="clear"></div>
        </div>
        <?php
    }

    function getTransStatusEmail($status){
        switch($status){
            case "all":
                $tradText=__('All',WYSIJA);
                break;
            case "allsent":
                $tradText=__('All Sent',WYSIJA);
                break;
            case "inqueue":
                $tradText=__('In Queue',WYSIJA);
                break;
            case "notsent":
                $tradText=__('Not Sent',WYSIJA);
                break;
            case "sent":
                $tradText=__('Unopened',WYSIJA);
                break;
            case "opened":
                $tradText=__('Opened',WYSIJA);
                break;
            case "bounced":
                $tradText=__('Bounced',WYSIJA);
                break;
            case "clicked":
                $tradText=__('Clicked',WYSIJA);
                break;
            case "unsubscribe":
                $tradText=__('Unsubscribe',WYSIJA);
                break;
            default:
                $tradText="status : ". $status;
        }
        return $tradText;
    }

    function filterDDPVIEW($data){

        ?>
        <ul class="subsubsub">
            <?php

            $total=count($data['counts']);
            $i=1;
            foreach($data['counts'] as $countType =>$count){
                if(!$count || $countType=='all') {$i++;continue;}
                $tradText=$this->getTransStatusEmail($countType);
                $classcurrent='';
                if((isset($_REQUEST['link_filter']) && $_REQUEST['link_filter']==$countType) || ($countType=='allsent' && !isset($_REQUEST['link_filter']))) $classcurrent='class="current"';

                echo '<li><a '.$classcurrent.' href="admin.php?page=wysija_campaigns&action=viewstats&id='.$_REQUEST['id'].'&link_filter='.$countType.'">'.$tradText.' <span class="count">('.$count.')</span></a>';

                if($total!=$i) echo ' | ';
                echo '</li>';
                $i++;
            }

            ?>
        </ul>

        <?php $this->searchBox(); ?>

        <div class="tablenav">

            <div class="alignleft actions">
                <select name="action2" class="global-action">
                    <option selected="selected" value=""><?php _e('With this segment', WYSIJA); ?></option>
                    <?php
                    if(isset($_REQUEST['link_filter']) && $_REQUEST['link_filter']=='notsent'){
                        /*$config=&WYSIJA::get("config","model");
                        if($config->getValue("confirm_dbleoptin")){
                            ?>
                            <option value="sendconfirmation"><?php _e('Resend the activation email', WYSIJA); ?></option>
                            <?php
                        }*/
                        ?>
                        <option value="removequeue"><?php _e('Remove from the queue', WYSIJA); ?></option>
                        <?php
                    }
                    ?>
                    <option value="createnewlist"><?php _e('Create a new list', WYSIJA);
                    /*$prefix="";
                    if(isset($_REQUEST['link_filter'])) $prefix="[".$this->getTransStatusEmail($_REQUEST['link_filter'])."]";
                    $listname=sprintf(__('Segment of %1$s'),$prefix.$this->namecampaign);

                    echo " ".$listname*/ ?></option>
                    <option value="unsubscribeall"><?php _e('Unsubscribe from all lists', WYSIJA); ?></option>
                    <?php
                        foreach($data['lists'] as $listK => $list){
                            if($list['is_enabled'])   echo '<option value="actionvar_unsubscribelist-listid_'.$list['list_id'].'">'.sprintf(__('Unsubscribe from list: %1$s',WYSIJA),$list['name']).' ('.$list['users'].')'.'</option>';
                        }
                    ?>
                    <option value="export"><?php _e('Export to CSV', WYSIJA); ?></option>

                </select>
                <input type="submit" class="bulksubmitcamp button-secondary action" name="doaction" value="<?php echo esc_attr(__('Apply', WYSIJA)); ?>">
            </div>
            <?php $this->pagination(); ?>

            <div class="clear"></div>
        </div>
        <?php
    }

    /*
     * main view
     */
    function listing($data){

        ?>
        <div class="list">
            <table cellspacing="0" class="widefat fixed">
                    <thead>
                        <?php
                            $openedsorting=$statussorting=$namesorting=$datesorting=$datesorting2=" sortable desc";
                            $hiddenOrder="";
                            if(isset($_REQUEST["orderby"])){
                                switch($_REQUEST["orderby"]){
                                    case "name":
                                        $namesorting=" sorted ".$_REQUEST["ordert"];
                                        break;
                                    case "modified_at":
                                        $datesorting=" sorted ".$_REQUEST["ordert"];
                                        break;
                                    case "sent_at":
                                        $datesorting2=" sorted ".$_REQUEST["ordert"];
                                        break;
                                    case "status":
                                        $statussorting=" sorted ".$_REQUEST["ordert"];
                                        break;
                                    case "number_opened":
                                        $openedsorting=" sorted ".$_REQUEST["ordert"];
                                        break;
                                }
                                $hiddenOrder='<input type="hidden" name="orderby" id="wysija-orderby" value="'.esc_attr($_REQUEST["orderby"]).'"/>';
                                $hiddenOrder.='<input type="hidden" name="ordert" id="wysija-ordert" value="'.esc_attr($_REQUEST["ordert"]).'"/>';
                            }
                            $header='<tr class="thead">
                            <th scope="col" id="campaign-id" class="manage-column column-campaign-id check-column"><input type="checkbox" /></th>
                            <th class="manage-column column-name'.$namesorting.'" id="name" scope="col" style="width:220px;"><a href="#" class="orderlink" ><span>'.__('Name',WYSIJA).'</span><span class="sorting-indicator"></span></a></th>';
                            /*$header.='<th class="manage-column column-fname'.$fnamesorting.'" id="firstname" scope="col" style="width:80px;">'.__('First name',WYSIJA).'</th>
                            <th class="manage-column column-lname'.$lnamesorting.'" id="lastname" scope="col" style="width:80px;">'.__('Last name',WYSIJA).'</th>';*/
                            $header.='<th class="manage-column column-status'.$statussorting.'" id="status" scope="col" style="width:330px;"><a href="#" class="orderlink" ><span>'.__('Status',WYSIJA).'</span><span class="sorting-indicator"></span></a></th>';
                            $header.='<th class="manage-column column-list-names" id="list-list" scope="col">'.__('Lists',WYSIJA).'</th>';
                            $header.='<th class="manage-column column-opened'.$openedsorting.'" id="number_opened" scope="col" style="width:120px;"><a href="#" class="orderlink" ><span>'.__('Open, clicks, unsubscribed',WYSIJA).'</span><span class="sorting-indicator"></span></a></th>';


                            /*$header.='<th class="manage-column column-emails" id="emails-list" scope="col">'.__('Emails',WYSIJA).'</th>
                            <th class="manage-column column-opened" id="opened-list" scope="col">'.__('Opened',WYSIJA).'</th>
                            <th class="manage-column column-clic" id="clic-list" scope="col">'.__('Clicked',WYSIJA).'</th>';*/
                            $header.='<th class="manage-column column-date'.$datesorting.'" id="modified_at" scope="col"><a href="#" class="orderlink" ><span>'.__('Modified On',WYSIJA).'</span><span class="sorting-indicator"></span></a></th>';
                            $header.='<th class="manage-column column-date'.$datesorting2.'" id="sent_at" scope="col"><a href="#" class="orderlink" ><span>'.__('Sent On',WYSIJA).'</span><span class="sorting-indicator"></span></a></th>
                        </tr>';
                            echo $header;
                        ?>
                    </thead>
                    <tfoot>
                        <?php
                        echo $header;
                        ?>
                    </tfoot>

                    <tbody class="list:<?php echo $this->model->table_name.' '.$this->model->table_name.'-list" id="wysija-'.$this->model->table_name.'"' ?>>

                            <?php
                            $listingRows="";
                            $alt=true;

                            $statuses=array("-1"=>__('Sent to %1$s out of %2$s',WYSIJA),"0"=>__("Draft",WYSIJA),"1"=>__('%1$s out of %2$s sent.',WYSIJA),"3"=>__('%1$s out of %2$s sent.',WYSIJA),"2"=>__('Sent to %1$s out of %2$s',WYSIJA),"99"=>__('%1$s out of %2$s sent.',WYSIJA));

                            foreach($data['campaigns'] as $row){
                                $classRow=$messageListEdit='';
                                //check if lists have been removed in case of scheduled newsletter or  auto post notif

                                if(isset($row['classRow'])){
                                    $classRow.=$row['classRow'];
                                }
                                if(isset($row['msgListEdit'])) $messageListEdit=$row['msgListEdit'];


                                if($alt) $classRow.='alternate';
                                $editStep='editTemplate';
                                if($row["type"]==2){
                                    $classRow.=" autonl";
                                    $editStep='edit';
                                }

                                if((int)$row["status"]==4 && isset($row['params']['schedule']['isscheduled'])){
                                    $classRow.=" scheduled";
                                }
                                if(in_array($row["status"], array(1,3,99))) $classRow.=" sending";
                                if($row["status"]==2) $classRow.=" sent";


                                //$row["params"]=unserialize(base64_decode($row["params"]));
                                ?>
                                <tr class="<?php echo $classRow ?>" >

                                    <th scope="col" class="check-column" >
                                        <input type="checkbox" name="wysija[campaign][campaign_id][]" id="campaign_id_<?php echo $row["campaign_id"] ?>" value="<?php echo esc_attr($row["campaign_id"]) ?>" class="checkboxselec" />
                                    </th>
                                    <td class="name column-name">
                                        <strong>
                                        <?php ;
                                        if(in_array($row["status"], array(0,4,-1))){
                                            $durationsent=$statusshared='';
                                            ?><a href="admin.php?page=wysija_campaigns&id=<?php
                                            echo $row["email_id"] ?>&action=edit" class="row-title"><?php
                                            echo $row["name"]; ?></a> - <span class="post-state"><?php
                                            if(isset($row['params']['schedule']['isscheduled']) && $row['status']==4){
                                                $toolboxH=&WYSIJA::get('toolbox','helper');


                                                //no recording just conversion
                                                $scheduletimenoffset=strtotime($row['params']['schedule']['day'].' '. $row['params']['schedule']['time']);
                                                $timeleft=$toolboxH->offset_time($scheduletimenoffset)-time();
                                                if($timeleft<0){
                                                    $autoNL=&WYSIJA::get('autonews','helper');
                                                    $autoNL->checkScheduled();
                                                }else{
                                                    if($timeleft<(3600*24)) {
                                                        $timeleft=$toolboxH->duration($timeleft,true,4);
                                                        $durationsent=sprintf(__('Scheduled to be sent in %1$s'),$timeleft);
                                                    }
                                                    else {
                                                        $timeleft=date_i18n(get_option('date_format').' '.get_option('time_format'),$scheduletimenoffset);
                                                        $durationsent=sprintf(__('Scheduled to be sent on %1$s'),$timeleft);
                                                    }
                                                }



                                                $statusshared= $durationsent;
                                                echo __('Scheduled',WYSIJA);
                                            }else{
                                                if($row['type']==2) echo __('Draft',WYSIJA);
                                                else{
                                                    if((int)$row['status']==-1) $resulttext=sprintf($statuses[(int)$row['status']],$data['sent'][$row["email_id"]]['to'],$data['sent'][$row["email_id"]]['total']);
                                                    else $resulttext=$statuses[(int)$row['status']];

                                                    echo $resulttext;
                                                }
                                            }
                                             ?></span>

                                        <?php
                                        }else{

                                         if(isset($data['sent'][$row["email_id"]]['to']) && $data['sent'][$row["email_id"]]['to']>0){
                                              ?><a href="admin.php?page=wysija_campaigns&id=<?php echo $row["email_id"] ?>&action=viewstats" class="row-title"><?php  echo $row["name"]; ?></a><?php
                                          }else{
                                              if($row["type"]==2){
                                                  ?>
                                              <a href="admin.php?page=wysija_campaigns&id=<?php echo $row["email_id"] ?>&action=pause" class="row-title pause-edit">
                                              <?php  echo $row["name"]; ?>
                                              </a><?php
                                              }else{
                                                  echo $row["name"];
                                              }
                                          }

                                        }
                                        ?></strong>
                                        <div class="row-actions">
                                                <?php

                                                $emailH=&WYSIJA::get('email','helper');
                                                $fullurl=$emailH->getVIB($row);

                                                ?><span class="viewnl">
                                                    <a href="<?php echo $fullurl ?>" target="_blank" class="viewnews" title="<?php _e('Preview in new tab',WYSIJA)?>"><?php _e('Preview',WYSIJA)?></a>
                                                </span><?php
                                                $deleteAction='';
                                                $dupid=$deleteId=$row["campaign_id"];
                                                $dupaction='duplicate';
                                                if(isset($row['params']['autonl']['parent'])) {
                                                    $deleteAction='Email';
                                                    $deleteId=$row["email_id"];
                                                    //$dupaction='duplicateEmail';
                                                }

                                                if($row["status"]==0 || $row["status"]==4){
                                                    ?>
                                                   | <span class="edit">
                                                        <a href="admin.php?page=wysija_campaigns&id=<?php echo $row["email_id"] ?>&action=<?php echo $editStep ?>" class="submitedit"><?php _e('Edit',WYSIJA)?></a>
                                                    </span>
                                                   | <span class="duplicate">
                                                        <a href="admin.php?page=wysija_campaigns&id=<?php echo $dupid ?>&email_id=<?php echo $row["email_id"] ?>&action=<?php echo $dupaction ?>" class="submitedit"><?php _e('Duplicate',WYSIJA)?></a>
                                                    </span>
                                                  | <span class="delete">
                                                        <a href="admin.php?page=wysija_campaigns&id=<?php echo $deleteId ?>&action=delete<?php echo $deleteAction ?>&_wpnonce=<?php echo $this->secure(array("action"=>"delete".$deleteAction,"id"=>$deleteId),true); ?>" class="submitdelete"><?php _e('Delete',WYSIJA)?></a>
                                                    </span>
                                                        <?php
                                                }else{

                                                    if($row["status"]==-1){
                                                        ?>
                                                      | <span class="edit"><a href="admin.php?page=wysija_campaigns&id=<?php echo $row["email_id"] ?>&action=<?php echo $editStep ?>" class="submitedit"><?php _e('Edit',WYSIJA)?></a></span>
                                                      | <span class="duplicate">
                                                          <a href="admin.php?page=wysija_campaigns&id=<?php echo $dupid ?>&email_id=<?php echo $row["email_id"] ?>&action=<?php echo $dupaction ?>" class="submitedit"><?php _e('Duplicate',WYSIJA)?></a>
                                                        </span>
                                                      | <span class="delete">
                                                            <a href="admin.php?page=wysija_campaigns&id=<?php echo $deleteId ?>&action=delete<?php echo $deleteAction ?>&_wpnonce=<?php echo $this->secure(array("action"=>"delete".$deleteAction,"id"=>$deleteId),true); ?>" class="submitdelete"><?php _e('Delete',WYSIJA)?></a>
                                                        </span>
                                                       <?php

                                                    }else{
                                                        if($row['type']==2){
                                                            ?>
                                                          | <span class="edit">
                                                              <a href="admin.php?page=wysija_campaigns&id=<?php echo $row["email_id"] ?>&action=pause" class="submitedit pause-edit"><?php _e('Edit',WYSIJA)?></a>
                                                            </span>
                                                            <?php
                                                        }
                                                        if(isset($data['sent'][$row["email_id"]]['to']) && $data['sent'][$row["email_id"]]['to']>0){
                                                           ?>

                                                           | <span class="viewstats">
                                                                <a href="admin.php?page=wysija_campaigns&id=<?php echo $row["email_id"] ?>&action=viewstats" class="stats"><?php _e('Stats',WYSIJA)?></a>
                                                            </span>

                                                                <?php
                                                        }

                                                        ?>
                                                      | <span class="duplicate">
                                                          <a href="admin.php?page=wysija_campaigns&id=<?php echo $dupid ?>&email_id=<?php echo $row["email_id"] ?>&action=<?php echo $dupaction ?>" class="submitedit"><?php _e('Duplicate',WYSIJA)?></a>
                                                      </span>
                                                      | <span class="delete">
                                                            <a href="admin.php?page=wysija_campaigns&id=<?php echo $deleteId ?>&action=delete<?php echo $deleteAction ?>&_wpnonce=<?php echo $this->secure(array("action"=>"delete".$deleteAction,"id"=>$deleteId),true); ?>" class="submitdelete"><?php _e('Delete',WYSIJA)?></a>
                                                        </span>
                                                      <?php
                                                    }
                                                } ?>
                                        </div>
                                    </td>
                                    <td><?php

                                        switch((int)$row["status"]){
                                            case 99:
                                            case 3:
                                            case 2:
                                            case 1:

                                                if($row["type"]==2) {
                                                    $pause= '';
                                                    if(isset($row["params"]['autonl']['event']) && $row["params"]['autonl']['event']=='new-articles' && $row["params"]['autonl']['when-article']!='immediate'){
                                                        /*if next send is passed or not set then we just create a new email*/
//if($row["email_id"]==7)   unset($row["params"]['autonl']['nextSend']);
//$row["params"]['autonl']['nextSend']=-1;

                                                       /**
                                                         * IMPORTANT WE COMPARE TO THE OFFSET TIME (time set by the administrator)
                                                         */
                                                        $toolboxH=&WYSIJA::get('toolbox','helper');

                                                        if(!isset($row["params"]['autonl']['nextSend']) || (time() > $toolboxH->offset_time((int)$row["params"]['autonl']['nextSend']))){
                                                            $autonH=&WYSIJA::get('autonews','helper');

                                                            $nextSend=$autonH->nextSend($row);

                                                        }else{
                                                            $nextSend=$row["params"]['autonl']['nextSend'];
                                                        }

                                                        $timeleft=$toolboxH->offset_time($nextSend)-time();
                                                        $toolboxH=&WYSIJA::get('toolbox','helper');
                                                        $time=$toolboxH->localtime($row["params"]['autonl']['time'],true);
                                                        $dayname=$toolboxH->getday($row["params"]['autonl']['dayname']);
                                                        $daynumber=$toolboxH->getdaynumber($row["params"]['autonl']['daynumber']);
                                                        $weeknumber=$toolboxH->getweeksnumber($row["params"]['autonl']['dayevery']);

                                                        if($timeleft<(3600*24)) {
                                                            $timeleft=$toolboxH->duration($timeleft,true,2);
                                                            $durationsent=sprintf(__('Next send out in %1$s',WYSIJA),$timeleft);
                                                        }
                                                        else {
                                                            $timeleft=date_i18n(get_option('date_format').' '.get_option('time_format'),$nextSend);
                                                            $durationsent=sprintf(__('Next send out on %1$s',WYSIJA),$timeleft);
                                                        }



                                                        switch($row["params"]['autonl']['when-article']){
                                                            case 'daily':
                                                                $statussent=sprintf(__('Sent daily at %1$s.',WYSIJA),$time);
                                                                break;
                                                            case 'weekly':
                                                                $statussent=sprintf(__('Sent weekly on %1$s at %2$s',WYSIJA),$dayname,$time);
                                                                break;
                                                            case 'monthly':
                                                                $statussent=sprintf(__('Sent monthly on the %1$s at %2$s',WYSIJA),$daynumber,$time);
                                                                break;
                                                            case 'monthlyevery':
                                                                $statussent=sprintf(__('Sent monthly on the %1$s %2$s at %3$s',WYSIJA),$weeknumber,$dayname,$time);
                                                                break;
                                                        }

                                                        echo '<p>'.$statussent.'</p>';

                                                        echo '<p>'.$durationsent.' ('.__('if there\'s new content',WYSIJA).')</p>';

                                                        echo $pause;
                                                    }else{
                                                        $delay='';
                                                        if(!isset($row["params"]['autonl']['numberafter'])) $numberafter=0;
                                                        else {
                                                            $numberafter=(int)$row["params"]['autonl']['numberafter'];
                                                            $delay=$numberafter.' '.$data['autonl']['fields']['numberofwhat']['valuesunit'][$row["params"]['autonl']['numberofwhat']];
                                                        }


                                                        $statustext=$this->getSendingStatus($row,$data,$numberafter,$delay);
                                                        echo $statustext.$pause;
                                                        if(!$numberafter) echo $this->dataBatches($data,$row,$pause,$statuses);
                                                        else  echo $this->dataBatches($data,$row,$pause,$statuses,true);
                                                    }

                                                }else{
                                                    $pause= ' | <a href="admin.php?page=wysija_campaigns&id='.$row["email_id"].'&action=pause" class="submitedit">'.__("Pause",WYSIJA).'</a>';
                                                    echo $this->dataBatches($data,$row,$pause,$statuses);
                                                }

                                                break;
                                            case -1:

                                                if($row["type"]==2) {
                                                    $resumelink=__('Not active.',WYSIJA).' | <a href="admin.php?page=wysija_campaigns&id='.$row["email_id"].'&action=resume" class="submitedit">'.__("Activate",WYSIJA).'</a>';
                                                    echo $resumelink;
                                                }else{
                                                    $resumelink='<a href="admin.php?page=wysija_campaigns&id='.$row["email_id"].'&action=resume" class="submitedit">'.__("Resume",WYSIJA).'</a>';
                                                    echo sprintf($statuses[$row["status"]],$data['sent'][$row["email_id"]]['to'],$data['sent'][$row["email_id"]]['total']);
                                                    echo ' | '.$resumelink;
                                                }

                                                break;
                                            case 4:
                                            case 0:
                                                if($statusshared) echo $statusshared;
                                                else {
                                                    if($row["type"]==2) echo __('Not active.',WYSIJA);
                                                    else    echo __('Not sent yet.',WYSIJA);//$statuses[$row["status"]];
                                                }
                                                break;
                                        }

                                    ?></td>
                                    <td><?php

                                    if(($row['type']==2 && isset($row['params']['autonl']['event']) && $row['params']['autonl']['event']=='subs-2-nl')){
                                        $row['lists']=$data['lists'][$row['params']['autonl']['subscribetolist']]['name'];
                                    }

                                        if(isset($row['lists'])) echo $row['lists'];
                                        else    echo $messageListEdit;

                                    ?></td>
                                    <td><?php if(isset($row['stats'])) echo $row['stats'];
                                              else echo $row['number_opened'].' - '.$row['number_clicked'].' - '.$row['number_unsub']; ?></td>
                                    <td title='<?php echo $this->fieldListHTML_created_at($row['modified_at'],get_option('date_format').' '.get_option('time_format')); ?>'><?php echo $this->fieldListHTML_created_at($row['modified_at']); ?></td>
                                    <td title='<?php echo $this->fieldListHTML_created_at($row['sent_at'],get_option('date_format').' '.get_option('time_format')); ?>'><?php echo $this->fieldListHTML_created_at($row['sent_at']); ?></td>

                                </tr><?php
                                $alt=!$alt;
                            }

                        ?>

                    </tbody>
                </table>
            </div>

            <?php

            echo $hiddenOrder;
    }

    function getSendingStatus($row,$data,$numberafter,$delay){
        $statustext=false;
        if(isset($row['msgSendSuspended'])){
            $statustext=$row['msgSendSuspended'];
        }else{
            switch($row["params"]['autonl']['event']){
                case 'new-articles':

                    $statustext=__('Send immediately.',WYSIJA);
                    break;
                case 'subs-2-nl':
                    $list='';
                    if(isset($data['autonl']['fields']['subscribetolist']['values'][$row["params"]['autonl']['subscribetolist']]))  $list='<em>"'.$data['autonl']['fields']['subscribetolist']['values'][$row["params"]['autonl']['subscribetolist']].'"</em>';

                    if($numberafter<1 || $row["params"]['autonl']['numberofwhat']=='immediate')  $statustext=sprintf(__('Sending immediately after someone subscribes to the mailing list %1$s',WYSIJA),$list);
                    else $statustext=sprintf(__('Sent %2$s after someone subscribes to the mailing list %1$s',WYSIJA),$list,'<strong>'.$delay.'</strong>');
                    break;
                case 'new-user':
                    if($numberafter<1 || $row["params"]['autonl']['numberofwhat']=='immediate')  $statustext=sprintf(__('Sent immediately after a new user is added to your site as %1$s',WYSIJA), '<b>'.$row["params"]['autonl']['roles'].'</b>');
                    else {
                        $roles='';
                        if(isset($row["params"]['autonl']['roles'])) $roles=$row["params"]['autonl']['roles'];
                        $statustext=sprintf(__('Sent %2$s after a new user is added to your site as %1$s',WYSIJA), '<b>'.$roles.'</b>',  '<strong>'.$delay.'</strong>');
                    }
                    break;
                default:
                    //try to see if the plugin returns something
                    $functioname=str_replace('-','_',$row["params"]['autonl']['event']).'_sendingStatus';
                    if(function_exists($functioname))   $statustext=call_user_func($functioname, $row["params"]['autonl'],$numberafter,$delay);
                    if(!$statustext)    $statustext=__('Sending per event',WYSIJA);
            }
        }

        return $statustext;
    }

    function sending_process(){
        $config=&WYSIJA::get("config","model");
        if((int)$config->getValue('total_subscribers')<2000) return true;
        return false;
    }

    function dataBatches($data,$row,$pause,$statuses,$pending=false){
        $sentto=$senttotal=$sentleft=0;
        $return='<div>';
        if(isset($data['sent'][$row["email_id"]]['to'])) $sentto=$data['sent'][$row["email_id"]]['to'];
        if(isset($data['sent'][$row["email_id"]]['total']))  $senttotal=$data['sent'][$row["email_id"]]['total'];
        if(isset($data['sent'][$row["email_id"]]['left']))  $sentleft=$data['sent'][$row["email_id"]]['left'];

        $statusdata=$senttohowmany='';
        if($row['type']!=2) $statusdata= sprintf($statuses[$row["status"]],$sentto,$senttotal);
        elseif($row['params']['autonl']['event']!='new-articles') $return.=sprintf(__('Sent to %1$s subscribers.',WYSIJA),$sentto);

        if($sentleft>0){

            $config=&WYSIJA::get('config','model');
            add_filter('wysija_send_ok',array($this,'sending_process'));
            $letsgo=apply_filters('wysija_send_ok', false);

            if($letsgo){
                $helperToolbox=&WYSIJA::get('toolbox','helper');
               if($row['type']!=2){
                   $return.= '<p><strong>'.sprintf(__('Time remaining: %1$s',WYSIJA),$helperToolbox->duration($data['sent'][$row['email_id']]['remaining_time'],true,4)).'</strong><br/>'.$statusdata.$pause.'</p>';
                   $return.= '<div class="info-stats">';
               }


               if($sentleft>(int)$config->getValue('sending_emails_number')) $nextBatchnumber=(int)$config->getValue('sending_emails_number');
               else  $nextBatchnumber=(int)$sentleft;


               //Next batch of xx emails will be sent in xx minutes. Don't wait & send right now.
               if($pending){
                   $return.= '<span style="color:#555">'.sprintf(__('%1$s email(s) pending.',WYSIJA),$nextBatchnumber);
                   $return.= '</span>';
               }else{
                   if($data['sent'][$row['email_id']]['running_for']){
                       $return.= sprintf(__('Current batch has been sent for %1$s',WYSIJA),$data['sent'][$row['email_id']]['running_for']);
                   }else{
                      $return.= sprintf(__('Next batch of %1$s emails will be sent in %2$s. ',WYSIJA),$nextBatchnumber,trim($helperToolbox->duration($data['sent'][$row['email_id']]['next_batch'],true,4)));
                      $return.= '<a href="admin.php?page=wysija_campaigns&action=send_test_editor&emailid='.$row['email_id'].'" class="action-send-test-editor" >'.__('Don\'t wait & send right now.',WYSIJA).'</a>';
                   }

               }

            }else{
                $return.= $statusdata;
                $link= str_replace(
                    array('[link]','[/link]'),
                    array('<a title="'.__('Get Premium now',WYSIJA).'" class="premium-tab" href="javascript:;">','</a>'),
                    __('To resume send [link]Go premium now![/link]',WYSIJA));
                 $return.= '<p>'.$link.'</p>';
            }

        }else $return.= $statusdata;
        $return.='</div>';
        return $return;
    }

    function linkStats($result,$data){
        $result='<ol>';
        $countloop=0;
        foreach($data['clicks'] as $click){
            if($countloop==0)   $label=str_replace(array('[link]','[/link]'),array('<a class="premium-tab" href="javascript:;">','</a>'),__('see links with a [link]Premium licence[/link].',WYSIJA));
            else $label='...';
            $result.='<li>'.$click['name'].' : '.$label.'</li>';
            $countloop++;
        }
        $result.='</ol>';
        return $result;
    }

    /*
     * main view
     */
    function viewstats($data){

        $this->search['title']=__('Search recipients',WYSIJA);
        ?>
        <div id="wysistats">
            <div id="wysistats1" class="left">
                <div id="statscontainer"></div>
                <h3><?php
                $helperToolbox=&WYSIJA::get('toolbox','helper');
                $sentwhen=$data['email']['sent_at'];
                if(!$sentwhen)$sentwhen=$data['email']['created_at'];
                if(isset($data['counts']['all']))  echo sprintf(__('%1$s emails sent %2$s ago',WYSIJA),$data['counts']['all'],$helperToolbox->duration($sentwhen));
                else __('No emails have been sent yet.',WYSIJA);
                ?></h3>
            </div>
            <div id="wysistats2" class="left">
                <ul>
                    <?php
                    foreach($data['charts']['stats'] as $stats){
                        echo '<li>'.$stats['name'].': '.$stats['number'].'</li>';
                    }
                    ?>

                </ul>
            </div>
            <div id="wysistats3" class="left">

                <p class="title"><?php echo __('What got clicked?',WYSIJA);?></p>

                <?php
                $modelC=&WYSIJA::get('config','model');
                if(count($data['clicks'])>0){
                    add_filter('wysija_links_stats',array($this,'linkStats'),1,2);
                    $linkshtml=apply_filters('wysija_links_stats', '',$data);
                    echo $linkshtml;
                }else  echo __('Nothing yet!',WYSIJA);

                /*if(count($data['clicks'])>0){
                    echo '<p style="font-size:14px;font-weight:bold;">';
                    echo str_replace(
                            array("[link]","[/link]"),
                            array('<a title="'.__('Just a few clicks. No need to reinstall. Easy.',WYSIJA).'" class="premium-tab" href="javascript:;">','</a>'),
                            _x_("Detailed view of links and their number of clicks is available in the Premium version. [link]Get it now.[/link]",WYSIJA));
                    echo '</p>';
                }*/

                 ?>
            </div>
            <div class="clear"></div>
        </div>
        <?php
        echo '<form method="post" action="" id="posts-filter">';
        $this->filtersLink($data);
        $this->filterDDPVIEW($data);

        ?>
        <div class="list">
            <table cellspacing="0" class="widefat fixed">
                    <thead>
                        <?php
                            $umstatussorting=$statussorting=$fnamesorting=$lnamesorting=$usrsorting=$datesorting=" sortable desc";
                            $hiddenOrder="";
                            if(isset($_REQUEST["orderby"])){
                                switch($_REQUEST["orderby"]){
                                    case "email":
                                        $usrsorting=" sorted ".$_REQUEST["ordert"];
                                        break;
                                    case "created_at":
                                        $datesorting=" sorted ".$_REQUEST["ordert"];
                                        break;
                                    case "ustatus":
                                        $statussorting=" sorted ".$_REQUEST["ordert"];
                                        break;
                                    case "umstatus":
                                        $umstatussorting=" sorted ".$_REQUEST["ordert"];
                                        break;
                                }
                                $hiddenOrder='<input type="hidden" name="orderby" id="wysija-orderby" value="'.esc_attr($_REQUEST["orderby"]).'"/>';
                                $hiddenOrder.='<input type="hidden" name="ordert" id="wysija-ordert" value="'.esc_attr($_REQUEST["ordert"]).'"/>';
                            }
                            $header='<tr class="thead">
                            <th class="manage-column column-username'.$usrsorting.'" id="email" scope="col" style="width:140px;"><a href="#" class="orderlink" ><span>'.__('Email',WYSIJA).'</span><span class="sorting-indicator"></span></a></th>';
                            /*$header.='<th class="manage-column column-fname'.$fnamesorting.'" id="firstname" scope="col" style="width:80px;">'.__('First name',WYSIJA).'</th>
                            <th class="manage-column column-lname'.$lnamesorting.'" id="lastname" scope="col" style="width:80px;">'.__('Last name',WYSIJA).'</th>';*/
                            $header.='<th class="manage-column column-umstatus'.$umstatussorting.'" id="umstatus" scope="col" style="width:80px;"><a href="#" class="orderlink" ><span>'.__('Email Status',WYSIJA).'</span><span class="sorting-indicator"></span></a></th>';
                            $header.='<th class="manage-column column-list-names" id="list-list" scope="col">'.__('Lists',WYSIJA).'</th>';
                            $header.='<th class="manage-column column-ustatus'.$statussorting.'" id="ustatus" scope="col" style="width:80px;"><a href="#" class="orderlink" ><span>'.__('Subscriber Status',WYSIJA).'</span><span class="sorting-indicator"></span></a></th>';
                            /*$header.='<th class="manage-column column-emails" id="emails-list" scope="col">'.__('Emails',WYSIJA).'</th>
                            <th class="manage-column column-opened" id="opened-list" scope="col">'.__('Opened',WYSIJA).'</th>
                            <th class="manage-column column-clic" id="clic-list" scope="col">'.__('Clicked',WYSIJA).'</th>';*/
                            $header.='<th class="manage-column column-date'.$datesorting.'" id="created_at" scope="col"><a href="#" class="orderlink" ><span>'.__('Subscribed on',WYSIJA).'</span><span class="sorting-indicator"></span></a></th>
                        </tr>';
                            echo $header;
                        ?>
                    </thead>
                    <tfoot>
                        <?php
                        echo $header;
                        ?>
                    </tfoot>

                    <tbody class="list:<?php echo $this->model->table_name.' '.$this->model->table_name.'-list" id="wysija-'.$this->model->table_name.'"' ?>>

                            <?php
                            $listingRows="";
                            $alt=true;

                            $statuses=array("-1"=>__("Unsubscribed",WYSIJA),"0"=>__("Unconfirmed",WYSIJA),"1"=>__("Subscribed",WYSIJA));
                            $config=&WYSIJA::get("config","model");
                            if(!$config->getValue("confirm_dbleoptin"))  $statuses["0"]=$statuses["1"];


                            $mstatuses=array("-2"=>$this->getTransStatusEmail("notsent"),"-1"=>$this->getTransStatusEmail("bounced"),"0"=>$this->getTransStatusEmail("sent")
                                ,"1"=>$this->getTransStatusEmail("opened"),"2"=>$this->getTransStatusEmail("clicked"),"3"=>$this->getTransStatusEmail("unsubscribe"));
                            //dbg($data,false);
                            foreach($data['subscribers'] as $row){
                                $classRow="";
                                if($alt) $classRow=' class="alternate" ';

                                        echo '<tr '.$classRow.' >';
                                        echo '<td class="username column-username">';
                                        echo get_avatar( $row["email"], 32 );
                                        echo "<strong>".$row["email"]."</strong>";
                                        echo "<p style='margin:0;'>".$row["lastname"]." ".$row["firstname"]."</p>";


                                        echo '<div class="row-actions">
                                            <span class="edit">
                                                <a href="admin.php?page=wysija_subscribers&id='.$row["user_id"].'&action=edit" class="submitedit">'.__('View stats or edit',WYSIJA).'</a>
                                            </span>
                                        </div>';

                                    echo '</td>';
                                    /*<td><?php echo $row["firstname"] ?></td>
                                    <td><?php  echo $row["lastname"] ?></td> */ ?>
                                    <td><?php  echo $mstatuses[$row["umstatus"]]; ?></td>
                                    <td><?php if(isset($row["lists"])) echo $row["lists"] ?></td>
                                    <td><?php  echo $statuses[$row["ustatus"]]; ?></td>
                                    <?php /*<td><?php echo $row["emails"] ?></td>
                                    <td><?php echo $row["opened"] ?></td>
                                    <td><?php echo $row["clicked"] ?></td> */?>
                                    <td><?php echo $this->fieldListHTML_created_at($row["created_at"]) ?></td>

                                <?php
                                echo '</tr>';
                                $alt=!$alt;
                            }

                        ?>

                    </tbody>
                </table>
            </div>

            <?php
            echo $hiddenOrder;
            $this->limitPerPage();
            echo '</form>';
    }

    /* when creating a newsletter or when editing as a draft*/
    function add($data=false){

        $this->data=$data;
        $step=array();

        $step['type']=array(
            'type'=>'type_nl',
            'class'=>'validate[required]',
            'label'=>__('What type of newsletter is this?',WYSIJA),
            'labeloff'=>1,
            'desc'=>'');

        $step['params']=array(
            'type'=>'frequencies',
            'label'=>__('When...',WYSIJA),'class'=>'validate[required]',
            'desc'=>'',
            'labeloff'=>1,
            'rowclass'=>'automatic-nl');


        $step['subject']=array(
            'type'=>'subject',
            'label'=>__('Subject line',WYSIJA),
            'class'=>'validate[required]',
            'desc'=>__("This is the subject of the email. Be creative since it's the first thing your subscribers will see.",WYSIJA));

        if($this->data['lists']){
            $step['lists']=array(
            'type'=>'lists',
            'class'=>'validate[minCheckbox[1]] checkbox',
            'rowclass'=>'listcheckboxes',
            'label'=>__('Lists',WYSIJA),
            'labeloff'=>1,
            'desc'=>__('The list of subscribers which will be used for that campaign.',WYSIJA));
        }





        if(!isset($msg['browsermsg'])){
        ?>
        <div id="browsernotsupported" class="updated" style="display:none;">
            <?php echo str_replace(
                        array("[/linkchrome]","[/linkff]","[/linkie]","[/linksafari]","[/link_ignore]",
                            "[linkchrome]","[linkff]","[linkie]","[linksafari]","[link_ignore]"),
                        array("</a>","</a>","</a>","</a>","</a>",
                            '<a href="http://www.google.com/chrome/" target="_blank">','<a href="http://www.getfirefox.com" target="_blank">','<a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home" target="_blank">','<a href="http://www.apple.com/safari/download/" target="_blank">','<a class="linkignore browsermsg" href="javascript:;">'),
                        __("Yikes! Your browser might not be supported. Get the latest [linkchrome]Chrome[/linkchrome], [linkff]Firefox[/linkff], [linkie]Internet Explorer[/linkie] or [linksafari]Safari[/linksafari]. It seems to work?[link_ignore]Dismiss[/link_ignore].",WYSIJA));?>
        </div>
        <?php
        }
        ?>
        <form name="step1" method="post" id="campaignstep3" action="" class="form-valid">

            <table class="form-table">
                <tbody>
                    <?php
                        //dbg($data);
                        echo $this->buildMyForm($step,$data,"email",true);
                    ?>
                </tbody>
            </table>

            <?php
            $this->model->table_name='email';
            $this->model->pk='email_id';

            if(isset($data['email']['type']) && $data['email']['type']==2)    $this->immediatewarning='<input type="submit" id="save-reactivate" value="'.__("Save and reactivate",WYSIJA).'" name="save-reactivate" class="button-primary wysija"/>'.$this->immediatewarning;

            $this->_savebuttonsecure($data,"savecamp",__("Next step",WYSIJA),$this->immediatewarning);

            ?>

        </form>
        <?php
    }

    function editTemplate($data=false){
        $wjEngine =& WYSIJA::get('wj_engine', 'helper');

        if(isset($data['email']['wj_data'])) {
            $wjEngine->setData($data['email']['wj_data'], true);
        } else {
            $wjEngine->setData();
        }
        if(isset($data['email']['wj_styles'])) {
            $wjEngine->setStyles($data['email']['wj_styles'], true);
        } else {
            $wjEngine->setStyles();
        }

//print "\n\n--------\n\n";
//echo '<div style="width:900px;margin:0 auto;">';
//echo $wjEngine->renderEmail($data['email']);
//echo '</div>';
//print "\n\n--------\n\n";
//exit;
        ?>
            <style type="text/css" id="wj_css">
                <?php echo $wjEngine->renderStyles(); ?>
            </style>

            <!-- BEGIN: Wysija Editor -->
            <?php echo $wjEngine->renderEditor(); ?>
            <!-- END: Wysija Editor -->
            <?php $defaultData = $wjEngine->getDefaultData(); ?>
            <div id="wysija_default_header" style="display:none;"><?php echo $wjEngine->renderEditorHeader($defaultData['header']); ?></div>
            <div id="wysija_default_footer" style="display:none;"><?php echo $wjEngine->renderEditorFooter($defaultData['footer']); ?></div>
            <div id="wysija_widgets_settings" style="display:none;">
                <div class="autopost"><?php
                    // if it's a post notification that should be sent immediately after an article is published, constrain to only 1 autopost with 1 post_limit
                    if((int)$data['email']['type'] === 2 && $data['email']['params']['autonl']['event'] === 'new-articles' && $data['email']['params']['autonl']['when-article'] === 'immediate') {
                        print 'single';
                    } else {
                        print 'multiple';
                    }
                ?></div>
                <div class="divider">
                    <?php
                    $params = $data['email']['params'];

                    if(is_array($params) and isset($params['divider'])) {
                        $divider = $params['divider'];
                    } else {
                        $divider = $defaultData['widgets']['divider'];
                    }
                    echo $wjEngine->renderEditorBlock(array_merge(array('type' => 'divider', 'no-block' => true), $divider));
                    ?>
                </div>
                <div class="image"><?php print WYSIJA_EDITOR_IMG."transparent.png"; ?></div>
                <div class="theme"><?php if(isset($data['email']['params']['theme'])) { print $data['email']['params']['theme']; } else { print 'default'; } ?></div>
            </div>

            <!-- BEGIN: Wysija Toolbar -->
            <div id="wysija_toolbar">
                <ul class="wysija_toolbar_tabs">
                    <li class="wjt-content">
                        <a class="selected" href="javascript:;" rel="content"><?php _e("Content",WYSIJA)?></a>
                    </li>
                    <li class="wjt-images"><a href="javascript:;" rel="images"><?php _e("Images",WYSIJA)?></a></li>
                    <li class="wjt-styles"><a href="javascript:;" rel="styles"><?php _e("Styles",WYSIJA)?></a></li>
                    <li class="last wjt-themes"><a href="javascript:;" rel="themes"><?php _e("Themes",WYSIJA)?></a></li>
                </ul>

                <!-- CONTENT BAR -->
                <ul class="wj_content" style="display:block;">
                    <li class="notice"><?php _e('Drag the widgets below into your newsletter.', WYSIJA) ?></li>
                    <li><a class="wysija_item" wysija_type="text"><?php _e('Plain text',WYSIJA) ?></a></li>
                    <?php if((int)$data['email']['type'] === 1 || ((int)$data['email']['type'] === 2 && (empty($data['email']['params']['autonl']['event']) || $data['email']['params']['autonl']['event'] !== 'new-articles'))) { ?><li><a class="wysija_item" wysija_type="post"><?php _e('WordPress post',WYSIJA) ?></a></li><?php } ?>
                    <?php if((int)$data['email']['type'] === 2) { ?><li><a class="wysija_item" id="wysija-widget-autopost" wysija_type="popup-auto-post"><?php _e('Automatic latest posts', WYSIJA) ?></a></li><?php } ?>
                    <li>
                        <a class="wysija_item" wysija_type="divider" wysija_src="<?php echo $divider['src'] ?>" wysija_width="<?php echo $divider['width'] ?>" wysija_height="<?php echo $divider['height'] ?>"><?php _e('Divider',WYSIJA) ?></a>
                        <a id="wysija_divider_settings" class="wysija_item_settings settings" href="javascript:;" href2="admin.php?page=wysija_campaigns&action=dividers&tab=dividers&emailId=<?php echo $_REQUEST['id'] ?>"><span></span></a>
                    </li>
                    <li><a class="wysija_item" wysija_type="popup-bookmark"><?php _e('Social bookmarks',WYSIJA) ?></a></li>
                </ul>

                <!-- IMAGES BAR -->
                <div class="wj_images" style="display:none;">
                    <div class="wj_button">
                        <?php

                        if(version_compare(get_bloginfo('version'), '3.3.0')>= 0){
                            $action='special_new_wordp_upload';
                        }else{
                            $action='special_wordp_upload';
                        }
                        ?>
                        <a id="wysija-upload-browse" class="button" href="javascript:;" href2="admin.php?page=wysija_campaigns&action=medias&tab=<?php echo $action; ?>&emailId=<?php echo $_REQUEST['id'] ?>"><?php _e('Add Images',WYSIJA) ?></a>
                    </div>

                    <ul id="wj-images-quick" class="clearfix">
                        <?php
                        //get list images from template
                        $helperImage=&WYSIJA::get('images','helper');
                        $result=$helperImage->getList();

                        $quick_select = $data['email']['params'];
                        if(!isset($quick_select['quickselection'])) $quick_select['quickselection'] = array();

                        if($result && empty($quick_select['quickselection'])) {
                            echo $wjEngine->renderImages($result);
                        } else {
                            echo $wjEngine->renderImages($quick_select['quickselection']);
                        }
                        ?>
                    </ul>
                    <div id="wj_images_preview" style="display:none;"></div>
                </div>

                <!-- STYLES BAR -->
                <div class="wj_styles" style="display:none;">
                    <form id="wj_styles_form" action="" method="post" accept-charset="utf-8">
                        <?php
                            echo $wjEngine->renderStylesBar();
                        ?>
                    </form>
                </div>

                <!-- THEMES BAR -->
                <div class="wj_themes" style="display:none;">
                    <div class="wj_button">
                        <a id="wysija-themes-browse" class="button" href="javascript:;" href2="admin.php?page=wysija_campaigns&action=themes"><?php _e('Add more themes',WYSIJA) ?></a>
                    </div>
                    <ul id="wj_themes_list" class="clearfix">
                        <?php
                        //get themes
                        echo $wjEngine->renderThemes();
                        ?>
                    </ul>
                    <div id="wj_themes_preview" style="display:none;"></div>
                </div>

                <div id="wysija_notices" style="display:none;"><span id="wysija_notice_msg"></span><img alt="loader" style="display:none;" id="ajax-loading" src="<?php echo WYSIJA_URL ?>img/wpspin_light.gif" /></div>
            </div>
        <!-- END: Wysija Toolbar -->
        <?php
        global $current_user;

        $emailuser=$current_user->data->user_email;

                ?>
        <p><input type="text" name="receiver-preview" id="preview-receiver" value="<?php echo $emailuser ?>" /> <a href="javascript:;" id="wj-send-preview" class="button wysija"><?php _e("Send preview",WYSIJA) ?></a></p>
        <?php

        echo apply_filters('wysija_howspammy','');

        ?>


        <p class="submit">
                <?php $this->secure(array('action'=>"saveemail",'id'=>$data['email']['email_id'])); ?>
                <input type="hidden" name="wysija[email][email_id]" id="email_id" value="<?php echo esc_attr($data['email']['email_id']) ?>" />
                <input type="hidden" value="saveemail" name="action" />

                <a id="wj_next" class="button-primary wysija" href="admin.php?page=wysija_campaigns&action=editDetails&id=<?php echo $data['email']['email_id'] ?>"><?php _e("Next step",WYSIJA) ?></a>
                <?php
                //we cannot have it everywhere
                 if(false && $data && $data['email']['type']==2)    {
                     echo '<a id="save-reactivate" class="button-primary wysija" href="admin.php?page=wysija_campaigns&action=resume&id='.$data['email']['email_id'].'">'.__("Save and reactivate",WYSIJA).'</a>';

                     echo '<script type="text/javascript" charset="utf-8">';
                     echo  "$('save-reactivate').observe('click', function(e) {
                Event.stop(e);
                saveWYSIJA(function() {
                    window.location.href = e.target.href;
                });
            });";
                    echo '</script>';
                 }

                ?>
                <?php echo '<a href="admin.php?page=wysija_campaigns&action=edit&id='.$data['email']['email_id'].'">'.__('go back to Step 1',WYSIJA).'</a>' ?>
            </p>
        <!-- BEGIN: Wysija Toolbar -->
        <script type="text/javascript" charset="utf-8">
            wysijaAJAX.id = <?php echo $_REQUEST['id'] ?>;

            function saveWYSIJA(callback) {
                wysijaAJAX.task = 'save_editor';
                wysijaAJAX.wysijaData = Wysija.save();
                wysijaAJAX.popTitle = "Save editor";
                WYSIJA_AJAX_POST(callback);
            }
            // auto save on next step click
            $('wj_next').observe('click', function(e) {
                Event.stop(e);
                saveWYSIJA(function() {
                    window.location.href = e.target.href;
                });
            });

            function switchThemeWYSIJA(event) {
                // get event target
                var target = (event.currentTarget) ? event.currentTarget : event.srcElement.parentElement;

                if(window.confirm("<?php _e('If you confirm the theme switch, it will override your header, footer, dividers and styles', WYSIJA) ?>")) {
                    wysijaAJAX.task = 'switch_theme';
                    wysijaAJAX.wysijaData = Object.toJSON(new Hash({theme: $(target).readAttribute('rel')}));
                    wysijaAJAX.popTitle = "Switch theme";
                    WYSIJA_AJAX_POST(function(response) {
                        // set theme name
                        $('wysija_widgets_settings').down('.theme').update(response.responseJSON.result.templates.theme);

                        // set css
                        if(response.responseJSON.result.styles.css != null) {
                            updateStyles(response.responseJSON.result.styles.css);
                        }

                        // update styles form
                        if(response.responseJSON.result.styles.form != null) {
                            // refresh styles form
                            $('wj_styles_form').innerHTML = response.responseJSON.result.styles.form;
                            // setup color pickers
                            setupColorPickers();

                            // setup apply styles on value changed
                            setupStylesForm();

                            // apply styles
                            applyStyles();
                        }

                        // set header
                        if(response.responseJSON.result.templates.header != undefined) {
                            $$('.'+Wysija.options.header)[0].replace(response.responseJSON.result.templates.header);
                        }
                        // set footer
                        if(response.responseJSON.result.templates.footer != undefined) {
                            $$('.'+Wysija.options.footer)[0].replace(response.responseJSON.result.templates.footer);
                        }
                        // set divider
                        if(response.responseJSON.result.templates.divider != undefined) {
                            Wysija.setDivider(response.responseJSON.result.templates.divider, response.responseJSON.result.templates.divider_options);
                            Wysija.replaceDividers();
                        }
                        Wysija.init();
                        Wysija.autoSave();
                    });
                    return false;
                }
            }

            // auto save
            new Timer(15 * 1000, function(){
              if (this.count > 0) {
                  if(Wysija.flags.doSave === true) {
                      saveWYSIJA(function() {
                          Wysija.flags.doSave = false;
                      });
                  }
              }
            });

            function applyStyles() {
                wysijaAJAX.task = 'save_styles';
                wysijaAJAX.wysijaStyles = Object.toJSON($('wj_styles_form').serialize(true));
                wysijaAJAX.popTitle = "Save styles";
                WYSIJA_AJAX_POST(function(response) {
                    // remove fixed height for each text block
                    $$('.wysija_text').invoke('setStyle', {height:'auto'});

                    // apply new styles
                    updateStyles(response.responseJSON.result.styles);
                });

                return false;
            }

            function setupStylesForm() {
                $$('#wj_styles_form select, #wj_styles_form input').invoke('observe', 'change', applyStyles);
            }

            function updateStyles(styles) {
                // remove previous styles
                if($('wj_css') != undefined) $('wj_css').remove();

                // append new styles
                var head = document.getElementsByTagName('head')[0],
                    style = document.createElement('style'),
                    rules = document.createTextNode(styles);
                style.type = 'text/css';
                style.id = 'wj_css';
                if(style.styleSheet) style.styleSheet.cssText = rules.nodeValue; else style.appendChild(rules);
                head.appendChild(style);
            }

            function setupColorPickers() {
                jQuery(function($) {
                    $(".color").modcoder_excolor({
                        hue_bar : 1,
                        border_color : '#969696',
                        anim_speed : 'fast',
                        round_corners : false,
                        shadow_size : 2,
                        shadow_color : '#f0f0f0',
                        background_color : '#ececec',
                        backlight : false,
                        label_color : '#333333',
                        effect : 'fade',
                        show_input: false,
                        z_index:20000,
                        hide_on_scroll: true,
                        callback_on_init: function() {
                            Wysija.locks.selectingColor = true;
                        },
                        callback_on_select: function(color, input) {
                            Wysija.updateCSSColor(input, color);
                        },
                        callback_on_ok : function() {
                            applyStyles();
                            Wysija.locks.selectingColor = false;
                        }
                    });
                });
            }

            function saveIQS(){
                wysijaAJAX.task = 'save_IQS';
                wysijaAJAX.wysijaIMG = Object.toJSON(wysijaIMG);
                WYSIJA_AJAX_POST();
            }

            // prototype on load
            document.observe('dom:loaded', function() {
                setupStylesForm();

                var konami = new Konami();
                konami.code = function() {
                    Wysija.flyToTheMoon();
                }
                konami.load();
            });

            // jquery on load
            jQuery(function($) {
                $(function(){
                    setupColorPickers();
                });
            });
        </script>
        <!-- END: Wysija Toolbar -->
        <div id="wysija-konami" >
            <div id="wysija-konami-overlay" style="display:none;width:100%; height:100%; position:fixed;top:0;left:0;background-color:#fff;z-index:99998;overflow:hidden;">
                <img id="wysija-konami-bird" src="<?php echo WYSIJA_URL ?>img/wysija_bird.jpg" style="display:none;z-index:99999;position:absolute;top:100px;left:100px;" width="597" height="483" />
            </div>
        </div>

        <div id="wysija-divider">

        </div>
        <?php
    }
    /* when newsletter has been sent let's see the feedback */
    function editDetails($data=false){

        $this->data=$data;
        $step=array();
        $step['subject']=array(
            'type'=>'subject',
            'label'=>__('Subject line',WYSIJA),
            'class'=>'validate[required]',
            'desc'=>__("Be creative! It's the first thing your subscribers see. Tempt them to open your email.",WYSIJA));

        if((int)$data['email']['type'] === 2){
            $step['params']=array(
            'type'=>'frequencies',
            'label'=>__('When...',WYSIJA),'class'=>'validate[required]',
            'desc'=>'',
            'labeloff'=>1,
            'rowclass'=>'automatic-nl');

            $step['type']=array(
            'type'=>'type_nl',
            'class'=>'validate[required]',
            'labeloff'=>1,
            'label'=>__('What type of newsletter is this?',WYSIJA),
            'rowclass'=>'hidden');

            if(isset($data['email']["params"]['autonl']['event']) && $data['email']["params"]['autonl']['event']=='new-articles'){
                $step['subject']['desc']=str_replace(array('[number]','[total]','[post_title]'),array('<b>[number]</b>','<b>[total]</b>','<b>[post_title]</b>'),__('Insert [total] to show number of posts, [post_title] to show the latest post\'s title & [number] to display the issue number.',WYSIJA));
            }

        }

        if($this->data['lists']){
            $step['lists']=array(
            'type'=>'lists',
            'class'=>'validate[minCheckbox[1]] checkbox',
            'label'=>__('Lists',WYSIJA),
             'labeloff'=>1,
             'rowclass'=>'listcheckboxes',
            'desc'=>__('The subscriber list that will be used for this campaign.',WYSIJA));
        }

        $step['from_name']=array(
            'type'=>'fromname',
            'class'=>'validate[required]',
            'label'=>__('Sender',WYSIJA),
            'desc'=>__('This is name & email of yourself or your company.',WYSIJA));



        $step['replyto_name']=array(
            'type'=>'fromname',
            'class'=>'validate[required]',
            'label'=>__('Reply-to name & email',WYSIJA),
            'desc'=>__('When the subscribers hit "reply" this is who will receive their email.',WYSIJA));


        $step=apply_filters('wysija_extend_step3', $step);

        //we schedule only the type 1 newsletter
        if($data['email']['type']==1){
            $step['scheduleit']=array(
            'type'=>'scheduleit',
            'class'=>'',
            'label'=>__('Schedule it',WYSIJA),
            'desc'=>'');
        }

        ?>
        <form name="step3" method="post" id="campaignstep3" action="" class="form-valid">

            <table class="form-table">
                <tbody>
                    <?php

                        echo $this->buildMyForm($step,$data,"email");

                    ?>

                </tbody>
            </table>
             <?php
                global $current_user;
                $emailuser=$current_user->data->user_email;

            ?>

            <p><input type="text" name="receiver-preview" id="preview-receiver" value="<?php echo $emailuser ?>" /> <a href="javascript:;" id="wj-send-preview" class="button wysija"><?php _e("Send preview",WYSIJA) ?></a></p>

            <p class="submit">
                <?php $this->secure(array('action'=>"savelast",'id'=>$_REQUEST['id'])); ?>
                <input type="hidden" name="wysija[email][email_id]" id="email_id" value="<?php echo esc_attr($data['email']['email_id']) ?>" />
                <input type="hidden" name="wysija[campaign][campaign_id]" id="campaign_id" value="<?php echo esc_attr($data['email']['campaign_id']) ?>" />
                <input type="hidden" value="savelast" name="action"  />
                <input type="hidden" value="" name="wj_redir" id="hid-redir" />
                <?php
                if((int)$this->data['email']['type']==2){
                    $sendNow=esc_attr(__('Activate now',WYSIJA));
                    $saveresumesend=esc_attr(__('Activate now',WYSIJA));
                    $buttonsave=esc_attr(__('Save & close',WYSIJA));
                    $buttonsendlater=$buttonsave;
                }else{
                    $sendNow=esc_attr(__('Send',WYSIJA));
                    $saveresumesend=esc_attr(__('Send',WYSIJA));
                    $buttonsave=esc_attr(__('Save & close',WYSIJA));
                    $buttonsendlater=esc_attr(__('Save & close',WYSIJA));
                }

                if((int)$this->data['email']['status']==0){

                    if($this->data['lists']){
                        ?>
                    <input type="submit" value="<?php echo $sendNow ?>" id="submit-send" name="submit-send" class="button-primary wysija"/>
                        <?php
                    }?>
                    <input type="submit" value="<?php echo $buttonsendlater ?>" id="submit-draft" name="submit-draft" class="button wysija"/>
                    <?php
                }else{
                    ?>

                    <input type="submit" value="<?php echo $saveresumesend ?>" id="submit-send" name="submit-resume" class="button-primary wysija"/>
                    <input type="submit" value="<?php echo $buttonsave ?>" id="submit-draft" name="submit-pause" class="button wysija"/>
                    <?php
                }
                ?>

                <?php

                echo str_replace(
                    array('[link]','[/link]'),
                    array('<a href="admin.php?page=wysija_campaigns&action=editTemplate&id='.$data['email']['email_id'].'" id="link-back-step2">','</a>'),
                    __("or simply [link]go back to design[/link].",WYSIJA)
                    );
                echo $this->immediatewarning;

                ?>
            </p>
        </form>
        <?php
    }

    function fieldFormHTML_subject($key,$val,$model,$params){
        $fieldHTML= '';
        $field=$key;


        $formObj=&WYSIJA::get("forms","helper");
        $fieldHTML='<div id="titlediv">
            <div id="titlewrap" style="width:70%;">
                    <input class="titlebox '.$params['class'].'" id="'.$key.'" name="wysija[email][subject]" size="30" type="text" autocomplete="off" value="'.esc_attr($val).'" />
            </div>
        </div>';


        return $fieldHTML;
    }

    function fieldFormHTML_frequencies($key,$val,$model,$params){
        $fieldHTML= '<div class="frequencies">';
        $field=$key;
        $id=$key;
        if(!$val) {
            $val=array(
                'autonl'=>
                    array(
                    'event'=>'new-articles',
                    'day'=>'monday',
                    'time'=>'00:00:00',
                    'when-article'=>'daily',
                    'when-subscribe'=>'daily',
                    )
                );
        }elseif(is_string($val)){
            $val=unserialize(base64_decode($val));
        }


        if(!isset($val['autonl'])){
            $val=array(
                'autonl'=>
                    array(
                    'event'=>'new-articles',
                    'day'=>'monday',
                    'time'=>'00:00:00',
                    'when-article'=>'daily',
                    'when-subscribe'=>'daily',
                    )
                );
        }

        $formsHelp=&WYSIJA::get('forms','helper');
        foreach($this->data['autonl']['fields'] as $fieldK =>$field){
            $myval='';
            $singleFieldHtml='';

            //dbg($field,0);
            if(isset($field['extend'])){
                $field=$this->data['autonl']['fields'][$field['extend']];
            }
            if(isset($val['autonl'][$fieldK]))  $myval=$val['autonl'][$fieldK];

            $classDDP='';
            if(isset($field['class'])) $classDDP=$field['class'];

            $dataArray=array('name'=>'wysija[email][params][autonl]['.$fieldK.']','id'=>$id.'-'.$fieldK, 'class'=>$classDDP);
            if(isset($field['style'])){
                $dataArray['style']=$field['style'];
            }

            $arrayFields=array('event');
            if(!in_array($fieldK, $arrayFields)) $classDDP.='sub-event';
            $arrayFields[]='when-article';
            if(!in_array($fieldK, $arrayFields)) $classDDP.=' sub-when-article';
            $dataArray['class']=$classDDP;

            //by default we return a dropdown
            if(!isset($field['type'])){
                $singleFieldHtml.=$formsHelp->dropdown(
                    $dataArray,
                    $field['values'],$myval);
            }else{
                $typee=$field['type'];

                if($typee=='checkbox'){
                    $singleFieldHtml.=$formsHelp->$typee($dataArray,'',$myval);
                }else{
                   $singleFieldHtml.=$formsHelp->$typee($dataArray,$myval);
                }

            }

            if(isset($field['label_before']) || isset($field['label_after'])){
                $before=$after='';
                if(isset($field['label_before'])) $before=$field['label_before'];
                if(isset($field['label_after'])) $after=$field['label_after'];
                $singleFieldHtml='<label id="'.$id.'-label-'.$fieldK.'" for="'.$id.'-'.$fieldK.'" class="'.$classDDP.'">'.$before.$singleFieldHtml.$after.'</label>';
            }

            $fieldHTML.=$singleFieldHtml;
        }

        $fieldHTML.='</div>';
        return $fieldHTML;
    }

    function fieldFormHTML_type_nl($key,$val,$model,$params){
        $fieldHTML= '<div class="list-radios">';
        $field=$key;
        $valuefield=array();

        $typesnl=array(
            '1'=>array(
                'type'=>'standard',
                'label'=>__('Standard newsletter',WYSIJA),
                'default'=>1
            ),
            '2'=>array(
                'type'=>'automatic',
                'label'=>__('Automatically...',WYSIJA),
            )
        );

        foreach($typesnl as $typenl => $paramstnl){

            $checked='';
            if(($val && (int)$val==(int)$typenl) || (!$val && isset($paramstnl['default']))){
                $checked=' checked="checked" ';
            }

            $fieldHTML.='<label for="nl_type_'.$paramstnl['type'].'">'.
                    '<input class="radiotype-nl" id="nl_type_'.$paramstnl['type'].'" type="radio" name="wysija[email][type]" value="'.$typenl.'" '.$checked.' />'
                    .$paramstnl['label'].'</label>';
        }

        $fieldHTML.='</div>';
        return $fieldHTML;
    }

    function fieldFormHTML_lists($key,$val,$model,$params){
        $fieldHTML= '<div class="list-checkbox">';
        $field=$key;
        $valuefield=array();

        if(isset($this->data['campaign_list']) && $this->data['campaign_list']){
            foreach($this->data['campaign_list'] as $list){
                $valuefield[$list['list_id']]=$list;
            }
        }


        $formObj=&WYSIJA::get("forms","helper");

        foreach($this->data['lists'] as $list){

            $checked=false;
            if(isset($valuefield[$list['list_id']]))    $checked=true;

            $fieldHTML.= '<p><label for="'.$field.$list['list_id'].'">';
            $fieldHTML.=$formObj->checkbox( array('class'=>$params['class'].' checklists','alt'=>$list['name'], 'id'=>$field.$list['list_id'],'name'=>"wysija[campaign_list][list_id][]"),$list['list_id'],$checked).$list['name'].' <strong>('.$list['count'].')</strong>';
            $fieldHTML.='<input type="hidden" id="'.$field.$list['list_id'].'count" value="'.$list['count'].'" />';
            $fieldHTML.='</label></p>';

        }

        $fieldHTML.="</div>";
        return $fieldHTML;
    }
    function fieldFormHTML_scheduleit($key,$val,$model,$params){
        $formObj=&WYSIJA::get("forms","helper");

        $valuescheduled='';

        if(isset($this->data['email']['params']['schedule']['isscheduled']))$valuescheduled=$this->data['email']['params']['schedule']['isscheduled'];
        $data=$formObj->checkbox( array('class'=>$params['class'], 'id'=>$key,'name'=>"wysija[email][params][schedule][isscheduled]"),true,$valuescheduled);
        $data.=$this->fieldFormHTML_datepicker('datepicker',$val,$model,$params);
        return $data;
    }



    function fieldFormHTML_datepicker($key,$val,$model,$params){
        if((int)$this->data['email']['type']==2) return;

        $fieldHTML= '<span id="schedule-area" class="schedule-row" >';
        $field=$key;
        $valuefield=array();

        $formObj=&WYSIJA::get("forms","helper");

        $valuescheduled=$valuetime='';
        $valueday=date("Y/m/d");
        if(isset($this->data['email']['params']['schedule']['day']))$valueday=$this->data['email']['params']['schedule']['day'];
        if(isset($this->data['email']['params']['schedule']['time']))$valuetime=$this->data['email']['params']['schedule']['time'];
        if(isset($this->data['email']['params']['schedule']['isscheduled']))$valuescheduled=$this->data['email']['params']['schedule']['isscheduled'];

        $fieldHTML.=$formObj->input( array('class'=>$params['class'], 'id'=>$field.'-day','name'=>"wysija[email][params][schedule][day]"),$valueday);
        $fieldHTML.=' @ ';
        $fieldHTML.=$formObj->dropdown(
                    array('name'=>'wysija[email][params][schedule][time]','id'=>$field.'-time'),
                    $this->data['autonl']['fields']['time']['values'],$valuetime);

        $fieldHTML.="</span>";
        return $fieldHTML;
    }


    function edit($data){
        //$this->menuTop("edit");
        $formid='wysija-'.$_REQUEST['action'];

        ?>
        <div id="wysistats">
            <div id="wysistats1" class="left">
                <div id="statscontainer"></div>
                <h3><?php _e(sprintf('%1$s emails received.',$data['user']['emails']),WYSIJA)?></h3>
            </div>
            <div id="wysistats2" class="left">
                <ul>
                    <?php

                    foreach($data['charts']['stats'] as $stats){
                        echo "<li>".$stats['name'].": ".$stats['number']."</li>";
                    }
                        echo "<li>".__('Added',WYSIJA).":".$this->fieldListHTML_created_at($data['user']['details']["created_at"])."</li>";
                    ?>

                </ul>
            </div>
            <div id="wysistats3" class="left">
                <p class="title"><?php echo __(sprintf('Total of %1$d clicks:',count($data['clicks'])),WYSIJA);?></p>
                <ol>
                    <?php

                    foreach($data['clicks'] as $click){
                        echo "<li>".$click['name']." : ".$click['url']."</li>";
                    }

                    ?>

                </ol>
            </div>
            <div class="clear"></div>
        </div>

        <?php
        $this->buttonsave=__('Save',WYSIJA);
        $this->add($data);
    }

    function popup_image_data($data){
        echo $this->messages(true);
        ?>
        <div class="popup_content addlink">
            <form method="post" action="" class="image-data-form" id="image-data-form">
                <p>
                    <label for="url"><?php _e('Address:', WYSIJA) ?></label><br/>
                    <input type="text" name="url" value="<?php echo (!empty($data['url'])) ? esc_attr($data['url']) : 'http://' ?>" id="url" />
                </p>
                <p>
                    <label for="alt"><?php _e('Alternative text:', WYSIJA) ?></label><br/>
                    <input type="text" name="alt" value="<?php echo (!empty($data['alt'])) ? esc_attr($data['alt']) : '' ?>" id="alt" />
                </p>
                <p class="notice"><?php _e('This text is displayed when email clients block images, which is most of the time.', WYSIJA) ?></p>
                <p class="align-right"><input id="image-data-submit" class="button-primary" type="submit" name="submit" value="<?php _e('Save',WYSIJA) ?>" /></p>
            </form>
        </div>
        <?php
    }

    function popup_themes($errors){
        echo $this->messages(true);
        ?>
        <div id="overlay"><img id="loader" src="<?php echo WYSIJA_URL ?>img/wpspin_light.gif" /></div>
        <div class="popup_content themes">
            <form enctype="multipart/form-data" method="post" action="" class="validate">
                <div id="search-view" class="panel">
                    <?php
                        if(isset($_REQUEST['reload']) && (int)$_REQUEST['reload'] === 1) {
                            echo '<input type="hidden" id="themes-reload" name="themes-reload" value="1" />';
                        }
                    /*?>
                    <ul>
                        <li><?php _e("Newest",WYSIJA)?></li>
                        <li><a href="javascript:;"><?php _e("Popular",WYSIJA)?></a></li>
                        <li><a href="javascript:;"><?php _e("Premium",WYSIJA)?></a></li>
                        <li><a href="javascript:;"><?php _e("For Sale",WYSIJA)?></a></li>
                    </ul>
                    <input type="text" id="search-box" name="search" autocomplete="off" />
                    <input type="submit" id="sub-search-box" name="submit" value="<?php echo esc_attr(__('Search',WYSIJA));?>" />
                    * <?php */ ?>
                    <div class="clearfix">
                        <input type="button" id="sub-theme-box" name="submit" value="<?php echo esc_attr(__('Upload Theme (.zip)',WYSIJA));?>" class="button-secondary"/>
                        <span id="filter-selection"></span>
                        <div id="wj_paginator"></div>
                    </div>
                    <ul id="themes-list"></ul>
                </div>
                <div id="theme-view" class="panel" style="display:none;"></div>
            </form>
            <div id="theme-upload" class="panel">
                <form enctype="multipart/form-data" method="post" action="" class="validate">
                    <div class="wrap actions">
                        <a class="button-secondary2 theme-view-back" href="javascript:;"><?php echo __("<< Back",WYSIJA)?></a>
                    </div>
                    <div class="form">
                    <?php
                        $secure=array('action'=>"themeupload");
                        $this->secure($secure);
                        ?>
                        <p><input type="file" name="my-theme"/>( <?php
                        $helperNumbers=&WYSIJA::get('numbers','helper');
                        $data =$helperNumbers->get_max_file_upload();
                        $bytes=$data['maxmegas'];

                                        echo sprintf(__('total max upload file size : %1$s',WYSIJA),$bytes)?> )</p>
                        <p><label for="overwrite"><input type="checkbox" id="overwrite" name="overwriteexistingtheme" /><?php echo __("If a theme with the same name exists, overwrite it.",WYSIJA); ?></label></p>
                        <p><input type="hidden" name="action" value="themeupload" />
                        <input type="submit" class="button-primary" name="submitter" value="<?php _e("Upload",WYSIJA)?>" /></p>
                    </div>
                </div>
            </form>
        </div>
        <?php
    }

    function themeupload(){
        $this->popup_themes(false);
    }

    function selectCPT($value = null, $showall = true) {
        // make sure value is null if it's an empty string
        if($value !== null and strlen(trim($value)) === 0) $value = null;

        ?>
        <p class="clearfix">
            <?php
                $wptools=&WYSIJA::get('wp_tools','helper');
                $post_types=$wptools->get_post_types();
            ?>
            <label for="cpt"><?php _e('Select the post type', WYSIJA) ?></label>
            <select name="cpt" id="cpt">
            <?php
                if($showall === true) {
                    echo '<option value="all"'.(($value === 'all') ? ' selected="selected"' : '').'>'.__('All',WYSIJA).'</option>';
                }
                echo '<option value="post"'.(($value === 'post' or $value === null) ? ' selected="selected"' : '').'>'.__('Posts',WYSIJA).'</option>';
                echo '<option value="page"'.(($value === 'page') ? ' selected="selected"' : '').'>'.__('Pages',WYSIJA).'</option>';

                foreach($post_types as $key=> $post_type_obj) {
                    $selected = ($value === $key) ? ' selected="selected"' : '';
                    echo '<option value="'.$key.'"'.$selected.'>'.$post_type_obj->labels->name.'</option>';
                }
            ?>
            </select>
        </p>
        <?php
    }

    function popup_articles($errors){
        echo $this->messages(true);
        ?>
        <div class="popup_content articles">
            <form enctype="multipart/form-data" method="post" action="" class="media-upload-form validate" id="gallery-form">
                <div class="ml-submit">
                    <?php $this->selectCPT(); ?>
                    <div class="searchwrap">
                        <input type="text" id="search-box" name="search" autocomplete="off" />
                        <input type="submit" id="sub-search-box" name="submit" value="<?php echo esc_attr(__('Search',WYSIJA));?>" />
                        <label id="labelfullarticlesget" for="fullarticlesget">
                            <?php
                            $modelConfig=&WYSIJA::get('config','model');
                            $checked='';
                            if($modelConfig->getValue('editor_fullarticle')) $checked=' checked="checked" ';
                            ?>
                            <input type="checkbox" name="fullarticles" id="fullarticlesget" <?php echo $checked ?>/>
                            <?php
                            echo __('Insert entire post, not just excerpt',WYSIJA);
                            ?>
                        </label>
                    </div>
                </div>
                <div id="search-results"></div>

            </form>
        </div>
        <?php
    }

    function popup_dividers($data = array()) {
        echo $this->messages(true);

        ?>

        <div class="popup_content dividers">
            <form enctype="multipart/form-data" method="post" action="" class="" id="dividers-form">
                <ul class="dividers">
                    <?php
                        foreach($data['dividers'] as $divider) {
                            $selected = '';
                            if($divider['src'] === $data['selected']['src']) $selected = ' class="selected"';
                        ?>
                        <li class="clearfix"><a href="javascript:;"<?php echo $selected ?>><img src="<?php echo $divider['src'] ?>" alt="" width="<?php echo $divider['width'] ?>" height="<?php echo $divider['height'] ?>" /></a></li>
                        <?php
                        }
                    ?>
                </ul>
                <input type="hidden" name="email_id" value="<?php echo $data['email']['email_id'] ?>" id="email_id" />
                <input type="hidden" name="divider_src" value="<?php echo $data['selected']['src'] ?>" id="divider_src" />
                <input type="hidden" name="divider_width" value="<?php echo $data['selected']['width'] ?>" id="divider_width" />
                <input type="hidden" name="divider_height" value="<?php echo $data['selected']['height'] ?>" id="divider_height" />
                <p class="align-right">
                    <input type="submit" id="dividers-submit" class="button-primary" name="submit" value="<?php echo esc_attr(__('Done',WYSIJA));?>" />
                </p>
            </form>
        </div>


        <?php
    }

    function popup_autopost($data = array()) {
        echo $this->messages(true);
        $category_ids = (isset($data['params']['category_ids'])) ? trim($data['params']['category_ids']) : '';

        $selected_categories = array();
        if(strlen($category_ids) > 0) {
            $selected_categories = explode(',', $category_ids);
            sort($selected_categories);
        }

        ?>
        <div class="popup_content autopost">
            <div style="display:none;" id="category_list">
                <select name="category" class="categories">
                    <?php foreach($data['categories'] as $category) { ?>
                        <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <form enctype="multipart/form-data" method="post" action="" class="" id="autopost-form">
                <input type="hidden" name="category_ids" id="category_ids" value="<?php echo $category_ids ?>" />

                <!-- max number of articles -->
                <?php $this->selectCPT($data['params']['cpt'], false); ?>
                <?php
                    if($data['autopost_type'] === 'single') {
                ?>
                        <input type="hidden" name="post_limit" value="1" />
                <?php
                    } else {
                ?>
                    <p class="clearfix">
                        <label for="post_limit"><?php _e('Maximum of posts to show', WYSIJA) ?></label>
                        <select name="post_limit" id="post_limit">
                            <?php foreach($data['post_limits'] as $limit) { ?>
                                <option value="<?php echo $limit ?>"<?php if($limit === (int)$data['params']['post_limit']) echo 'selected="selected"' ?>><?php echo $limit ?></option>
                            <?php } ?>
                        </select>
                    </p>
                <?php
                    }
                ?>

                <!-- category -->
                <div class="category-selection">
                    <p class="clearfix">
                        <label for="category"><?php _e('Filter by category', WYSIJA) ?></label>
                        <select name="category" class="categories">
                            <option value="" selected="selected"><?php _e("All categories", WYSIJA) ?></option>
                            <?php foreach($data['categories'] as $category) {
                                $is_selected = '';
                                if(empty($selected_categories) === FALSE and isset($selected_categories[0])) {
                                    $is_selected = ((int)$category['id'] === (int)$selected_categories[0]) ? 'selected="selected"' : '';
                                }
                            ?>
                                <option value="<?php echo $category['id'] ?>" <?php echo $is_selected ?>><?php echo $category['name'] ?></option>
                            <?php } ?>
                        </select>
                        <span class="inline"><a href="javascript:;" class="icon-plus" id="add-category"><span></span></a></span>
                    </p>

                    <ul id="category_selection">
                        <?php
                            if(empty($selected_categories) === FALSE and count($selected_categories) > 1) {
                                for($i = 1; $i < count($selected_categories); $i++) { ?>
                                    <li id="category-<?php echo ($i+1) ?>" class="clearfix">
                                        <span>
                                            <select name="category" class="categories">
                                            <?php foreach($data['categories'] as $category) {
                                                $is_selected = ((int)$category['id'] === (int)$selected_categories[$i]) ? 'selected="selected"' : '';
                                            ?>
                                                <option value="<?php echo $category['id'] ?>" <?php echo $is_selected ?>><?php echo $category['name'] ?></option>
                                            <?php } ?>
                                            </select>
                                        </span>
                                        <a class="icon-minus remove-category" rel="<?php echo ($i+1) ?>" href="javascript:;"><span></span></a>
                                    </li>
                        <?php
                                }
                            }
                        ?>
                    </ul>
                </div>

                <!-- title -->
                <p class="clearfix">
                    <label><?php _e('Title style', WYSIJA) ?></label>
                    <select name="title_tag" id="title_tag">
                        <option value="h1"<?php if($data['params']['title_tag'] === 'h1') echo ' selected="selected"'; ?>><?php _e('Heading 1', WYSIJA) ?></option>
                        <option value="h2"<?php if($data['params']['title_tag'] === 'h2') echo ' selected="selected"'; ?>><?php _e('Heading 2', WYSIJA) ?></option>
                        <option value="h3"<?php if($data['params']['title_tag'] === 'h3') echo ' selected="selected"'; ?>><?php _e('Heading 3', WYSIJA) ?></option>
                    </select>

                    <select name="title_alignment" id="title_alignment">
                        <option value="left"<?php if($data['params']['title_alignment'] === 'left') echo ' selected="selected"'; ?>><?php _e('Left aligned', WYSIJA) ?></option>
                        <option value="center"<?php if($data['params']['title_alignment'] === 'center') echo ' selected="selected"'; ?>><?php _e('Centered', WYSIJA) ?></option>
                        <option value="right"<?php if($data['params']['title_alignment'] === 'right') echo ' selected="selected"'; ?>><?php _e('Right aligned', WYSIJA) ?></option>
                    </select>
                </p>

                <!-- alignment -->
                <p class="clearfix">
                    <label><?php _e('Image alignment', WYSIJA) ?></label>
                    <?php if($data['autopost_type'] !== 'single') { ?>
                    <label class="radio"><input type="radio" name="image_alignment" value="alternate"<?php if($data['params']['image_alignment'] === 'alternate') echo ' checked="checked"'; ?> /><?php _e('alternate left & right', WYSIJA) ?></label>
                    <?php } ?>
                    <label class="radio"><input type="radio" name="image_alignment" value="left"<?php if($data['params']['image_alignment'] === 'left') echo ' checked="checked"'; ?> /><?php _e('left', WYSIJA) ?></label>
                    <label class="radio"><input type="radio" name="image_alignment" value="center"<?php if($data['params']['image_alignment'] === 'center') echo ' checked="checked"'; ?> /><?php _e('center', WYSIJA) ?></label>
                    <label class="radio"><input type="radio" name="image_alignment" value="right"<?php if($data['params']['image_alignment'] === 'right') echo ' checked="checked"'; ?> /><?php _e('right', WYSIJA) ?></label>
                    <label class="radio"><input type="radio" name="image_alignment" value="none"<?php if($data['params']['image_alignment'] === 'none') echo ' checked="checked"'; ?> /><?php _e('no image', WYSIJA) ?></label>
                </p>

                <!-- post content: full post or excerpt -->
                <p class="clearfix">
                    <label>
                        <?php _e('Display...', WYSIJA) ?>
                        <span class="label"><?php echo str_replace(array('[link]', '[/link]'), array('<a href="http://support.wysija.com/knowledgebase/excerpts-in-wysija/?utm_source=wpadmin&utm_campaign=editor" target="_blank">', '</a>'), __('Which excerpt does it use? [link]Read more[/link]', WYSIJA)) ?></span>
                    </label>
                    <label class="radio"><input type="radio" name="post_content" value="excerpt"<?php if($data['params']['post_content'] === 'excerpt') echo ' checked="checked"'; ?> /><?php _e('excerpt', WYSIJA) ?></label>
                    <label class="radio"><input type="radio" name="post_content" value="full"<?php if($data['params']['post_content'] === 'full') echo ' checked="checked"'; ?> /><?php _e('full post', WYSIJA) ?></label>
                </p>

                <!-- read more -->
                <p class="clearfix">
                    <label for="readmore"><?php _e('"Read more" text', WYSIJA) ?></label>
                    <input type="text" name="readmore" value="<?php echo esc_attr($data['params']['readmore']); ?>" id="readmore" />
                </p>

                <!-- show dividers -->
                <?php
                    if($data['autopost_type'] === 'single') {
                ?>
                    <input type="hidden" name="show_divider" value="no" />
                <?php
                    } else {
                ?>
                    <p class="clearfix">
                        <label><?php _e('Show divider between posts', WYSIJA) ?></label>
                        <label class="radio"><input type="radio" name="show_divider" value="yes"<?php if($data['params']['show_divider'] === 'yes') echo ' checked="checked"'; ?> /><?php _e('yes', WYSIJA) ?></label>
                        <label class="radio"><input type="radio" name="show_divider" value="no"<?php if($data['params']['show_divider'] === 'no') echo ' checked="checked"'; ?> /><?php _e('no', WYSIJA) ?></label>
                    </p>

                    <p class="clearfix">
                        <label><?php _e('Background color with alternate', WYSIJA) ?></label>
                        <input class="color" type="text" name="bgcolor1" value="<?php if($data['params']['bgcolor1']) echo $data['params']['bgcolor1']; ?>" />
                        <input class="color" type="text" name="bgcolor2" value="<?php if($data['params']['bgcolor2']) echo $data['params']['bgcolor2']; ?>" />
                    </p>
                <?php
                    }
                ?>

                <!-- nopost_message: only applies when there is more than one group of post -->
                <?php
                    if($data['autopost_count'] > 1) {
                ?>
                <p class="clearfix">
                    <label for="nopost_message">
                        <?php _e('If there is no new content, display:', WYSIJA) ?>
                         <span class="label"><?php _e('You can also leave it empty', WYSIJA) ?></span>
                    </label>
                    <input type="text" name="nopost_message" value="<?php echo esc_attr($data['params']['nopost_message']); ?>" id="nopost_message" />
                </p>
                <?php
                    } else {
                ?>
                    <input type="hidden" name="nopost_message" value="<?php echo esc_attr($data['params']['nopost_message']); ?>" id="nopost_message" />
                <?php
                    }
                ?>

                <p class="align-right"><input type="submit" id="autopost-submit" class="button-primary" name="submit" value="<?php echo esc_attr(__('Done',WYSIJA));?>" /></p>
            </form>
        </div>
        <?php
    }

    function popup_bookmarks($data = array()){
        echo $this->messages(true);

        ?>
        <div class="popup_content bookmarks">
            <form enctype="multipart/form-data" method="post" action="" class="" id="bookmarks-form">
                <ul class="networks">
                    <?php
                    $i = 0;
                    foreach($data['networks'] as $key => $network) {
                    ?>
                        <li class="clearfix">
                            <input type="hidden" name="bookmarks-<?php echo($key) ?>-position" value="<?php echo($i++) ?>" />
                            <label for="bookmarks-url-<?php echo($key) ?>"><?php echo($network['label']) ?></label><input type="text" name="bookmarks-<?php echo($key) ?>-url" value="<?php echo htmlentities($network['url']) ?>" id="bookmarks-url-<?php echo($key) ?>" />
                        </li>
                    <?php
                    }
                    ?>
                </ul>

                <div class="sizes">
                    <span><?php _e('Size:', WYSIJA) ?></span>
                    <a href="javascript:;" class="small<?php if($data['size'] === 'small') echo ' selected' ?>" rel="small"><?php _e('small', WYSIJA) ?></a>
                    <a href="javascript:;" class="medium<?php if($data['size'] === 'medium') echo ' selected' ?>" rel="medium"><?php _e('medium', WYSIJA) ?></a>
                    <a href="javascript:;" class="large<?php if($data['size'] === 'large') echo ' selected' ?>" rel="large"><?php _e('large', WYSIJA) ?></a>
                    <input type="hidden" name="bookmarks-size" value="<?php echo $data['size'] ?>" id="bookmarks-size" />
                </div>

                <ul class="icons"><!-- this will be loaded via ajax --></ul>
                <input type="hidden" name="bookmarks-iconset" value="" id="bookmarks-iconset" />
                <input type="hidden" name="bookmarks-theme" value="<?php echo $data['theme'] ?>" id="bookmarks-theme" />

                <p class="align-right">
                    <input type="submit" id="bookmarks-submit" name="submit" value="<?php echo esc_attr(__("Done",WYSIJA)) ?>" class="button-primary"/></p>
            </form>

        </div>
        <?php
    }

    function popup_wysija_browse($errors){
        echo $this->messages(true);
        ?><div id="overlay"><img id="loader" src="<?php echo WYSIJA_URL ?>img/wpspin_light.gif" /></div>
        <div class="popup_content media-browse">
            <?php
            global $redir_tab, $type;

            $redir_tab = 'wysija_browse';
            media_upload_header();
            $post_id = intval($_REQUEST['post_id']);
            ?>

            <form enctype="multipart/form-data" method="post" action="" class="media-upload-form validate" id="wysija-browse-form">
                <?php
                $secure=array('action'=>"medias");
                $this->secure($secure); ?>

                <div id="media-items" class="clearfix"><?php echo $this->_get_media_items($post_id, $errors); ?></div>
            </form>
            <?php $this->_alt_close(); ?>
        </div>
        <?php
    }

    function _alt_close(){
        ?>
        <p class="align-right"><input type="submit" id="close-pop-alt" value="<?php echo esc_attr(__("Done",WYSIJA)) ?>" name="submit-draft" class="button-primary wysija"/></p>
        <?php
    }

    function __filterPostParent($query){
        global $wp_query;

        return $query.' AND post_parent!='.(int)$_REQUEST['post_id'].' ';
    }

    function popup_wp_browse($errors){
        echo $this->messages(true);
        ?><div id="overlay"><img id="loader" src="<?php echo WYSIJA_URL ?>img/wpspin_light.gif" /></div>
        <div class="popup_content media-wp-browse">
            <?php
            global $redir_tab, $wpdb, $wp_query, $wp_locale, $type, $tab, $post_mime_types;

            $redir_tab = 'wp_browse';

            media_upload_header();

            $limit=20;

            $_GET['paged'] = isset( $_GET['paged'] ) ? intval($_GET['paged']) : 0;
            if ( $_GET['paged'] < 1 )
                    $_GET['paged'] = 1;
            $start = ( $_GET['paged'] - 1 ) * $limit;
            if ( $start < 1 )
                    $start = 0;
            add_filter( 'post_limits', create_function( '$a', "return 'LIMIT $start, $limit';" ) );
            add_filter('posts_where_paged', array($this,'__filterPostParent'));
             //add_filter( 'posts_where_paged', create_function( '$a', "return ' AND post_parent!=1' " ) );

//$attachment->post_parent==$_REQUEST['post_id']
            list($post_mime_types, $avail_post_mime_types) = wp_edit_attachments_query();

            ?>

            <form enctype="multipart/form-data" method="post" action="" class="media-upload-form validate" id="library-form">

                <div class="tablenav">

                    <?php
                    $page_links = paginate_links( array(
                            'base' => add_query_arg( 'paged', '%#%' ),
                            'format' => '',
                            'prev_text' => __('&laquo;'),
                            'next_text' => __('&raquo;'),
                            'total' => ceil($wp_query->found_posts / $limit),
                            'current' => $_GET['paged']
                    ));

                    if ( $page_links )
                            echo "<div class='tablenav-pages'>$page_links</div>";
                    ?>
                </div>


                <?php

                $secure=array('action'=>"medias");
                $this->secure($secure); ?>

                <div id="media-items" class="clearfix"><?php echo $this->_get_media_items(null, $errors,true); ?></div>
            </form>

            <?php $this->_alt_close(); ?>
        </div>
        <?php
    }


    function popup_new_wp_upload($errors){
        echo $this->messages(true);
        ?>
        <div id="overlay"><img id="loader" src="<?php echo WYSIJA_URL ?>img/wpspin_light.gif" /></div>
        <div class="popup_content media-wp-upload">
            <?php
            global $redir_tab,$type, $tab;

            $redir_tab = 'new_wp_upload';

            media_upload_header();

            global $type, $tab, $pagenow, $is_IE, $is_opera;

            if ( function_exists('_device_can_upload') && ! _device_can_upload() ) {
                    echo '<p>' . __('The web browser on your device cannot be used to upload files. You may be able to use the <a href="http://wordpress.org/extend/mobile/">native app for your device</a> instead.') . '</p>';
                    return;
            }

            $upload_action_url = admin_url('async-upload.php');
            $post_id = isset($_REQUEST['post_id']) ? intval($_REQUEST['post_id']) : 0;
            $_type = isset($type) ? $type : '';
            $_tab = isset($tab) ? $tab : '';

            $upload_size_unit = $max_upload_size = wp_max_upload_size();
            $sizes = array( 'KB', 'MB', 'GB' );

            for ( $u = -1; $upload_size_unit > 1024 && $u < count( $sizes ) - 1; $u++ ) {
                    $upload_size_unit /= 1024;
            }

            if ( $u < 0 ) {
                    $upload_size_unit = 0;
                    $u = 0;
            } else {
                    $upload_size_unit = (int) $upload_size_unit;
            }
            ?>
            <script type="text/javascript">var post_id = <?php echo $post_id; ?>;</script>
            <div id="media-upload-notice"><?php

                    if (isset($errors['upload_notice']) )
                            echo $errors['upload_notice'];

            ?></div>
            <div id="media-upload-error"><?php

                    if (isset($errors['upload_error']) && is_wp_error($errors['upload_error']))
                            echo $errors['upload_error']->get_error_message();

            ?></div>
            <?php
            // Check quota for this blog if multisite
            if ( is_multisite() && !is_upload_space_available() ) {
                    echo '<p>' . sprintf( __( 'Sorry, you have filled your storage quota (%s MB).' ), get_space_allowed() ) . '</p>';
                    return;
            }

            do_action('pre-upload-ui');

            $post_params = array(
                            "post_id" => $post_id,
                            "_wpnonce" => wp_create_nonce('media-form'),
                            "type" => $_type,
                            "tab" => $_tab,
                            "short" => "1",
            );

            $post_params = apply_filters( 'upload_post_params', $post_params ); // hook change! old name: 'swfupload_post_params'

            $plupload_init = array(
                    'runtimes' => 'html5,silverlight,flash,html4',
                    'browse_button' => 'plupload-browse-button',
                    'container' => 'plupload-upload-ui',
                    'drop_element' => 'drag-drop-area',
                    'file_data_name' => 'async-upload',
                    'multiple_queues' => true,
                    'max_file_size' => $max_upload_size . 'b',
                    'url' => $upload_action_url,
                    'flash_swf_url' => includes_url('js/plupload/plupload.flash.swf'),
                    'silverlight_xap_url' => includes_url('js/plupload/plupload.silverlight.xap'),
                    'filters' => array( array('title' => __( 'Allowed Files' ), 'extensions' => '*') ),
                    'multipart' => true,
                    'urlstream_upload' => true,
                    'multipart_params' => $post_params
            );

            $plupload_init = apply_filters( 'plupload_init', $plupload_init );

            ?>

            <script type="text/javascript">
            <?php
            // Verify size is an int. If not return default value.
            $large_size_h = absint( get_option('large_size_h') );
            if( !$large_size_h )
                    $large_size_h = 1024;
            $large_size_w = absint( get_option('large_size_w') );
            if( !$large_size_w )
                    $large_size_w = 1024;
            ?>
            var resize_height = <?php echo $large_size_h; ?>, resize_width = <?php echo $large_size_w; ?>,
            wpUploaderInit = <?php echo json_encode($plupload_init); ?>;
            </script>

            <div id="plupload-upload-ui" class="hide-if-no-js">
            <?php do_action('pre-plupload-upload-ui'); // hook change, old name: 'pre-flash-upload-ui' ?>
            <div id="drag-drop-area">
                    <div class="drag-drop-inside">
                        <p class="drag-drop-info"><?php _e('Drop files here'); ?></p>
                        <p><?php _ex('or', 'Uploader: Drop files here - or - Select Files'); ?></p>
                        <p class="drag-drop-buttons"><input id="plupload-browse-button" type="button" value="<?php esc_attr_e('Select Files'); ?>" class="button" /></p>
                    </div>
            </div>
            <?php do_action('post-plupload-upload-ui'); // hook change, old name: 'post-flash-upload-ui' ?>
            </div>

            <div id="html-upload-ui" class="hide-if-js">
            <?php do_action('pre-html-upload-ui'); ?>
                    <p id="async-upload-wrap" class="clearfix">
                            <label class="screen-reader-text" for="async-upload"><?php _e('Upload'); ?></label>
                            <input type="file" name="async-upload" id="async-upload" />
                            <?php submit_button( __( 'Upload' ), 'button', 'html-upload', false ); ?>
                            <a href="#" onclick="try{top.tb_remove();}catch(e){}; return false;"><?php _e('Cancel'); ?></a>
                    </p>
            <?php do_action('post-html-upload-ui'); ?>
            </div>

            <p class="max-upload-size"><?php printf( __( 'Maximum upload file size: %d%s.' ), esc_html($upload_size_unit), esc_html($sizes[$u]) ); ?></p>
            <?php
            if ( ($is_IE || $is_opera) && $max_upload_size > 100 * 1024 * 1024 ) { ?>
                    <p class="big-file-warning"><?php _e('Your browser has some limitations uploading large files with the multi-file uploader. Please use the browser uploader for files over 100MB.'); ?></p>
            <?php }

            ?>
            <div id="media-items" class="hide-if-no-js"></div>
            <?php do_action('post-upload-ui'); ?>
        </div>
        <?php
    }

    function popup_wp_upload($errors){
        global $redir_tab,$type, $tab;

        $redir_tab = 'wp_upload';

        media_upload_header();
	$flash_action_url = admin_url('async-upload.php');

	// If Mac and mod_security, no Flash. :(
	$flash = true;
        /*
	if(false !== stripos($_SERVER['HTTP_USER_AGENT'], 'mac') && apache_mod_loaded('mod_security')) {
            $flash = false;
        }*/

	$flash = apply_filters('flash_uploader', $flash);
	$post_id = isset($_REQUEST['post_id']) ? intval($_REQUEST['post_id']) : 0;

	$upload_size_unit = $max_upload_size =  wp_max_upload_size();
	$sizes = array( 'KB', 'MB', 'GB' );
	for ( $u = -1; $upload_size_unit > 1024 && $u < count( $sizes ) - 1; $u++ )
		$upload_size_unit /= 1024;
	if ( $u < 0 ) {
		$upload_size_unit = 0;
		$u = 0;
	} else {
		$upload_size_unit = (int) $upload_size_unit;
	}
        echo $this->messages(true);
        ?>
        <div class="updated"><ul><li><?php _e('Please update your WordPress to the latest version, in order to get the latest uploading system.',WYSIJA)?></li></ul></div>
        <div id="overlay"><img id="loader" src="<?php echo WYSIJA_URL ?>img/wpspin_light.gif" /></div>
        <div class="popup_content media-wp-upload">
            <script type="text/javascript">
            //<![CDATA[
            var uploaderMode = 0;
            jQuery(document).ready(function($){
                    uploaderMode = getUserSetting('uploader');
                    $('.upload-html-bypass a').click(function(){deleteUserSetting('uploader');uploaderMode=0;swfuploadPreLoad();return false;});
                    $('.upload-flash-bypass a').click(function(){setUserSetting('uploader', '1');uploaderMode=1;swfuploadPreLoad();return false;});
            });
            //]]>
            </script>

            <div id="media-upload-notice">
            <?php if (isset($errors['upload_notice']) ) { ?>
                    <?php echo $errors['upload_notice']; ?>
            <?php } ?>
            </div>
            <div id="media-upload-error">
            <?php if (isset($errors['upload_error']) && is_wp_error($errors['upload_error'])) { ?>
                    <?php echo $errors['upload_error']->get_error_message(); ?>
            <?php } ?>
            </div>
            <?php
            // Check quota for this blog if multisite
            if ( is_multisite() && !is_upload_space_available() ) {
                echo '<p>' . sprintf( __( 'Sorry, you have filled your storage quota (%s MB).' ), get_space_allowed() ) . '</p>';
                return;
            }

            do_action('pre-upload-ui');

            if ( $flash ) : ?>
            <script type="text/javascript">
            //<![CDATA[
            var swfu;
            SWFUpload.onload = function() {
                    var settings = {
                                    button_text: '<span class="button"><?php _e('Select Files'); ?><\/span>',
                                    button_text_style: '.button { text-align: center; font-weight: bold; font-family:"Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif; font-size: 11px; text-shadow: 0 1px 0 #FFFFFF; color:#464646; }',
                                    button_height: "23",
                                    button_width: "132",
                                    button_text_top_padding: 3,
                                    button_image_url: '<?php echo includes_url('images/upload.png?ver=20100531'); ?>',
                                    button_placeholder_id: "flash-browse-button",
                                    upload_url : "<?php echo esc_attr( $flash_action_url ); ?>",
                                    flash_url : "<?php echo includes_url().'js/swfupload/swfupload.swf'; ?>",
                                    file_post_name: "async-upload",
                                    file_types: "<?php echo apply_filters('upload_file_glob', '*.*'); ?>",
                                    post_params : {
                                            "post_id" : "<?php echo $post_id; ?>",
                                            "auth_cookie" : "<?php echo (is_ssl() ? $_COOKIE[SECURE_AUTH_COOKIE] : $_COOKIE[AUTH_COOKIE]); ?>",
                                            "logged_in_cookie": "<?php echo $_COOKIE[LOGGED_IN_COOKIE]; ?>",
                                            "_wpnonce" : "<?php echo wp_create_nonce('media-form'); ?>",
                                            "type" : "<?php echo $type; ?>",
                                            "tab" : "<?php echo $tab; ?>",
                                            "short" : "1"
                                    },
                                    file_size_limit : "<?php echo $max_upload_size; ?>b",
                                    file_dialog_start_handler : fileDialogStart,
                                    file_queued_handler : fileQueued,
                                    upload_start_handler : uploadStart,
                                    upload_progress_handler : uploadProgress,
                                    upload_error_handler : uploadError,
                                    upload_success_handler : WYSIJAuploadSuccess,
                                    upload_complete_handler : WYSIJAuploadComplete,
                                    file_queue_error_handler : fileQueueError,
                                    file_dialog_complete_handler : fileDialogComplete,
                                    swfupload_pre_load_handler: swfuploadPreLoad,
                                    swfupload_load_failed_handler: swfuploadLoadFailed,
                                    custom_settings : {
                                            degraded_element_id : "html-upload-ui", // id of the element displayed when swfupload is unavailable
                                            swfupload_element_id : "flash-upload-ui" // id of the element displayed when swfupload is available
                                    },
                                    debug: false
                            };
                            swfu = new SWFUpload(settings);
            };
            //]]>
            </script>

            <div id="flash-upload-ui" class="hide-if-no-js">
            <?php do_action('pre-flash-upload-ui'); ?>

                    <div>
                    <?php _e( 'Choose files to upload',WYSIJA ); ?>
                    <div id="flash-browse-button"></div>
                    <span><input id="cancel-upload" disabled="disabled" onclick="cancelUpload()" type="button" value="<?php esc_attr_e('Cancel Upload',WYSIJA); ?>" class="button" /></span>
                    </div>
                    <p class="media-upload-size"><?php printf( __( 'Maximum upload file size: %d%s',WYSIJA ), $upload_size_unit, $sizes[$u] ); ?></p>
            <?php do_action('post-flash-upload-ui'); ?>
            </div>
            <?php endif; // $flash ?>

            <div id="html-upload-ui">
            <?php do_action('pre-html-upload-ui'); ?>
                    <p id="async-upload-wrap">
                    <label class="screen-reader-text" for="async-upload"><?php _e('Upload',WYSIJA); ?></label>
                    <input type="file" name="async-upload" id="async-upload" /> <input type="submit" class="button" name="html-upload" value="<?php esc_attr_e('Upload',WYSIJA); ?>" /> <a href="#" onclick="try{top.tb_remove();}catch(e){}; return false;"><?php _e('Cancel',WYSIJA); ?></a>
                    </p>
                    <div class="clear"></div>
                    <p class="media-upload-size"><?php printf( __( 'Maximum upload file size: %d%s',WYSIJA ), $upload_size_unit, $sizes[$u] ); ?></p>
                    <?php if ( is_lighttpd_before_150() ): ?>
                    <p><?php _e('If you want to use all capabilities of the uploader, like uploading multiple files at once, please upgrade to lighttpd 1.5.'); ?></p>
                    <?php endif;?>
            <?php do_action('post-html-upload-ui', $flash); ?>
            </div>
            <?php do_action('post-upload-ui'); ?>
            <div id="media-items" class="clearfix"></div>
        </div>
        <?php
    }

    function _get_media_items( $post_id, $errors, $wpimage=false ) {
            $attachments = array();

            if ( $post_id ) {
                    $post = get_post($post_id);
                    if ( $post && $post->post_type == 'attachment' )
                            $attachments = array($post->ID => $post);
                    else
                            $attachments = get_children( array( 'post_parent' => $post_id, 'post_type' => 'attachment', 'orderby' => 'ID', 'order' => 'DESC') );
            } else {
		if ( is_array($GLOBALS['wp_the_query']->posts) ){
                    foreach ( $GLOBALS['wp_the_query']->posts as $attachment ){
                         $attachments[$attachment->ID] = $attachment;
                    }
                }


            }

            $selectedImages=$this->_getSelectedImages();

            $output = '';
            foreach ( (array) $attachments as $id => $attachment ) {

                 if(!$post_id && $attachment->post_parent==$_REQUEST['post_id']){

                    continue;
                }
                if ( $attachment->post_status == 'trash' ){

                    continue;
                }

                    if ( ( $id = intval( $id ) ) && $thumb_details = wp_get_attachment_image_src( $id, 'thumbnail', true ) )
                            $thumb_url = $thumb_details[0];
                    else
                            $thumb_url = false;

                     if ( ( $id = intval( $id ) )) $img_details = wp_get_attachment_image_src( $id, 'full', true );
                     $classname="";

                     if(isset($selectedImages["wp-".$attachment->ID])) $classname=" selected ";

                    $output.='<div class="wysija-thumb image-'.$attachment->ID.$classname.'">';
                    $output .= '<img title="'.$attachment->post_title.'" alt="'.$attachment->post_title.'" src="'.$thumb_url.'" class="thumbnail" />';
                    if(!$wpimage)    $output.='<span class="delete-wrap"><span class="delete del-attachment">'.$attachment->ID.'</span></span>';
                    $output.='<span class="identifier">'.$attachment->ID.'</span>
                        <span class="width">'.$img_details[1].'</span>
                        <span class="height">'.$img_details[2].'</span>
                        <span class="url">'.$attachment->guid.'</span>
                        <span class="thumb_url">'.$thumb_url.'</span></div>';
            }
            if(!$output) $output="<em>".__('This tab will be filled with images from your current and previous newsletters.',WYSIJA)."</em>";
            return $output;
    }

    function _getSelectedImages() {
        $modelEmail=&WYSIJA::get("email","model");
        $email = $modelEmail->getOne(false,array("email_id"=>$_REQUEST['emailId']));

        if(!isset($email['params']['quickselection']) or empty($email['params']['quickselection'])) return array();
        return $email['params']['quickselection'];
    }

    function welcome_new($data){
        return $this->whats_new($data);
    }

    function whats_new($data){
        ?>
        <div class="wrap about-wrap">

            <h1><?php echo sprintf(__('Welcome to Wysija %1$s',WYSIJA),WYSIJA::get_version()); ?></h1>

            <div class="about-text"><?php echo $data['abouttext'] ?></div>

            <?php
                foreach($data['sections'] as $section){
                    ?>
                     <div class="changelog">
                            <h3><?php echo $section['title'] ?></h3>

                            <div class="feature-section <?php echo $section['format'] ?>">
                                <?php switch($section['format']){
                                    case 'three-col':
                                        foreach($section['cols'] as $col){
                                            ?>
                                            <div>
                                                    <h4><?php echo $col['title'] ?></h4>
                                                    <p><?php echo $col['content'] ?></p>
                                            </div>
                                            <?php
                                        }
                                        break;
                                    case 'bullets':
                                        echo '<ul>';
                                        foreach($section['paragraphs'] as $line){
                                            ?>
                                            <li><?php echo $line ?></li>
                                            <?php
                                        }
                                        echo '</ul>';
                                        break;
                                    default :
                                        foreach($section['paragraphs'] as $line){
                                            ?>
                                            <p><?php echo $line ?></p>
                                            <?php
                                        }

                                } ?>

                            </div>
                    </div>
                    <?php
                }
            ?>

            <a class="wysija-premium-btns wysija-premium" href="admin.php?page=wysija_campaigns"><?php _e('Thanks! Now bring me to Wysija.',WYSIJA); ?></a>

        </div>


        <?php
    }
}